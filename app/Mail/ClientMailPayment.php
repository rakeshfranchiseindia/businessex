<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientMailPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $onlinePay;

    /**
     * Create a new message instance.
     */
    public function __construct($onlinePay)
    {
        $this->onlinePay = $onlinePay;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $orderNo        = $this->onlinePay->order_no;
        $name           = $this->onlinePay->name;
        $email          = $this->onlinePay->email;
        $mobile         = $this->onlinePay->phone;
        $profileType    = $this->onlinePay->profile_type ?? '';
        $city           = $this->onlinePay->city ?? '';
        $company        = $this->onlinePay->company ?? '';
        $amount         = $this->onlinePay->amount;
        $productDetails = $this->onlinePay->product_details;

        // Default profile
        $profile = 'Business Services';

        switch ($profileType) {
            case 1: $profile = 'Business'; break;
            case 2: $profile = 'Investor'; break;
            case 3: $profile = 'Lender'; break;
            case 4: $profile = 'Mentor'; break;
            case 5: $profile = 'Incubation'; break;
            case 6: $profile = 'Broker'; break;
            case 7: $profile = 'Startup'; break;
        }

        $mailSubject = 'Payment Confirmation Mail ' . $productDetails . ' - BusinessEx.com';

        return $this->subject($mailSubject)
                    ->view('emails.ClientPaymentConfirmation')
                    ->with([
                        'orderNo'        => $orderNo,
                        'name'           => $name,
                        'mobile'         => $mobile,
                        'email'          => $email,
                        'city'           => $city,
                        'company'        => $company,
                        'productDetails' => $productDetails,
                        'profile'        => $profile,
                        'amount'         => $amount,
                    ]);
    }
}