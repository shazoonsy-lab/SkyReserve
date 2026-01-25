@extends('layouts.user2')

@section('title', 'تم تأكيد طلب الحجز')

@section('content')
<div class="container my-5 text-center">

    <div class="card shadow border-0 p-5">
        <h2 class="text-success mb-3">✅ تم إرسال طلب الحجز بنجاح</h2>

        <p class="fs-5">
            شكراً لك لاختيارك <strong>SkyReserve</strong> ✈️
        </p>

        <p class="text-muted">
            رقم الحجز الخاص بك:
        </p>

        <h4 class="fw-bold text-primary mb-3">
            {{ $booking->booking_code }}
        </h4>

        <p class="mb-4">
            سيتم مراجعة الحجز من قبل فريقنا،  
            وستصلك رسالة تأكيد على البريد الإلكتروني:
            <br>
            <strong>{{ $booking->customer_email }}</strong>
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('user.flights.index') }}" class="btn btn-primary">
                ✈️ حجز رحلة أخرى
            </a>

            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-success">
                    👤 إنشاء حساب لمتابعة حجوزاتك
                </a>
            @endguest
        </div>
    </div>

</div>
@endsection
