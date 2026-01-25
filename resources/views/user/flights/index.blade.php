@extends('layouts.user2')

@section('title', 'الرحلات | SkyReserve')

@section('content')

<h2 class="fw-bold mb-4">✈️ الرحلات المتاحة</h2>

{{-- Filter --}}
<form method="GET" class="row mb-4">
    <div class="col-md-4">
        <input type="text" name="from" class="form-control"
               placeholder="من (مدينة المغادرة)"
               value="{{ request('from') }}">
    </div>

    <div class="col-md-4">
        <input type="text" name="to" class="form-control"
               placeholder="إلى (مدينة الوصول)"
               value="{{ request('to') }}">
    </div>

    <div class="col-md-4">
        <button class="btn btn-primary w-100">بحث</button>
    </div>
</form>

<div class="row">
@forelse($flights as $flight)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">

            {{-- صورة الرحلة --}}
            <img src="https://tse1.explicit.bing.net/th/id/OIP.a_8Z_MrcV1qX8MZ_wVI16wHaEJ?rs=1&pid=ImgDetMain&o=7&rm=3"
                 class="card-img-top"
                 style="height:200px; object-fit:cover;">

            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold mb-1">
                    {{ $flight->departure_city }} → {{ $flight->arrival_city }}
                </h5>

                <p class="text-muted mb-1">✈️ رقم الرحلة: {{ $flight->flight_number }}</p>
                <p class="text-muted mb-1">🕒 {{ $flight->departure_time->format('Y-m-d H:i') }}</p>

                {{-- الأسعار حسب نوع المقعد --}}
                <p class="mb-2">
                    💺 Economy: <span class="fw-bold text-success">{{ number_format($flight->economy_price) }} USD</span><br>
                    💼 Business: <span class="fw-bold text-success">{{ number_format($flight->business_price) }} USD</span>
                </p>

                <a href="{{ route('user.bookings.create', $flight->id) }}"
                   class="btn btn-outline-primary mt-auto w-100">
                    احجز الآن
                </a>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">لا توجد رحلات مطابقة</p>
@endforelse
</div>

<div class="mt-4">
    {{ $flights->links() }}
</div>

@endsection
