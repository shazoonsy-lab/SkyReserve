@extends('layouts.user2')

@section('title', 'تأكيد الحجز')

@section('content')

<div class="row">
    <div class="col-md-7">
    <form method="POST" action="{{ route('user.bookings.store', $flight->id) }}">
    @csrf

    <h5 class="fw-bold mb-3">🧍‍♂️ بيانات المسافر</h5>

    <div class="mb-3">
        <label class="form-label">الاسم الكامل</label>
        <input type="text"
               name="customer_name"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email"
               name="customer_email"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">رقم الهاتف</label>
        <input type="text"
               name="phone"
               class="form-control"
               required>
    </div>

    <hr>

    <h5 class="fw-bold mb-3">✈️ تفاصيل الحجز</h5>

    <div class="mb-3">
        <label class="form-label">عدد المقاعد</label>
        <input type="number"
               name="seats"
               min="1"
               max="5"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">نوع المقعد</label>
        <select name="seat_type" class="form-select">
            <option value="economy">اقتصادي</option>
            <option value="business">رجال أعمال (+50%)</option>
            <option value="first">درجة أولى (×2)</option>
        </select>
    </div>

    <button class="btn btn-primary w-100">
        تأكيد الحجز
    </button>
</form>


        </div>
    </div>
</div>

@endsection
