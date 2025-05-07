<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingAccepted extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Booking Confirmed')
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Your booking for ' . $this->booking->field->field_name . ' has been confirmed.')
                    ->line('Date: ' . $this->booking->date)
                    ->line('Start Time: ' . $this->booking->start_at)
                    ->action('View Booking', route('bookings.show', $this->booking->id))
                    ->line('Thank you for choosing us!');
    }
}
