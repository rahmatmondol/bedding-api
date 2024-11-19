<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidPlaced extends Notification
{
    use Queueable;

    private $bid;

    /**
     * Create a new notification instance.
     */
    public function __construct($bid)
    {
        $this->bid = $bid;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database', 'broadcast']; // Add 'mail' if needed.
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'bid_id' => $this->bid->id,
            'amount' => $this->bid->amount,
            'service_id' => $this->bid->service_id,
            'provider_id' => $this->bid->provider_id,
            'message' => $this->bid->message,
            'created_at' => now(),
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'bid_id' => $this->bid->id,
            'amount' => $this->bid->amount,
            'service_id' => $this->bid->service_id,
            'provider_id' => $this->bid->provider_id,
            'message' => $this->bid->message,
            'created_at' => now(),
        ]);
    }

    /**
     * Optional: Mail notification (if you want email notifications).
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('A new bid has been placed.')
            ->action('View Bid', url('/bids/' . $this->bid->id))
            ->line('Thank you for using our application!');
    }
}