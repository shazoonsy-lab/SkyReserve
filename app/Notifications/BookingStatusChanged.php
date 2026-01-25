<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;


class BookingStatusChanged extends Notification
{
     use Queueable;

    public Booking $booking;
    public string $status;

    public function __construct(Booking $booking, string $status)
    {
        $this->booking = $booking;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    return [
        'booking_id' => $this->booking->id,
        'flight_number' => $this->booking->flight->flight_number ?? '-',
        'customer_name' => $this->booking->customer_name,
        'status' => $this->status,
        'message' => $this->getMessage(),
    ];
}

private function getMessage()
{
    return match ($this->status) {
        'approved' => "تمت الموافقة على حجز الرحلة {$this->booking->flight->flight_number} للعميل {$this->booking->customer_name}",
        'rejected' => "تم رفض حجز الرحلة {$this->booking->flight->flight_number} للعميل {$this->booking->customer_name}",
        'pending'  => "تم تعديل حالة حجز الرحلة {$this->booking->flight->flight_number}",
        default    => "تم تحديث حالة الحجز",
    };
}

}

