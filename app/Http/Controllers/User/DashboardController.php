<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Flight;

class DashboardController extends Controller
{
    public function index()
    {
        // عدد الرحلات المتاحة
        $flightsCount = Flight::count();

        // أحدث الرحلات
        $latestFlights = Flight::orderBy('departure_time', 'asc')
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'flightsCount',
            'latestFlights'
        ));
    }
}
