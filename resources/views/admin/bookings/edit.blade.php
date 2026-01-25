@extends('layouts.admin')

@section('title', 'تعديل الحجز')

@section('content')
<div class="container">
    <h3 class="mb-4">تعديل الحجز</h3>

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">اسم العميل</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" value="{{ $booking->customer_name }}" required>
        </div>

        <div class="mb-3">
            <label for="customer_email" class="form-label">البريد الإلكتروني</label>
            <input type="email" name="customer_email" class="form-control" id="customer_email" value="{{ $booking->customer_email }}" required>
        </div>

        <div class="mb-3">
            <label for="flight_id" class="form-label">اختر الرحلة</label>
            <select name="flight_id" class="form-select" id="flight_id" required>
                @foreach(\App\Models\Flight::orderBy('departure_time')->get() as $flight)
                    <option value="{{ $flight->id }}" @if($booking->flight_id == $flight->id) selected @endif>
                        {{ $flight->flight_number }} - {{ $flight->airline }} ({{ $flight->departure_city }} → {{ $flight->arrival_city }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="seat_type" class="form-label">نوع المقعد</label>
            <select name="seat_type" id="seat_type" class="form-select" required>
                @php
                    $seat_types = ['economy' => 'اقتصادي', 'business' => 'أعمال', 'vip' => 'VIP'];
                @endphp
                @foreach($seat_types as $key => $label)
                    <option value="{{ $key }}" @if($booking->seat_type == $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="seat_price" class="form-label">سعر المقعد الفردي (USD)</label>
            <input type="number" name="seat_price" id="seat_price" class="form-control" value="{{ $booking->seat_price }}" required>
        </div>

        <div class="mb-3">
            <label for="seats" class="form-label">عدد المقاعد</label>
            <input type="number" name="seats" class="form-control" id="seats" value="{{ $booking->seats }}" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">السعر الإجمالي (USD)</label>
            <input type="number" name="total_price" class="form-control" id="total_price" value="{{ $booking->total_price }}" readonly>
        </div>

        <button type="submit" class="btn btn-success">تحديث الحجز</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>

<script>
    const seatsInput = document.getElementById('seats');
    const seatPriceInput = document.getElementById('seat_price');
    const totalPriceInput = document.getElementById('total_price');

    function updateTotal() {
        const seats = parseInt(seatsInput.value) || 0;
        const seatPrice = parseFloat(seatPriceInput.value) || 0;
        totalPriceInput.value = (seats * seatPrice).toFixed(2);
    }

    seatsInput.addEventListener('input', updateTotal);
    seatPriceInput.addEventListener('input', updateTotal);

    // حساب المبدئي عند تحميل الصفحة
    updateTotal();
</script>

@endsection
