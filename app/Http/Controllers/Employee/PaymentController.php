<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller; // <-- تأكد من هذا السطر
use App\Models\Booking;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // <-- Str يحتاج استدعاء كامل namespace

class PaymentController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|in:card,cash,paypal',
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => $request->payment_method,
            'amount' => $booking->total_price,
            'payment_status' => 'paid',
            'transaction_id' => strtoupper(Str::random(12)),
        ]);

        $booking->update([
            //'status' => 'approved',
             'is_paid' => true,
    'payment_method' => $request->payment_method,
    'paid_at' => now(),
        ]);

        return back()->with('success', 'تم الدفع بنجاح');
    }

     // عرض صفحة الدفع
    public function show(Booking $booking)
{
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    $intent = \Stripe\PaymentIntent::create([
        'amount' => $booking->total_price * 100,
        'currency' => 'usd',
        'metadata' => [
            'booking_id' => $booking->id,
        ],
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
    ]);

    // نخزن payment_intent_id
    $booking->update([
        'payment_intent_id' => $intent->id,
    ]);

    return view('employee.bookings.payments.card', [
        'booking' => $booking,
        'clientSecret' => $intent->client_secret,
    ]);
}


     public function confirm(Booking $booking)
{
    //$booking->update([
      //  'payment_status' => 'paid',
       // 'status' => 'employee_ok',
   // ]);
    
   // return response()->json([
    //    'redirect' => route('employee.bookings.show', $booking)
   // ]);

  
}
}

