<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;

class BookingPolicy
{
    public function pay(User $user, Booking $booking)
    {
        return
            $booking->user_id === $user->id &&
            $booking->status === 'approved';
    }
}
