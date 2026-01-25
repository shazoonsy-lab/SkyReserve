@extends('layouts.admin')

@section('title','تفاصيل الرحلة')
@section('content')
<div class="container mt-4">

    <div class="card p-4 shadow-sm">
        <h3 class="mb-3">تفاصيل الرحلة: {{ $flight->flight_number }}</h3>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>الخط</th>
                    <td>{{ $flight->airline }}</td>
                </tr>
                <tr>
                    <th>الطائرة</th>
                    <td>{{ $flight->aircraft ?? '-' }}</td>
                </tr>
                <tr>
                    <th>مدينة المغادرة</th>
                    <td>{{ $flight->departure_city }}</td>
                </tr>
                <tr>
                    <th>مدينة الوصول</th>
                    <td>{{ $flight->arrival_city }}</td>
                </tr>
                <tr>
                    <th>وقت المغادرة</th>
                    <td>{{ $flight->departure_time->format('Y-m-d H:i') }}</td>
                </tr>
                <tr>
                    <th>وقت الوصول</th>
                    <td>{{ $flight->arrival_time->format('Y-m-d H:i') }}</td>
                </tr>
                <tr>
                    <th>السعر</th>
                    <td>{{ $flight->price }} USD</td>
                </tr>
                <tr>
                    <th>عدد المقاعد</th>
                    <td>{{ $flight->seats ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary mt-3">
            العودة إلى إدارة الرحلات
        </a>
    </div>
</div>
@endsection
