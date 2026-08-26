<?php

namespace App\Http\Controllers;

use App\Mail\ClientMailPayment;
use App\Mail\PaymentConfirmationMail;
use App\Models\BxService;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class BxServicePaymentController extends Controller
{
    public function initiateServicePayment(Request $request): View|RedirectResponse
    {
        
        $validated = $request->validate([
            'your_name'    => ['required', 'regex:/^[A-Za-z\s]+$/', 'min:2', 'max:150'],
            'mobile' => ['required', 'regex:/^[7-9][0-9]{9}$/'], // only 10 digits
            'email'        => ['required', 'email', 'max:150'],
            'company'      => ['required', 'regex:/^[A-Za-z\s]+$/', 'min:2', 'max:255'],
            'payment_mode' => ['required', 'in:OPTCRDC,OPTDBCRD,OPTNBK'],
            'service_type' => ['nullable', 'integer', 'in:1,2,3,4,5'],
        ]);


        $serviceType = (int) ($validated['service_type'] ?? 1);

        if ($serviceType === 3 && BxService::query()
            ->where('service_type', $serviceType)
            ->where('payment_status', 1)
            ->where('event_date', $request->input('event_date'))
            ->where(fn ($query) => $query
                ->where('email', $validated['email'])
                ->orWhere('phone', $validated['mobile']))
            ->exists()) {
            return back()->withInput()->withErrors(['payment' => 'Ticket has already been booked from this account.']);
        }

        $paymentMode = $validated['payment_mode'];
        $planAmount = match ($serviceType) {
            2 => 20000,
            3 => 500,
            default => 30000,
        };
        $planName = config('constants.businessServices.' . $serviceType, 'Business Service');
        $gatewayCharge = (float) config('hdfcpg.charges.' . $paymentMode, 0);
        $amount = $planAmount + round(($gatewayCharge * $planAmount) / 100);
        $orderNo = $this->onlinePayUniqueOrder();
        $payment = BxService::create([
            'order_no' => $orderNo,
            'user_id' => $request->user('web')?->user_id ?: null,
            'name' => $validated['your_name'],
            'email' => $validated['email'],
            'phone' => $validated['mobile'],
            'company' => $validated['company'],
            'designation' => $request->input('designation'),
            'service_type' => $serviceType,
            'event_city' => $request->input('event_city'),
            'event_date' => $request->input('event_date'),
            'event_timing' => $request->input('event_timing'),
            'event_topic' => $request->input('event_topic'),
            'is_member' => $serviceType === 3 ? $this->isMember($validated['email'], $validated['mobile']) : null,
            'product_details' => $planName,
            'amount' => $amount,
            'payment_mode' => $paymentMode,
            'payment_status' => config('payu.paymentStatus.Initiated', 0),
        ]);

        $paymentDetails = [
            'key' => config('payu.merchantKey'),
            'hash' => $this->createPayuRequestHash(
                $orderNo,
                $amount,
                $planName,
                $validated['your_name'],
                $validated['email']
            ),
            'txnid' => $orderNo,
            'actionUrl' => config('payu.baseUrl'),
            'surl' => route('service.payment.payu.success'),
            'furl' => route('service.payment.payu.failure'),
            'curl' => route('service.payment.payu.cancel'),
            'amount' => $amount,
            'firstname' => $validated['your_name'],
            'email' => $validated['email'],
            'phone' => $validated['mobile'],
            'productinfo' => $planName,
            'city' => 'marketplan',
            'country' => 'India',
            'udf1' => '',
            'udf2' => '',
            'udf3' => '',
            'udf4' => '',
            'udf5' => '',
        ];

        return view('services.payment-gateway', compact('payment', 'paymentDetails'));
    }

    public function verifyServicePayment(Request $request): RedirectResponse
    {
        $status = (string) $request->input('status');
        $transactionId = (string) $request->input('txnid');
        $postedHash = (string) $request->input('hash');
        $email = (string) $request->input('email');
        $firstName = (string) $request->input('firstname');
        $productInfo = (string) $request->input('productinfo');
        $amount = (string) $request->input('amount');
        $key = (string) $request->input('key');
        $payment = BxService::query()->where('order_no', $transactionId)->first();

        if (!$payment || abs((float) $payment->amount - (float) $amount) > 0.001) {
            return $this->markPayment($transactionId, 'Failed', 'Payment verification failed.');
        }

        $hashSequence = config('payu.salt') . '|' . $status . '|||||||||||'
            . $email . '|' . $firstName . '|' . $productInfo . '|' . $amount . '|' . $transactionId . '|' . $key;
        if (!$postedHash || !hash_equals(strtolower($postedHash), hash('sha512', $hashSequence))) {
            return $this->markPayment($transactionId, 'Failed', 'Payment verification failed.');
        }

        return $status === 'success'
            ? $this->markPayment($transactionId, 'Success', 'Payment successful.')
            : $this->markPayment($transactionId, 'Failed', 'Payment was not completed.');
    }

    public function cancelledServicePayment(Request $request): RedirectResponse
    {
        return $this->markPayment((string) $request->input('txnid'), 'Cancelled', 'Payment was cancelled.');
    }

    public function failedServicePayment(Request $request): RedirectResponse
    {
        return $this->markPayment((string) $request->input('txnid'), 'Failed', 'Payment failed.');
    }

    protected function markPayment(string $orderNo, string $status, string $message): RedirectResponse
    {
        $payment = BxService::query()->where('order_no', $orderNo)->first();
        if (!$payment) {
            Log::warning('Service payment order not found: ' . $orderNo);
            return redirect()->route('service.business-valuation')->withErrors(['payment' => $message]);
        }

        $statusCode = config('payu.paymentStatus.' . $status, 2);
        if ($payment->payment_status !== $statusCode) {
            $payment->update(['payment_status' => $statusCode]);
        }

        if ($status === 'Success') {
            try {
                Mail::to(['techsupport@franchiseindia.com', 'vasanth.m@businessex.com', 'sonali.tomar@businessex.com', 'maya.v@businessex.com'])
                    ->send(new ClientMailPayment($payment));
                Mail::to($payment->email)->send(new PaymentConfirmationMail($payment));
            } catch (\Throwable $exception) {
                Log::error('Service payment email failed: ' . $exception->getMessage());
            }
        }

        return redirect()->route('service.business-valuation')->with($status === 'Success' ? 'success' : 'error', $message);
    }

    protected function onlinePayUniqueOrder(): string
    {
        do {
            $orderNo = (string) random_int(100000, 999999999);
        } while (BxService::query()->where('order_no', $orderNo)->exists());

        return $orderNo;
    }

    protected function createPayuRequestHash(
        string $transactionId,
        int|float|string $amount,
        string $productInfo,
        string $firstName,
        string $email
    ): string {
        $hashSequence = implode('|', [
            config('payu.merchantKey'),
            $transactionId,
            $amount,
            $productInfo,
            $firstName,
            $email,
            '',
            '',
            '',
            '',
            '',
        ]) . '||||||' . config('payu.salt');

        return strtolower(hash('sha512', $hashSequence));
    }

    public function isMember(string $email, string $mobile): int
    {
        $user = User::query()->where(fn ($query) => $query
            ->where('email', $email)
            ->orWhere('mobile', $mobile))
            ->first();

        return $user && UserProfile::query()
            ->where('user_id', $user->user_id)
            ->where('profile_status', 1)
            ->exists() ? 1 : 0;
    }
}
