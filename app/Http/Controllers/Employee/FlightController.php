<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Flight;

class FlightController extends Controller
{
    // عرض جميع الرحلات
    public function index()
    {
    
        // جلب نفس الرحلات التي أنشأها الأدمن
        $flights = Flight::orderBy('departure_time', 'asc')->paginate(10);

        return view('employee.flights.index', compact('flights'));
    }

    public function show($id)
    {
        $flight = Flight::findOrFail($id);

        return view('employee.flights.show', compact('flight'));
    }
}

