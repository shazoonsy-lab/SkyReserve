@extends('layouts.user2')



@section('title', 'الدفع | SkyReserve')

@section('content')


<div class="container my-5">
    <h2 class="fw-bold mb-4">💳 دفع الحجز #{{ $booking->id }}</h2>

    <p>المبلغ الإجمالي: <strong>{{ number_format($booking->total_price) }} USD</strong></p>

    <h5 class="mb-3">اختر طريقة الدفع:</h5>

    <form action="{{ route('user.bookings.processPayment', $booking->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="radio" name="payment_method" value="credit_card" id="credit" checked>
            <label for="credit">بطاقة ائتمانية</label>
        </div>

        <div class="mb-3">
            <input type="radio" name="payment_method" value="paypal" id="paypal">
            <label for="paypal">PayPal</label>
        </div>

        <div class="mb-3">
            <input type="radio" name="payment_method" value="cash" id="cash">
            <label for="cash">الدفع عند المطار</label>
        </div>

        <button type="submit" class="btn btn-success w-100">💳 دفع الآن</button>
    </form>
</div>
@endsection
