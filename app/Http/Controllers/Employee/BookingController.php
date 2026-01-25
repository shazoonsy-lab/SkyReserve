<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\User;
use App\Notifications\BookingCreated;
use App\Notifications\BookingStatusChanged;

class BookingController extends Controller
{
    /**
     * عرض قائمة الحجوزات الخاصة بالموظف
     */
    public function index(Request $request)
    {
        $query = Booking::with('flight')
            ->where('employee_id', auth()->id());

        // فلترة حسب البحث
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        // فلترة حسب الحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('employee.bookings.index', compact('bookings'));
    }

    /**
     * عرض صفحة إنشاء حجز جديد
     */
    public function create()
    {
        $flights = Flight::orderBy('departure_time', 'asc')->get();
        return view('employee.bookings.create', compact('flights'));
    }

    /**
     * تخزين الحجز الجديد
     */
     public function store(Request $request)
{
    $data = $request->validate([
        'flight_id' => 'required|exists:flights,id',
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
        'seats' => 'required|integer|min:1',
        'seat_type' => 'required|string|in:economy,business,vip',
    ]);

    $prices = [
        'economy' => 500,
        'business' => 700,
        'vip' => 1000,
    ];

    $data['seat_price']  = $prices[$data['seat_type']];
    $data['total_price'] = $data['seat_price'] * $data['seats'];
    $data['status']      = 'pending';
    $data['employee_id'] = auth()->id();

    Booking::create($data);

    return redirect()
        ->route('employee.dashboard')
        ->with('success', 'تم إنشاء الحجز بنجاح');
}



    /**
     * عرض تفاصيل حجز
     */
    public function show(Booking $booking)
    {
        return view('employee.bookings.show', compact('booking'));
    }

    /**
     * تعديل الحجز
     */
    public function edit(Booking $booking)
    {
        $flights = Flight::orderBy('departure_time')->get();
        return view('employee.bookings.edit', compact('booking', 'flights'));
    }

    /**
     * تحديث بيانات الحجز
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'flight_id' => 'required|exists:flights,id',
            'seats' => 'required|integer|min:1',
            'seat_type' => 'required|string',
              'status' => 'employee_ok',
     

        ]);

        $prices = [
            'economy' => 500,
            'business' => 700,
            'vip' => 1000,
        ];

        $data['seat_price']  = $prices[$data['seat_type']];
        $data['total_price'] = $data['seat_price'] * $data['seats'];

        $booking->update($data);

        // إشعار الأدمن بتحديث الحجز
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
             new BookingStatusChanged($booking, $booking->status);
        }

        return redirect()->route('employee.bookings.index')
                         ->with('success', 'تم تحديث الحجز بنجاح');
    }

    /**
     * الموافقة على الحجز
     */
    public function approve(Booking $booking)
    {
        $booking->update([
            'status' => 'approved',
            'employee_id' => auth()->id(),
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new BookingStatusChanged($booking));
        }

        return back()->with('success', 'تمت الموافقة على الحجز');
    }

    /**
     * رفض الحجز
     */
    public function reject(Booking $booking)
    {
        $booking->update([
            'status' => 'rejected',
            'employee_id' => auth()->id(),
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new BookingStatusChanged($booking));
        }

        return back()->with('success', 'تم رفض الحجز');
    }

    /**
     * حذف الحجز
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('employee.bookings.index')
                         ->with('success', 'تم حذف الحجز بنجاح');
    }


    public function payment(Booking $booking)
{
    return view('employee.bookings.payments', compact('booking'));
}


  public function processPayment(Request $request, Booking $booking)
{
    $request->validate([
        'payment_method' => 'required|string',
    ]);

    $booking->update([
        'payment_method' => $request->payment_method,
        'payment_status' => 'pending',
        'status' => 'employee_ok',
    ]);

    // 🔀 التوجيه حسب طريقة الدفع
    return match ($request->payment_method) {
        'card' => redirect()->route('employee.bookings.payments.card', $booking),
        'paypal' => redirect()->route('employee.bookings.payments.paypal', $booking),
        default => redirect()
            ->route('employee.bookings.show', $booking)
            ->with('success', 'تم تسجيل الدفع بنجاح'),
    };
}
public function cardPayment(Booking $booking)
{
    return view('employee.bookings.payments.card', compact('booking'));
}

public function paypalPayment(Booking $booking)
{
    return view('employee.bookings.payments.paypal', compact('booking'));
}

 


   

}

