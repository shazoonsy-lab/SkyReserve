@extends('employee.layout')

@section('title', 'تفاصيل الحجز')

@section('content')

<div class="container-fluid">

    <h3 class="mb-3">تفاصيل الحجز</h3>

    <div class="card p-4 shadow-sm">

        <p><strong>العميل:</strong> {{ $booking->customer_name }}</p>
        <p><strong>البريد:</strong> {{ $booking->customer_email }}</p>
        <p><strong>الرحلة:</strong> {{ $booking->flight->flight_number ?? '-' }}</p>
        <p><strong>عدد المقاعد:</strong> {{ $booking->seats }}</p>
        <p><strong>نوع المقعد:</strong> {{ ucfirst($booking->seat_type) }}</p>
        <p><strong>السعر الكلي:</strong> {{ $booking->total_price }} USD</p>
        <p><strong>التاريخ:</strong> {{ $booking->created_at->format('Y-m-d H:i') }}</p>

        <a href="{{ route('employee.bookings.index') }}" class="btn btn-secondary mt-3">رجوع</a>

        @if(!$booking->payment)
            <form method="POST" action="{{ route('employee.bookings.payments', $booking->id) }}" class="mt-3">
                @csrf

                <label for="payment_method" class="form-label">طريقة الدفع:</label>
                <select name="payment_method" id="payment_method" class="form-select mb-2">
                    <option value="card">بطاقة بنكية</option>
                    
                    <option value="cash">نقدًا</option>
                </select>

                <button type="submit" class="btn btn-success btn-sm">
                    إتمام الدفع
                </button>
            </form>
        @else
            <span class="badge bg-success mt-3">مدفوع</span>
        @endif

    </div>

</div>

@endsection
