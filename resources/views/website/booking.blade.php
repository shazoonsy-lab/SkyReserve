@extends('layouts.guest')

@section('title', 'حجز رحلة')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">✈️ تأكيد حجز الرحلة</h2>

    <div class="card shadow-lg mx-auto" style="max-width:600px">
        <div class="card-body">

            <form method="POST" action="{{ route('booking.store') }}">
                @csrf

                <input type="hidden" name="flight_id" value="{{ request('flight') }}">

                <div class="mb-3">
                    <label class="form-label">الاسم الكامل</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                 <div class="mb-3">
        <label class="form-label">عدد المقاعد</label>
        <input type="number"
               name="seats"
               min="1"
               max="5"
               class="form-control"
               required>
    </div>

      <select id="seat_type" name="seat_type" class="form-select" required>
    <option value="economy">اقتصادي</option>
    <option value="business">رجال أعمال</option>
    <option value="first">درجة أولى</option>
</select>

<input type="number" id="seats" name="seats" class="form-control" value="1" min="1" required>

<div class="alert alert-info mt-3">
    💰 السعر الإجمالي:
    <strong>
        <span id="totalPrice">50</span> $
    </strong>
</div>

<div class="mb-3 mt-4">
    <label class="form-label fw-bold">💳 طريقة الدفع</label>

    <div class="form-check">
        <input class="form-check-input"
               type="radio"
               name="payment_method"
               id="cash"
               value="cash"
               checked>
        <label class="form-check-label" for="cash">
            💵 نقدي
        </label>
    </div>

    <div class="form-check mt-2">
        <input class="form-check-input"
               type="radio"
               name="payment_method"
               id="card"
               value="card">
        <label class="form-check-label" for="card">
            💳 بطاقة بنكية
        </label>
    </div>
</div>



                <button class="btn btn-primary w-100">
                    تأكيد الحجز ✅
                </button>
            </form>

        </div>
    </div>
</div>

<script>
    const seatPrices = {
        economy: 500,
        business: 700,
        first: 1000
    };

    function updatePrice() {
        const seatType = document.getElementById('seat_type').value;
        const seats = parseInt(document.getElementById('seats').value || 1);
        const total = seatPrices[seatType] * seats;

        document.getElementById('totalPrice').innerText = total;
    }

    document.getElementById('seat_type').addEventListener('change', updatePrice);
    document.getElementById('seats').addEventListener('input', updatePrice);

    updatePrice();
</script>

@endsection

