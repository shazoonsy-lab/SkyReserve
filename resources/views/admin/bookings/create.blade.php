@extends('layouts.admin')

@section('title', 'أضف حجز جديد')

@section('content')
<div class="container">
    <h3 class="mb-4">أضف حجز جديد</h3>

    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">اسم العميل</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="customer_email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">اختر الرحلة</label>
            <select name="flight_id" class="form-select" required>
                @foreach($flights as $flight)
                    <option value="{{ $flight->id }}">
                        {{ $flight->flight_number }} ({{ $flight->airline }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">نوع المقعد</label>
            <select name="seat_type" id="seat_type" class="form-select" required>
                <option value="economy">اقتصادي</option>
                <option value="business">أعمال</option>
                <option value="vip">VIP</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">السعر الفردي (USD)</label>
            <input type="number" name="seat_price" id="seat_price" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">عدد المقاعد</label>
            <input type="number" name="seats" id="seats" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">السعر الإجمالي (USD)</label>
            <input type="number" name="total_price" id="total_price" class="form-control" readonly>
        </div>

        <button class="btn btn-success">إضافة الحجز</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>

<script>
const seatPrices = {
    economy: 500,
    business: 700,
    vip: 1000
};

const seatType = document.getElementById('seat_type');
const seatPrice = document.getElementById('seat_price');
const seats = document.getElementById('seats');
const totalPrice = document.getElementById('total_price');

function updatePrice() {
    const price = seatPrices[seatType.value];
    seatPrice.value = price;
    totalPrice.value = price * (parseInt(seats.value) || 0);
}

seatType.addEventListener('change', updatePrice);
seats.addEventListener('input', updatePrice);

updatePrice();
</script>
@endsection
