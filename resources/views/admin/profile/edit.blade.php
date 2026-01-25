@extends('layouts.admin')

@section('content')
<h1>إعدادات الحساب</h1>

<form method="POST" action="{{ route('admin.profile.update') }}">
    @csrf @method('PUT')
     <!-- الصورة الحالية -->
    <div class="mb-3">
        @if(auth()->user()->profile_photo)
            <img src="{{ asset('storage/profile_photos/' . auth()->user()->profile_photo) }}"
                 alt="Profile Photo" width="120" class="rounded-circle mb-2">
        @endif
        <input type="file" name="profile_photo" class="form-control">
    </div>
    <div class="mb-3">
        <label>الاسم</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label>كلمة المرور الجديدة</label>
        <input type="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">حفظ التغييرات</button>
</form>
@endsection
