@extends('layouts.admin')
@section('title', 'سجل النشاطات')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">سجل النشاطات</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>المستخدم</th>
                <th>الإجراء</th>
                <th>التفاصيل</th>
                <th>الوقت</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->user->name ?? 'غير معروف' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->details }}</td>
                    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">لا توجد سجلات حتى الآن</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@endsection
