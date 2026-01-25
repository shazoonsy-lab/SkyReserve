<?php

namespace App\Http\Controllers;

use App\Models\Flight;

class PublicFlightController extends Controller
{
    // عرض جميع الرحلات
    public function index()
    {
        $flights = Flight::where('status', 'active')->latest()->get();
        return view('website.flights.index', compact('flights'));
    }

    // تفاصيل رحلة
    public function show(Flight $flight)
    {
        return view('website.flights.show', compact('flight'));
    }
}
