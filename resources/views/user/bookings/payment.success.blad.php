@extends('layouts.user2')

@section('title', 'تم الدفع بنجاح')

@section('content')
<div class="container text-center my-5">
    <h2 class="text-success fw-bold">✅ تم الدفع بنجاح</h2>
    <p class="mt-3">تم تأكيد حجزك بنجاح، نتمنى لك رحلة سعيدة ✈️</p>

    <a href="{{ route('user.bookings.index') }}"
       class="btn btn-primary mt-4">
        عرض حجوزاتي
    </a>
</div>
@endsection
