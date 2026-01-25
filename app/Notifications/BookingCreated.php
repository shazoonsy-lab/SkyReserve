<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Booking;

class BookingCreated extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database']; // تخزين في جدول notifications
    }

    public function toDatabase($notifiable)
    {
        return [
            'customer' => $this->booking->customer_name,
            'flight' => $this->booking->flight->flight_number ?? '—',
            'status' => $this->booking->status,
            'employee' => $this->booking->employee->name ?? '—',
        ];
    }
}
