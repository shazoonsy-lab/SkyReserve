@extends('layouts.admin')

@section('content')
<h1>إضافة مستخدم جديد</h1>

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <div class="mb-3">
        <label>الاسم</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>كلمة المرور</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>الدور</label>
        <select name="role" class="form-control">
            @foreach($roles as $role)
              <option value="{{ $role }}">{{ ucfirst($role) }}</option>
  
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">حفظ</button>
</form>
@endsection
