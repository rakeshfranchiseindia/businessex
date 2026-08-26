<?php

namespace App\Http\Controllers;

use App\Models\BxCoupon;
use App\Models\BxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PriceController extends Controller
{
    private const PLAN_AMOUNTS = [
        'basic' => 500,
        'premium' => 6999,
        'gold' => 12999,
        'platinum' => 24999,
    ];

    public function priceListing(Request $request)
    {
            $membership = $request->query('membership');
            if (!$membership) {
                return view('pricing');
            }

            // Allowed memberships
            $allowed = ['platinum', 'gold', 'premium'];

            if (!in_array($membership, $allowed)) {
                abort(404);
            }
            return view('pricing', compact('membership'));
    }

    public function validatePromo(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'promo_code' => ['required', 'string', 'max:255'],
            'profile_type' => ['required', 'in:Business,Startup,Investor,Mentor'],
            'selected_plan' => ['required', 'in:basic,premium,gold,platinum'],
        ]);

        $coupon = $this->activeCoupon($validated['promo_code'], $validated['profile_type'], $validated['selected_plan']);

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'This promo code is invalid or expired.'], 422);
        }

        $amount = self::PLAN_AMOUNTS[$validated['selected_plan']];
        $discount = $this->discountFor($coupon, $amount);

        return response()->json([
            'success' => true,
            'message' => 'Promo code applied successfully.',
            'discount' => $discount,
            'payable' => max(0, $amount - $discount),
        ]);
    }

    public function initiatePayment(Request $request): View|RedirectResponse
    {
        
        $validated = $request->validate([
            'your_name' => ['required', 'string', 'regex:/^[A-Za-z][A-Za-z .\'-]*$/', 'min:2', 'max:150'],
            'email_id' => ['required', 'email', 'max:150'],
            'mobile_no' => ['required', 'digits:10'],
            'company_name' => ['required', 'string', 'min:2', 'max:255'],
            'payment_mode' => ['required', 'in:OPTCRDC,OPTDBCRD,OPTNBK'],
            'profile_type' => ['required', 'in:Business,Startup,Investor,Mentor'],
            'selected_plan' => ['required', 'in:basic,premium,gold,platinum'],
            'promo_code' => ['nullable', 'string', 'max:255'],
        ]);

        $baseAmount = self::PLAN_AMOUNTS[$validated['selected_plan']];
        
        $promoCode = $validated['promo_code'] ?? null;
        $coupon = $promoCode
            ? $this->activeCoupon($promoCode, $validated['profile_type'], $validated['selected_plan'])
            : null;

        if ($promoCode && !$coupon) {
            return back()->withInput()->withErrors(['promo_code' => 'This promo code is invalid or expired.']);
        }

        $discount = $coupon ? $this->discountFor($coupon, $baseAmount) : 0;
        $netAmount = max(1, $baseAmount - $discount);
        
        $paymentMode = $validated['payment_mode'];
        //$gatewayCharge = (float) config('hdfcpg.charges.' . $paymentMode, 0);
        $amount = $netAmount + round((18 * $netAmount) / 100);
        $orderNo = $this->onlinePayUniqueOrder();
        $productInfo = ucfirst($validated['selected_plan']) . ' ' . $validated['profile_type'] . ' Membership';

        $payment = BxService::create([
            'order_no' => $orderNo,
            'user_id' => $request->user('web')?->user_id,
            'name' => $validated['your_name'],
            'email' => $validated['email_id'],
            'phone' => $validated['mobile_no'],
            'company' => $validated['company_name'],
            'amount' => $amount,
            'service_type' => 1,
            'product_details' => $productInfo,
            'udf' => $coupon ? $coupon->coupon_code : null,
            'payment_mode' => $paymentMode,
            'payment_status' => config('payu.paymentStatus.Initiated', 0),
        ]);

        $paymentDetails = [
            'key' => config('payu.merchantKey'),
            'hash' => $this->createHash(
                $orderNo,
                $amount,
                $productInfo,
                $validated['your_name'],
                $validated['email_id'],
                $validated['profile_type'],
                $validated['selected_plan'],
                $coupon?->coupon_code ?? ''
            ),
            'txnid' => $orderNo,
            'actionUrl' => config('payu.baseUrl'),
            'surl' => route('pricing.payment.success'),
            'furl' => route('pricing.payment.failure'),
            'curl' => route('pricing.payment.cancel'),
            'amount' => $amount,
            'firstname' => $validated['your_name'],
            'email' => $validated['email_id'],
            'phone' => $validated['mobile_no'],
            'productinfo' => $productInfo,
            'city' => 'marketplan',
            'country' => 'India',
            'udf1' => $validated['profile_type'],
            'udf2' => $validated['selected_plan'],
            'udf3' => $coupon?->coupon_code ?? '',
            'udf4' => '',
            'udf5' => '',
        ];

        return view('services.payment-gateway', compact('payment', 'paymentDetails'));
    }

    public function paymentResult(Request $request, string $result): RedirectResponse
    {
        $orderNo = (string) $request->input('txnid');
        $payment = BxService::where('order_no', $orderNo)->first();
        $status = $result === 'success' ? 'Success' : ucfirst($result);

        if ($payment) {
            $payment->update(['payment_status' => config('payu.paymentStatus.' . $status, 2)]);
        } else {
            Log::warning('Pricing payment order not found: ' . $orderNo);
        }

        return redirect()->route('pricing.listing')->with($status === 'Success' ? 'success' : 'error', 'Payment ' . strtolower($status) . '.');
    }

    private function activeCoupon(string $code, string $profileType, string $plan): ?BxCoupon
    {
        $coupon = BxCoupon::whereRaw('LOWER(coupon_code) = ?', [strtolower(trim($code))])
            ->where('is_active', 1)
            ->where('platform', 1)
            ->where(fn ($query) => $query->whereNull('start_date')->orWhere('start_date', '<=', now()))
            ->where(fn ($query) => $query->whereNull('end_date')->orWhere('end_date', '>=', now()))
            ->where(fn ($query) => $query->whereNull('max_redemption')->orWhereColumn('redemption_number', '<', 'max_redemption'))
            ->first();

        if (!$coupon || ($coupon->profile_type && strcasecmp((string) $coupon->profile_type, $profileType) !== 0)) {
            return null;
        }

        return $coupon;
    }

    private function discountFor(BxCoupon $coupon, int $amount): int
    {
        return (int) min($amount, $coupon->discount_type === 1
            ? round($amount * min(100, (float) $coupon->discount_amount) / 100)
            : $coupon->discount_amount);
    }

    private function onlinePayUniqueOrder(): string
    {
        do {
            $orderNo = (string) random_int(100000, 999999999);
        } while (BxService::where('order_no', $orderNo)->exists());

        return $orderNo;
    }

    private function createHash(
        string $transactionId,
        int|float|string $amount,
        string $productInfo,
        string $firstName,
        string $email,
        string $udf1,
        string $udf2,
        string $udf3
    ): string
    {
        $hashString = implode('|', [
            config('payu.merchantKey'),
            $transactionId,
            $amount,
            $productInfo,
            $firstName,
            $email,
            $udf1,
            $udf2,
            $udf3,
            '',
            '',
        ]) . '||||||' . config('payu.salt');

        return strtolower(hash('sha512', $hashString));
    }
}
