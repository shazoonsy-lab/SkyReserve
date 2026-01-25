@extends('employee.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">تفاصيل الرحلة</h2>

    <div class="card p-4">

        <p><strong>رقم الرحلة:</strong> {{ $flight->flight_number }}</p>
        <p><strong>الخطوط الجوية:</strong> {{ $flight->airline }}</p>
        <p><strong>مدينة المغادرة:</strong> {{ $flight->departure_city }}</p>
        <p><strong>مدينة الوصول:</strong> {{ $flight->arrival_city }}</p>
        <p><strong>وقت المغادرة:</strong> {{ $flight->departure_time }}</p>
        <p><strong>وقت الوصول:</strong> {{ $flight->arrival_time }}</p>
        <p><strong>السعر:</strong> {{ $flight->price }} $</p>

        <a href="{{ route('employee.flights.index') }}" class="btn btn-secondary">
            رجوع
        </a>

    </div>
</div>
@endsection
