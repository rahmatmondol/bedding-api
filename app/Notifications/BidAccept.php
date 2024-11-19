<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidAccept extends Notification
{
    use Queueable;

    private $booking;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
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
            'booking_id' => $this->booking->id,
            'customer_id' => $this->booking->customer_id,
            'service_id' => $this->booking->service_id,
            'message' => 'Bid accepted',
            'created_at' => now(),
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'booking_id' => $this->booking->id,
            'customer_id' => $this->booking->customer_id,
            'service_id' => $this->booking->service_id,
            'message' => 'Bid accepted',
            'created_at' => now(),
        ]);
    }

    /**
     * Optional: Mail notification (if you want email notifications).
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Your bid has been accepted.')
            ->action('View Booking', url('/bookings/' . $this->booking->id))
            ->line('Thank you for using our application!');
    }
}
