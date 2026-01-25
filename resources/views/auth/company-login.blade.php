@extends('layouts.guest')

@section('title', 'تسجيل دخول الشركة | SkyReserve')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 420px; width:100%;">
        
        <div class="card-header text-center bg-dark text-white rounded-top-4">
            <h4 class="mb-0">🔐 دخول لوحة الشركة</h4>
            <small>للموظفين والمدير فقط</small>
        </div>

        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Remember -->
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">تذكرني</label>
                </div>

                <button class="btn btn-dark w-100">
                    تسجيل الدخول
                </button>
            </form>

        </div>

        <div class="card-footer text-center small text-muted">
            © {{ date('Y') }} SkyReserve
        </div>
    </div>
</div>
@endsection
