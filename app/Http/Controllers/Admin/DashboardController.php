<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $flightCount = Flight::count();
        $bookingCount = Booking::count();
        $totalRevenue = Booking::sum('total_price');
        $mostBookedFlights = Booking::select('flight_id', \DB::raw('count(*) as total'))
            ->groupBy('flight_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();
          $flights = Flight::all(); // أو مع إحصائيات الحجوزات

        return view('admin.dashboard', compact('flightCount','bookingCount','totalRevenue','mostBookedFlights','flights'));
    }
}
