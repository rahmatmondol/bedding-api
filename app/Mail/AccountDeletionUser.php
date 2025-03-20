<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountDeletionUser extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Dirham App - Account Deletion Confirmation')
            ->markdown('emails.account-deletion-user')
            ->with([
                'userName' => $this->userName,
                'supportEmail' => config('mail.support_address', 'support@dirhamapp.com'),
                'deletionDate' => now()->format('F j, Y, g:i a')
            ]);
    }
}
