<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Notification;
use App\Notifications\BookingStatusChanged;

class BookingController extends Controller
{
    /**
     * عرض الحجوزات + فلترة
     */
    public function index(Request $request)
    {
        $query = Booking::with(['flight', 'employee']);

        if ($request->filled('flight_id')) {
            $query->where('flight_id', $request->flight_id);
        }

        if ($request->filled('user_id')) {
            $query->where('employee_id', $request->user_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * إنشاء حجز
     */
    public function create()
    {
        $flights = Flight::orderBy('departure_time')->get();
        return view('admin.bookings.create', compact('flights'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_id'      => 'required|exists:flights,id',
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'seats'          => 'required|integer|min:1',
            'seat_type'      => 'required|in:economy,business,vip',
        ]);

        $prices = [
            'economy'  => 500,
            'business' => 700,
            'vip'      => 1000,
        ];

        $data['seat_price']  = $prices[$data['seat_type']];
        $data['total_price'] = $data['seat_price'] * $data['seats'];
        $data['status']      = 'pending';

        Booking::create($data);

        Notification::create([
            'title'   => 'حجز جديد',
            'message' => 'تم إنشاء حجز جديد',
            'type'    => 'info',
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'تم إضافة الحجز بنجاح');
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $flights = Flight::orderBy('departure_time')->get();
        return view('admin.bookings.edit', compact('booking', 'flights'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'flight_id'      => 'required|exists:flights,id',
            'seats'          => 'required|integer|min:1',
            'seat_type'      => 'required|in:economy,business,vip',
        ]);

        $prices = [
            'economy'  => 500,
            'business' => 700,
            'vip'      => 1000,
        ];

        $booking->update([
            'customer_name' => $data['customer_name'],
            'customer_email'=> $data['customer_email'],
            'flight_id'     => $data['flight_id'],
            'seats'         => $data['seats'],
            'seat_type'     => $data['seat_type'],
            'seat_price'    => $prices[$data['seat_type']],
            'total_price'   => $prices[$data['seat_type']] * $data['seats'],
            'status'       => 'admin_ok',
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'تم تحديث الحجز بنجاح');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'تم حذف الحجز');
    }

    
    public function updateStatus(Request $request, Booking $booking)
{
    $request->validate([
        'status' => 'required|in:pending,employee_ok,admin_ok,rejected',
    ]);

    $booking->update([
        'status' => $request->status,
    ]);

    // إرسال إشعار للموظف
    if ($booking->employee) {
        $booking->employee->notify(
            new BookingStatusChanged($booking, $request->status)
        );
    }

    return back()->with('success', 'تم تحديث حالة الحجز');
}

}
