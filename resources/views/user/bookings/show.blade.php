@extends('layouts.user2')

@section('title', 'تفاصيل الحجز | SkyReserve')

@section('content')

<div class="container my-5">

    <div class="mb-4">
        <h3 class="fw-bold">📄 تفاصيل الحجز</h3>
        <p class="text-muted">معلومات رحلتك المحجوزة</p>
    </div>

    <div class="row g-4">

        <!-- تفاصيل الرحلة -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">

                <h5 class="fw-bold mb-3">
                    ✈️ {{ $booking->flight->departure_city }}
                    →
                    {{ $booking->flight->arrival_city }}
                </h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">شركة الطيران</small>
                        <div class="fw-bold">{{ $booking->flight->airline }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">موعد الإقلاع</small>
                        <div class="fw-bold">
                            {{ $booking->flight->departure_time->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">عدد المقاعد</small>
                        <div class="fw-bold">{{ $booking->seats }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">نوع المقعد</small>
                        <div class="fw-bold text-capitalize">
                            {{ $booking->seat_type }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">الحالة</small>
                        <div>
                            <span class="badge
                                @if($booking->status === 'confirmed') bg-success
                                @elseif($booking->status === 'pending') bg-warning
                                @else bg-danger @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">تاريخ الحجز</small>
                        <div class="fw-bold">
                            {{ $booking->created_at->format('Y-m-d') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- السعر -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 text-center">

                <small class="text-muted">إجمالي السعر</small>
                <h2 class="fw-bold text-success my-2">
                    {{ number_format($booking->total_price) }} USD
                </h2>

                

            </div>
        </div>

    </div>

</div>

@endsection
