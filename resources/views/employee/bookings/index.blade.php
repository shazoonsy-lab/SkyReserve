@extends('employee.layout')

@section('title', 'حجوزات الموظف')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">📑 الحجوزات</h3>
        <a href="{{ route('employee.bookings.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> إضافة حجز
        </a>
    </div>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="بحث بالاسم أو البريد">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">كل الحالات</option>
                <option value="pending" @selected(request('status')=='pending')>معلق</option>
                <option value="approved" @selected(request('status')=='approved')>موافق عليه</option>
                <option value="rejected" @selected(request('status')=='rejected')>مرفوض</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">بحث</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('employee.bookings.index') }}" class="btn btn-secondary w-100">إعادة تعيين</a>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>العميل</th>
                            <th>البريد</th>
                            <th>الرحلة</th>
                            <th>عدد المقاعد</th>
                            <th>نوع المقعد</th>
                            <th>السعر الإجمالي</th>
                            <th>تاريخ الحجز</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $statuses = ['pending'=>'قيد المراجعة','approved'=>'مقبول','rejected'=>'مرفوض'];
                            $colors = ['pending'=>'warning','approved'=>'success','rejected'=>'danger'];
                        @endphp

                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->customer_email }}</td>
                                <td>{{ $booking->flight->flight_number ?? '-' }}</td>
                                <td>{{ $booking->seats }}</td>
                                <td>{{ ucfirst($booking->seat_type) }}</td>
                                <td>{{ number_format($booking->total_price, 2) }} USD</td>
                                <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('employee.bookings.show', $booking->id) }}" class="btn btn-info btn-sm mb-1">عرض</a>
                                    <a href="{{ route('employee.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm mb-1">تعديل</a>
                                  
                                 
                                    <span class="badge bg-{{ $colors[$booking->status] ?? 'secondary' }}">
                                        {{ $statuses[$booking->status] ?? $booking->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">لا توجد حجوزات حالياً</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
@endsection
