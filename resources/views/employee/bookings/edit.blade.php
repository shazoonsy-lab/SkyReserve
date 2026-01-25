@extends('employee.layout')

@section('title', 'تعديل الحجز')

@section('content')

<div class="container-fluid">

    <h3 class="mb-3">تعديل الحجز</h3>

    <div class="card p-4 shadow-sm">

        <form action="{{ route('employee.bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">اختر الرحلة</label>
                <select class="form-control" name="flight_id" required>
                    @foreach($flights as $flight)
                    <option value="{{ $flight->id }}" 
                        {{ $booking->flight_id == $flight->id ? 'selected' : '' }}>
                        {{ $flight->flight_number }} - {{ $flight->airline }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">اسم العميل</label>
                <input type="text" class="form-control" name="customer_name"
                       value="{{ $booking->customer_name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" name="customer_email"
                       value="{{ $booking->customer_email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">عدد المقاعد</label>
                <input type="number" min="1" class="form-control" name="seats"
                       value="{{ $booking->seats }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">نوع المقعد</label>
                <select class="form-control" name="seat_type" required>
                    <option value="economy" {{ $booking->seat_type == 'economy' ? 'selected' : '' }}>اقتصادي</option>
                    <option value="business" {{ $booking->seat_type == 'business' ? 'selected' : '' }}>رجال أعمال</option>
                    <option value="vip" {{ $booking->seat_type == 'vip' ? 'selected' : '' }}>VIP</option>
                </select>
            </div>

            <button class="btn btn-primary">تحديث</button>
            <a href="{{ route('employee.bookings.index') }}" class="btn btn-secondary">رجوع</a>

        </form>

    </div>
</div>

@endsection
