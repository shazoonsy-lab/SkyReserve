@extends('layouts.guest')

@section('title', 'الرحلات المتاحة')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold mb-5 text-center">✈️ الرحلات المتاحة</h2>

    <div class="row g-4">
        @forelse ($flights as $flight)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0 rounded-4">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-3">
                            {{ $flight->from }} ➜ {{ $flight->to }}
                        </h5>

                        <p class="card-text text-muted mb-3">
                            📅 <strong>تاريخ الإقلاع:</strong> {{ $flight->departure_date }} <br>
                            💺 <strong>المقاعد المتاحة:</strong> {{ $flight->seats }}
                        </p>

                        <div class="alert alert-light text-center small mb-4">
                            💺 سعر المقعد يُحدَّد أثناء الحجز
                        </div>

                        <a href="{{ route('flights.show', $flight) }}"
                           class="btn btn-primary mt-auto w-100 rounded-pill">
                            عرض التفاصيل والحجز
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="text-center text-muted">
                لا توجد رحلات متاحة حاليًا
            </div>
        @endforelse
    </div>

</div>
@endsection
