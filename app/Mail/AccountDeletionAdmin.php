<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountDeletionAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $deletionInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($deletionInfo)
    {
        $this->deletionInfo = $deletionInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Dirham App - Account Deletion Notification')
            ->markdown('emails.account-deletion-admin')
            ->with([
                'deletionInfo' => $this->deletionInfo
            ]);
    }
}
