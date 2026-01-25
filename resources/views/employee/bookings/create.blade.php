@extends('employee.layout')

@section('title', 'إضافة حجز جديد')

@section('content')

<div class="container-fluid">

    <h3 class="mb-3">إضافة حجز جديد</h3>

    <div class="card p-4 shadow-sm">

        <form action="{{ route('employee.bookings.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">اختر الرحلة</label>
                <select class="form-control" name="flight_id" id="flight_id" required>
                    <option value="">-- اختر الرحلة --</option>
                    @foreach($flights as $flight)
                        <option value="{{ $flight->id }}">
                            {{ $flight->flight_number }} - {{ $flight->airline }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">اسم العميل</label>
                <input type="text" class="form-control" name="customer_name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" name="customer_email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">عدد المقاعد</label>
                <input type="number" min="1" class="form-control" name="seats" id="seats" value="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">نوع المقعد</label>
                <select class="form-control" name="seat_type" id="seat_type" required>
                    <option value="economy">اقتصادي</option>
                    <option value="business">رجال أعمال</option>
                    <option value="vip">VIP</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">السعر الفردي (USD)</label>
                <input type="number" class="form-control" id="seat_price" name="seat_price" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">السعر الإجمالي (USD)</label>
                <input type="number" class="form-control" id="total_price" name="total_price" readonly>
            </div>

            <button class="btn btn-success">إضافة</button>
            <a href="{{ route('employee.bookings.index') }}" class="btn btn-secondary">رجوع</a>

        </form>
    </div>
</div>

<script>
    const seatPrices = {
        'economy': 500,
        'business': 700,
        'vip': 1000
    };

    const seatType = document.getElementById('seat_type');
    const seats = document.getElementById('seats');
    const seatPrice = document.getElementById('seat_price');
    const totalPrice = document.getElementById('total_price');

    function updatePrices() {
        const pricePerSeat = seatPrices[seatType.value] || 0;
        seatPrice.value = pricePerSeat;
        totalPrice.value = pricePerSeat * (parseInt(seats.value) || 0);
    }

    seatType.addEventListener('change', updatePrices);
    seats.addEventListener('input', updatePrices);

    // تهيئة القيم عند تحميل الصفحة
    updatePrices();
</script>

@endsection
