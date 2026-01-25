<?php

namespace App\Exports;

use App\Models\Flight;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FlightsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Flight::select(
            'flight_number',
            'airline',
            'aircraft',
            'departure_city',
            'arrival_city',
            'departure_time',
            'arrival_time',
            'price',
            'seats'
        )->get();
    }

    public function headings(): array
    {
        return [
            'رقم الرحلة',
            'شركة الطيران',
            'الطائرة',
            'مدينة المغادرة',
            'مدينة الوصول',
            'تاريخ ووقت المغادرة',
            'تاريخ ووقت الوصول',
            'السعر (USD)',
            'المقاعد'
        ];
    }
}
