@extends('employee.layout')

@section('title', 'البروفايل')

@section('content')
<div class="container">
    <h2 class="mb-4">البروفايل الشخصي</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('employee.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}">
        </div>

        <div class="mb-3">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
        </div>

        <div class="mb-3">
            <label>كلمة المرور الجديدة (اختياري)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>تأكيد كلمة المرور</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">تحديث البيانات</button>
    </form>
</div>
@endsection
