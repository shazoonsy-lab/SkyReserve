<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;

class DashboardController extends Controller
{
    public function index()
    {
        $bookingsCount = Booking::count();
        $flightsCount = Flight::count();
        $pendingBookings = Booking::where('status', 'pending')->count();

        $latestFlights = Flight::orderBy('departure_time', 'asc')
            ->take(5)
            ->get();

        $flights = Flight::orderBy('departure_time', 'asc')->get();

        $notifications = auth()->user()
            ->notifications()
            ->reorder('created_at', 'desc')
            ->take(10)
            ->get();

        return view('employee.dashboard', compact(
            'bookingsCount',
            'flightsCount',
            'pendingBookings',
            'latestFlights',
            'flights',
            'notifications'
        ));
    }
}
