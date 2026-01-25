<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Booking::with('flight', 'user')->get()->map(function ($booking) {
            return [
                'اسم العميل' => $booking->customer_name,
                'البريد الإلكتروني' => $booking->customer_email,
                'رقم الرحلة' => $booking->flight->flight_number ?? '-',
                'عدد المقاعد' => $booking->seats,
                'نوع المقعد' => $booking->seat_type,
                'سعر المقعد' => $booking->seat_price,
                'الإجمالي' => $booking->total_price,
                'تاريخ الحجز' => $booking->created_at->format('Y-m-d H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'اسم العميل',
            'البريد الإلكتروني',
            'رقم الرحلة',
            'عدد المقاعد',
            'نوع المقعد',
            'سعر المقعد',
            'الإجمالي',
            'تاريخ الحجز'
        ];
    }
}
