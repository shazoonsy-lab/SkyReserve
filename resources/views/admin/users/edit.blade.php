@extends('layouts.admin')

@section('content')
<h1>تعديل بيانات المستخدم</h1>

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>الاسم</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label>كلمة المرور (اتركها فارغة إذا لم ترغب بتغييرها)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>الدور</label>
        <select name="role" class="form-control">
            @foreach($roles as $role)
                <option value="{{ $role->name }}" @if($user->roles->pluck('name')->contains($role->name)) selected @endif>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">تحديث</button>
</form>
@endsection
