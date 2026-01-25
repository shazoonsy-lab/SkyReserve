@extends('layouts.admin')

@section('title', 'لوحة تحكم SkyReserve')

@section('content')
<div class="container-fluid">

    <!-- الإحصائيات الرئيسية -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center bg-white">
                <h5>عدد الرحلات الكلي</h5>
                <h3>{{ $stats['flights'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center bg-white">
                <h5>عدد الحجوزات الكلي</h5>
                <h3>{{ $stats['bookings'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center bg-white">
                <h5>الإيرادات الشهرية</h5>
                <h3>${{ number_format($monthlyRevenue ?? 0, 2) }}</h3>
            </div>
        </div>
    </div>

    <!-- الرحلات الأكثر حجزًا -->
    <div class="mb-4">
        <h4>الرحلات الأكثر حجزًا</h4>

        <div class="table-responsive">
            <table class="table table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>رقم الرحلة</th>
                        <th>شركة الطيران</th>
                        <th>عدد الحجوزات</th>
                        <th>الإيرادات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mostBookedFlights as $item)
                        <tr>
                            <td>{{ $item->flight->flight_number ?? '-' }}</td>
                            <td>{{ $item->flight->airline ?? '-' }}</td>
                            <td>{{ $item->bookings_count }}</td>
                            <td>
                                ${{ number_format($item->flight->bookings->sum('total_price'), 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                لا توجد بيانات حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- إضافة رحلة -->
    <div class="mb-4">
        <a href="{{ route('admin.flights.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-2"></i> أضف رحلة جديدة
        </a>
    </div>

    <!-- جدول الرحلات القادمة -->
    <div class="card p-3 shadow-sm bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0">الرحلات القادمة</h6>
            <a href="{{ route('admin.flights.index') }}">عرض كل الرحلات</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>رقم الرحلة</th>
                        <th>شركة الطيران</th>
                        <th>المغادرة</th>
                        <th>الوصول</th>
                        <th>وقت المغادرة</th>
                        <th>السعر</th>
                        <th>المقاعد المتاحة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($flights as $flight)
                        <tr>
                            <td>{{ $flight->flight_number }}</td>
                            <td>{{ $flight->airline }}</td>
                            <td>{{ $flight->departure_city }}</td>
                            <td>{{ $flight->arrival_city }}</td>
                            <td>{{ optional($flight->departure_time)->format('Y-m-d H:i') }}</td>
                            <td>
                                <span class="badge bg-info">
                                    حسب نوع المقعد
                                </span>
                            </td>
                            <td>{{ $flight->available_seats ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                لا توجد رحلات حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
