@extends('layouts.admin')

@section('title', 'تفاصيل الحجز')

@section('content')
<div class="container">

    <h3 class="mb-4">تفاصيل الحجز</h3>

    <div class="card shadow-sm p-4" style="background-color: rgba(255,255,255,0.85);">
        <div class="mb-3">
            <h5>العميل:</h5>
            <p>{{ $booking->customer_name }}</p>
        </div>

        <div class="mb-3">
            <h5>البريد الإلكتروني:</h5>
            <p>{{ $booking->customer_email }}</p>
        </div>

        <div class="mb-3">
            <h5>الرحلة:</h5>
            <p>
                {{ $booking->flight->flight_number ?? '-' }} - {{ $booking->flight->airline ?? '-' }}<br>
                {{ $booking->flight->departure_city ?? '-' }} → {{ $booking->flight->arrival_city ?? '-' }}<br>
                تاريخ ووقت المغادرة: {{ optional($booking->flight->departure_time)->format('Y-m-d H:i') ?? '-' }}<br>
                تاريخ ووقت الوصول: {{ optional($booking->flight->arrival_time)->format('Y-m-d H:i') ?? '-' }}
            </p>
        </div>

        <div class="mb-3">
            <h5>نوع المقعد:</h5>
            <p>
                @php
                    $types = ['economy' => 'اقتصادي', 'business' => 'أعمال', 'vip' => 'VIP'];
                @endphp
                {{ $types[$booking->seat_type] ?? '-' }}
            </p>
        </div>

        <div class="mb-3">
            <h5>سعر المقعد الفردي:</h5>
            <p>{{ $booking->seat_price }} USD</p>
        </div>

        <div class="mb-3">
            <h5>عدد المقاعد:</h5>
            <p>{{ $booking->seats }}</p>
        </div>

        <div class="mb-3">
            <h5>السعر الإجمالي:</h5>
            <p>{{ $booking->total_price }} USD</p>
        </div>

        <div class="mb-3">
            <h5>تاريخ الحجز:</h5>
            <p>{{ $booking->created_at->format('Y-m-d H:i') }}</p>
        </div>

        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mt-3">العودة إلى الحجوزات</a>
    </div>

</div>
@endsection
