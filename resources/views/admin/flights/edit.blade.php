@extends('layouts.admin')

@section('title','تعديل الرحلة')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">تعديل الرحلة: {{ $flight->flight_number }}</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.flights.update', $flight->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="flight_number" class="form-label">رقم الرحلة</label>
                    <input type="text" name="flight_number" id="flight_number" class="form-control" value="{{ old('flight_number', $flight->flight_number) }}" required>
                </div>

                <div class="mb-3">
                    <label for="airline" class="form-label">الخط</label>
                    <input type="text" name="airline" id="airline" class="form-control" value="{{ old('airline', $flight->airline) }}" required>
                </div>

                <div class="mb-3">
                    <label for="aircraft" class="form-label">نوع الطائرة</label>
                    <input type="text" name="aircraft" id="aircraft" class="form-control" value="{{ old('aircraft', $flight->aircraft) }}">
                </div>

                <div class="mb-3">
                    <label for="departure_city" class="form-label">مدينة المغادرة</label>
                    <input type="text" name="departure_city" id="departure_city" class="form-control" value="{{ old('departure_city', $flight->departure_city) }}" required>
                </div>

                <div class="mb-3">
                    <label for="arrival_city" class="form-label">مدينة الوصول</label>
                    <input type="text" name="arrival_city" id="arrival_city" class="form-control" value="{{ old('arrival_city', $flight->arrival_city) }}" required>
                </div>

                <div class="mb-3">
                    <label for="departure_time" class="form-label">تاريخ ووقت المغادرة</label>
                    <input type="datetime-local" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time', $flight->departure_time ? $flight->departure_time->format('Y-m-d\TH:i') : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="arrival_time" class="form-label">تاريخ ووقت الوصول</label>
                    <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control" value="{{ old('arrival_time', $flight->arrival_time ? $flight->arrival_time->format('Y-m-d\TH:i') : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">السعر (USD)</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $flight->price) }}" required>
                </div>

                <div class="mb-3">
                    <label for="seats" class="form-label">عدد المقاعد المتاحة</label>
                    <input type="number" name="seats" id="seats" class="form-control" value="{{ old('seats', $flight->seats) }}">
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i> حفظ التغييرات</button>
                <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>

</div>
@endsection
