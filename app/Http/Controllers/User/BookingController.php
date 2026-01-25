<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * عرض نموذج الحجز (للزائر)
     */
    public function create(Flight $flight)
    {
        return view('user.bookings.create', compact('flight'));
    }

    /**
     * تنفيذ الحجز (للزائر)
     */
    public function store(Request $request, Flight $flight)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email',
            'phone'          => 'required|string',
            'seats'          => 'required|integer|min:1|max:5',
            'seat_type'      => 'required|in:economy,business,first',
        ]);

        // حساب السعر
        $price = $flight->price;
        $multiplier = match ($request->seat_type) {
            'business' => 1.5,
            'first'    => 2,
            default    => 1,
        };

        $total = $price * $multiplier * $request->seats;

        // إنشاء الحجز
        $booking = Booking::create([
            'flight_id'      => $flight->id,
            'user_id'        => auth()->id(), // null لو زائر
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'phone'          => $request->phone,
            'seats'          => $request->seats,
            'seat_type'      => $request->seat_type,
            'total_price'    => $total,
            'status'         => 'pending',
            'booking_code'   => strtoupper(Str::random(8)),
        ]);

        return redirect()
            ->route('user.bookings.success', $booking->booking_code);
    }

    /**
     * صفحة نجاح الحجز
     */
    public function success($code)
    {
        $booking = Booking::where('booking_code', $code)->firstOrFail();

        return view('user.bookings.success', compact('booking'));
    }

    /**
     * حجوزات المستخدم (للمسجّل فقط)
     */
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->latest()->get();

        return view('user.bookings.index', compact('bookings'));
    }

public function payment($id)
{
    $booking = Booking::findOrFail($id);

    // 🔒 حماية
    if ($booking->user_id !== Auth::id()) {
        abort(403, 'هذا الحجز لا يخصك');
    }

    return view('user.bookings.payment', compact('booking'));
}



    // معالجة الدفع
public function processPayment(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->user_id !== Auth::id()) {
        abort(403, 'هذا الحجز لا يخصك');
    }

    // ✅ الحالات المسموحة فقط
    $booking->update([
        'status' => 'approved', // أو confirmed حسب قاعدة البيانات
        'is_paid' => true,
    ]);

    return redirect()->route(
        'user.bookings.payment.success',
        $booking->id
    );
}


}





