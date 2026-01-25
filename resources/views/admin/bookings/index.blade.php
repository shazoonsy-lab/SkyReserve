@extends('layouts.admin')

@section('title', 'إدارة الحجوزات')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>الحجوزات</h3>
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> إضافة حجز
        </a>
    </div>

    <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="flight_id" placeholder="رقم الرحلة" class="form-control">
        <input type="text" name="user_id" placeholder="الموظف" class="form-control">
        <input type="date" name="from_date" class="form-control">
        <input type="date" name="to_date" class="form-control">
        <button type="submit" class="btn btn-primary">فلترة</button>
    </form>

    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>العميل</th>
                        <th>البريد</th>
                        <th>الرحلة</th>
                        <th>المقاعد</th>
                        <th>نوع المقعد</th>
                        <th>السعر الفردي</th>
                        <th>الإجمالي</th>
                        <th>الحالة</th>
                        <th>الموظف</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->customer_name }}</td>
                            <td>{{ $booking->customer_email }}</td>
                            <td>
                                {{ $booking->flight->flight_number ?? '-' }}
                                <br>
                                <small class="text-muted">{{ $booking->flight->airline ?? '-' }}</small>
                            </td>
                            <td>{{ $booking->seats }}</td>
                            <td>{{ ucfirst($booking->seat_type) }}</td>
                            <td>{{ $booking->seat_price }} USD</td>
                            <td>{{ $booking->total_price }} USD</td>
                            <td>
                                @php
                                    $colors = [
                                        'pending' => 'warning',
                                        'admin_ok' => 'success',
                                        'rejected' => 'danger',
                                        'completed' => 'primary',
                                    ];
                                @endphp


                                <span class="badge bg-{{ $colors[$booking->status] ?? 'secondary' }}">
                                    @php
$labels = [
    'pending'     => 'قيد المراجعة',
    'employee_ok' => 'موافقة الموظف',
    'admin_ok'    => 'موافقة المدير',
    'rejected'    => 'مرفوض'
];
@endphp

{{ $labels[$booking->status] ?? $booking->status }}


                                </span>
                            </td>
                            <td>{{ $booking->employee->name ?? '—' }}</td>
                            <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info mb-1">عرض</a>
                                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning mb-1">تعديل</a>
                                
                                {{-- أزرار تغيير الحالة --}}
                                <div class="mt-1">

                                   <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}" class="d-inline">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" value="admin_ok">
    <button class="btn btn-success btn-sm mb-1">موافقة</button>
</form>

<form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}" class="d-inline">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" value="rejected">
    <button class="btn btn-danger btn-sm mb-1">رفض</button>
</form>


                                    {{-- قيد المراجعة --}}
                                    <form method="POST"
                                          action="{{ route('admin.bookings.updateStatus', $booking->id) }}"
                                          class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="pending">
                                        <button class="btn btn-secondary btn-sm mb-1"
                                                {{ $booking->status === 'pending' ? 'disabled' : '' }}>
                                            قيد المراجعة
                                        </button>
                                    </form>

                                </div>

                                {{-- زر الحذف --}}
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mb-1"
                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">لا توجد حجوزات حالياً</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection
