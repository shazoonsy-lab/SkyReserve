<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Mail\BookingConfirmedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicBookingController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'flight_id' => 'required|exists:flights,id',
        'name'      => 'required|string',
        'email'     => 'required|email',
        'phone'     => 'nullable|string',
        'seats'     => 'required|integer|min:1',
        'seat_type' => 'required|string',
    ]);

    // تحديد سعر المقعد
    $seatPrice = match ($request->seat_type) {
        'economy'  => 50,
        'business' => 120,
        'first'    => 250,
        default    => 50,
    };

    // حساب السعر الإجمالي
    $totalPrice = $seatPrice * $request->seats;

    // إنشاء الحجز
    $booking = \App\Models\Booking::create([
        'flight_id'      => $request->flight_id,
        'customer_name'  => $request->name,
        'customer_email' => $request->email,
        'phone'          => $request->phone,
        'seats'          => $request->seats,
        'seat_type'      => $request->seat_type,
        'seat_price'     => $seatPrice,
        'total_price'    => $totalPrice,
        'payment_method' => $request->payment_method,

        'status'         => 'pending',
        'booking_code'   => strtoupper(uniqid('SR-')),
    ]);

   // \Mail::to($booking->customer_email)
   // ->send(new \App\Mail\BookingConfirmedMail($booking));


    return redirect()->route('booking.success', $booking->booking_code);
}



    
}
