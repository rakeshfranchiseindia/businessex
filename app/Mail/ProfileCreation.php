<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProfileCreation extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $profileType;
    public string $subjectProfile;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->name          = $data[0];
        $this->profileType   = $data[1];
        $this->subjectProfile = $data[2];
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        try {
            return $this->subject("Profile Registration | {$this->subjectProfile} | BusinessEx.com")
                        ->view('emails.ProfileCreation')
                        ->with([
                            'name'        => $this->name,
                            'profileType' => $this->profileType,
                        ]);
        } catch (\Exception $exception) {
            Log::alert("Profile creation mail sending failed for {$this->name} -- {$exception->getMessage()}");
            return $this; // return empty mail object to avoid breaking flow
        }
    }
}