<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
//use Maatwebsite\Excel\Facades\Excel;
//use App\Exports\FlightsExport;

class FlightController extends Controller
{
    // لوحة التحكم مع الإحصائيات
    public function dashboard()
    {
        $totalFlights = Flight::count();
        $totalBookings = Booking::count();
        $monthlyRevenue = Booking::whereMonth('created_at', now()->month)->sum('total_price');

        $mostBookedFlights = Booking::select('flight_id', DB::raw('COUNT(*) as bookings_count'))
                                    ->groupBy('flight_id')
                                    ->with('flight')
                                    ->orderByDesc('bookings_count')
                                    ->take(5)
                                    ->get();

        $flights = Flight::orderBy('departure_time')->take(8)->get();

        $notifications = Notification::where('is_read', false)
                                     ->orderBy('created_at', 'desc')
                                     ->take(5)
                                     ->get();

        // تعيين الإشعارات كمقروءة
        Notification::where('is_read', false)->update(['is_read' => true]);

        return view('admin.dashboard', compact(
            'totalFlights',
            'totalBookings',
            'monthlyRevenue',
            'mostBookedFlights',
            'flights',
            'notifications'
        ));
    }

    // عرض الرحلات مع الفلترة
    public function index(Request $request)
    {
        $query = Flight::query();

        if ($request->filled('departure_city')) {
            $query->where('departure_city', 'like', '%' . $request->departure_city . '%');
        }

        if ($request->filled('arrival_city')) {
            $query->where('arrival_city', 'like', '%' . $request->arrival_city . '%');
        }

        if ($request->filled('airline')) {
            $query->where('airline', 'like', '%' . $request->airline . '%');
        }

        $flights = $query->orderBy('departure_time', 'desc')->paginate(12)->withQueryString();

        return view('admin.flights.index', compact('flights'));
    }

    // إنشاء رحلة جديدة
    public function create()
    {
        return view('admin.flights.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_number'=>'required|string',
            'airline'=>'required|string',
            'aircraft'=>'nullable|string',
            'departure_city'=>'required|string',
            'arrival_city'=>'required|string',
            'departure_time'=>'required|date',
            'arrival_time'=>'required|date',
            'price'=>'required|numeric',
            'seats'=>'nullable|integer',
        ]);

        $flight = Flight::create($data);

        // تسجيل النشاط
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'أضاف رحلة جديدة',
            'details' => 'رقم الرحلة: '.$flight->flight_number,
        ]);

        return redirect()->route('admin.flights.index')->with('success','تم إضافة الرحلة');
    }

    // تعديل رحلة
    public function edit(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    public function update(Request $request, Flight $flight)
    {
        $data = $request->validate([
            'flight_number'=>'required|string',
            'airline'=>'required|string',
            'aircraft'=>'nullable|string',
            'departure_city'=>'required|string',
            'arrival_city'=>'required|string',
            'departure_time'=>'required|date',
            'arrival_time'=>'required|date',
            'price'=>'required|numeric',
            'seats'=>'nullable|integer',
        ]);

        $flight->update($data);

        return redirect()->route('admin.flights.index')->with('success','تم تحديث الرحلة بنجاح');
    }

    // حذف رحلة
    public function destroy(Flight $flight)
    {
        $flight->delete();
        return redirect()->route('admin.flights.index')->with('success','تم حذف الرحلة بنجاح');
    }

    // عرض تفاصيل الرحلة
    public function show(Flight $flight)
    {
        return view('admin.flights.show', compact('flight'));
    }

    // تصدير الرحلات إلى Excel
   // public function exportFlights()
    //{
        //return Excel::download(new FlightsExport, 'flights.xlsx');
   // }
}
