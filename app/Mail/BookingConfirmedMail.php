<?php

namespace App\Mail;
use App\Models\Booking;
use Illuminate\Mail\Mailable;

class BookingConfirmedMail extends Mailable
{
    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this
            ->subject('✈️ تأكيد حجزك - SkyReserve')
            ->view('emails.booking-confirmed');
    }
}
