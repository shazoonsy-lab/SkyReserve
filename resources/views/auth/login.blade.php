@extends('layouts.guest')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-lg border-0 p-4"
         style="max-width:420px; width:100%; background:white; border-radius:18px;">

        <h3 class="text-center fw-bold mb-4 text-dark">تسجيل الدخول</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label text-dark">البريد الإلكتروني</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label text-dark">كلمة المرور</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label text-dark">تذكرني</label>
            </div>

            <button class="btn btn-primary w-100 fw-bold">
                تسجيل الدخول
            </button>
        </form>

    </div>
</div>
@endsection
