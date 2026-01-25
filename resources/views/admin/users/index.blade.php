@extends('layouts.admin')

@section('content')
<h1>المستخدمون</h1>
<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">إضافة مستخدم جديد</a>

<table class="table table-striped">
<thead>
<tr>
<th>الاسم</th>
<th>البريد الإلكتروني</th>
<th>الدور</th>
<th>خيارات</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->roles->pluck('name')->join(', ') }}</td>
<td>
    <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-sm btn-warning">تعديل</a>
    <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST" style="display:inline-block;">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger" onclick="return confirm('هل تريد حذف المستخدم؟')">حذف</button>
    </form>
</td>
</tr>
@endforeach
</tbody>
</table>
@endsection
