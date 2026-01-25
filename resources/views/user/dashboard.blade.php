@extends('layouts.user2')

@section('title', 'SkyReserve | الرئيسية')

@section('content')

<!-- Hero -->
<div class="p-5 mb-5 rounded-4 text-white"
     style="background: linear-gradient(120deg, #0d6efd, #003566);">
    <div class="container">
        <h1 class="fw-bold mb-2">مرحبًا بك في SkyReserve ✈️</h1>
        <p class="lead mb-0">
            احجز رحلتك بسهولة، بدون تسجيل، وادفع بالطريقة التي تناسبك
        </p>
    </div>
</div>

<div class="row g-4 mb-5">

    <!-- عدد الرحلات -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4 h-100">
            <div class="fs-1 mb-2">🌍</div>
            <h6 class="text-muted">الرحلات المتاحة</h6>
            <h2 class="fw-bold">{{ $flightsCount }}</h2>
        </div>
    </div>

    <!-- ميزة -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4 h-100">
            <div class="fs-1 mb-2">⚡</div>
            <h6 class="text-muted">حجز سريع</h6>
            <p class="mb-0">بدون تسجيل أو تعقيدات</p>
        </div>
    </div>

    <!-- CTA -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4 h-100 text-white"
             style="background: linear-gradient(120deg, #5258aa, #90a1ce);">
            <div class="fs-1 mb-2">🚀</div>
            <h6>جاهز لرحلتك القادمة؟</h6>
            <a href="{{ route('user.flights.index') }}"
               class="btn btn-light fw-bold mt-2">
                استعرض الرحلات
            </a>
        </div>
    </div>

</div>

<!-- أقرب الرحلات -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">✈️ أقرب الرحلات</h4>
    <a href="{{ route('user.flights.index') }}" class="text-decoration-none">
        عرض الكل →
    </a>
</div>

<div class="row g-4 mb-5">
    @forelse($latestFlights as $flight)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">

                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTASJeO5m0_y4MDW9ak9xhYzJ4QhAO5qgG9WQ&s"
                     class="card-img-top"
                     style="height: 200px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold mb-1">
                        {{ $flight->departure_city }} → {{ $flight->arrival_city }}
                    </h5>

                    <span class="text-muted small mb-2">
                        {{ $flight->airline }}
                    </span>

                    <span class="mb-2">
                        🕒 {{ $flight->departure_time }}
                    </span>

                    <h5 class="text-success fw-bold mt-auto">
                        {{ number_format($flight->price) }} USD
                    </h5>

                    <a href="{{ route('user.bookings.create', $flight->id) }}"
                       class="btn btn-primary w-100 mt-3">
                        احجز الآن
                    </a>
                </div>

            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted">
            لا توجد رحلات حالياً
        </div>
    @endforelse
</div>

@endsection
