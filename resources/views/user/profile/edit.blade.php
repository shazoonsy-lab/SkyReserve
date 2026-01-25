@extends('layouts.app')

@section('content')
<div class="container">
    <h3>الملف الشخصي</h3>

    <form method="POST" action="{{ route('user.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>الاسم</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>البريد</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
        </div>

        <button class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection
