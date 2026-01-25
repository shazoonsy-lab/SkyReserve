@extends('layouts.guest')

@section('title', 'تم تأكيد الحجز')

@section('content')
<div class="container py-5 text-center">
    <div class="card shadow-lg p-4 mx-auto" style="max-width:500px">
        <h2 class="text-success fw-bold mb-3">✅ تم تأكيد حجزك</h2>

        <p class="mb-2">رقم الحجز:</p>
        <h4 class="fw-bold text-primary">{{ $code }}</h4>

        <p class="mt-3">
            سيتم إرسال تفاصيل الحجز إلى بريدك الإلكتروني.
        </p>

        <a href="{{ route('home') }}" class="btn btn-outline-primary mt-4">
            العودة للصفحة الرئيسية
        </a>
    </div>
</div>
@endsection
