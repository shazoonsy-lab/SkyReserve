@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow p-4">

                <h4 class="fw-bold mb-3 text-center">🚀 دخول سريع</h4>

                <form method="POST" action="{{ route('quick.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               required>
                    </div>

                    <button class="btn btn-primary w-100">
                        دخول
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
