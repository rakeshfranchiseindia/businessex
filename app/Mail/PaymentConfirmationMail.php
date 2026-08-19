<?php

namespace App\Mail;

use App\Models\BxService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
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
        $mailSubject = 'Payment Confirmation Mail ' 
                        . ($this->onlinePay->product_details ?? '') 
                        . ' - BusinessEx.com';

        // Choose template based on service type
        $template = ($this->onlinePay instanceof BxService && $this->onlinePay->service_type === 3)
            ? 'paymentConfirmationBex'
            : 'paymentConfirmation';

        return $this->subject($mailSubject)
                    ->view('emails.' . $template)
                    ->with([
                        'onlinePay' => $this->onlinePay,
                    ]);
    }
}