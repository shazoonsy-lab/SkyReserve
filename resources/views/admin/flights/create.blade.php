
@extends('layouts.admin')

@section('title', 'أضف رحلة جديدة')

@section('content')
<div class="container">
    <h3 class="mb-4">أضف رحلة جديدة</h3>

    <form action="{{ route('admin.flights.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="flight_number" class="form-label">رقم الرحلة</label>
            <input type="text" name="flight_number" class="form-control" id="flight_number" required>
        </div>
        <div class="mb-3">
            <label for="airline" class="form-label">شركة الطيران</label>
            <input type="text" name="airline" class="form-control" id="airline" required>
        </div>
        <div class="mb-3">
            <label for="aircraft" class="form-label">نوع الطائرة</label>
            <input type="text" name="aircraft" class="form-control" id="aircraft">
        </div>
        <div class="mb-3">
            <label for="departure_city" class="form-label">مدينة المغادرة</label>
            <input type="text" name="departure_city" class="form-control" id="departure_city" required>
        </div>
        <div class="mb-3">
            <label for="arrival_city" class="form-label">مدينة الوصول</label>
            <input type="text" name="arrival_city" class="form-control" id="arrival_city" required>
        </div>
        <div class="mb-3">
            <label for="departure_time" class="form-label">وقت المغادرة</label>
            <input type="datetime-local" name="departure_time" class="form-control" id="departure_time" required>
        </div>
        <div class="mb-3">
            <label for="arrival_time" class="form-label">وقت الوصول</label>
            <input type="datetime-local" name="arrival_time" class="form-control" id="arrival_time" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">السعر (USD)</label>
            <input type="number" name="price" class="form-control" id="price" required>
        </div>
        <div class="mb-3">
            <label for="seats" class="form-label">عدد المقاعد</label>
            <input type="number" name="seats" class="form-control" id="seats">
        </div>
        <button type="submit" class="btn btn-success">إضافة الرحلة</button>
        <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection