@extends('layouts.app')

@section('title', 'غير مسموح')

@section('content')
<div class="container text-center" style="margin-top:100px;">
    <h1 class="display-4">403</h1>
    <h2>عذرًا! لا تملك الصلاحية للوصول إلى هذه الصفحة.</h2>
    <p>إذا كنت تعتقد أن هذا خطأ، يرجى التواصل مع المسؤول.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">العودة إلى الصفحة الرئيسية</a>
</div>
@endsection
