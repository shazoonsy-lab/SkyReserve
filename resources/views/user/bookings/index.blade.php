@extends('layouts.user2')

@section('title', 'حجوزاتي')

@section('content')

<div class="container my-5">
    <h2 class="mb-4 fw-bold">✈️ حجوزاتي</h2>

    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card shadow border-0 h-100">

                    <img src="{{ asset('images/booking.png') }}" class="card-img-top" alt="Flight">

                     



                    <div class="card-body">
                        <h5 class="fw-bold">
                            رحلة رقم {{ $booking->flight->flight_number }}
                        </h5>

                        <p class="mb-1">
                            {{ $booking->flight->from }} →
                            {{ $booking->flight->to }}
                        </p>

                        <p class="mb-1">
                            🕒 {{ $booking->flight->departure_time }}
                        </p>

                        <p class="mb-1">
                            💺 المقاعد: {{ $booking->seats }} ({{ $booking->seat_type }})
                        </p>

                        <p class="mb-2">
                            💰 السعر: {{ $booking->total_price }} USD
                        </p>

                        <span class="badge 
                            @if($booking->status == 'pending') bg-warning
                            @elseif($booking->status == 'approved') bg-success
                            @else bg-danger
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>

                        @if($booking->status == 'approved' && !$booking->is_paid)
                            <div class="mt-3">
                                <a href="{{ route('user.bookings.payment', $booking->id) }}" class="btn btn-primary btn-sm">
                                    💳 الدفع الآن
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <p>لا توجد حجوزات بعد</p>
        @endforelse
    </div>
</div>

@endsection
