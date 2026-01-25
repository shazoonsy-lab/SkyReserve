@extends('employee.layout')

@section('title', 'لوحة تحكم الموظف SkyReserve')

@section('content')
<div class="container-fluid">

    <!-- 🔔 الإشعارات -->
   @if($notifications->count())
    <div class="mb-4">
        <h5>الإشعارات الأخيرة</h5>

        @foreach($notifications as $notification)
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>
                    {{ $notification->data['message'] ?? 'لديك إشعار جديد' }}
                </span>
                <small class="text-muted">
                    {{ $notification->created_at->diffForHumans() }}
                </small>
            </div>
        @endforeach
    </div>
@endif



    <!-- الإحصائيات الرئيسية -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center" style="background-color: rgba(255,255,255,0.85);">
                <h5>عدد الرحلات الكلي</h5>
                <h3>{{ $flightsCount ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center" style="background-color: rgba(255,255,255,0.85);">
                <h5>عدد الحجوزات الكلي</h5>
                <h3>{{ $bookingsCount ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 shadow-sm text-center" style="background-color: rgba(255,255,255,0.85);">
                <h5>الحجوزات المعلقة</h5>
                <h3>{{ $pendingBookings ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- آخر 5 رحلات -->
    <div class="mb-4">
        <h4>آخر الرحلات القادمة</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center" style="background-color: rgba(255,255,255,0.85);">
                <thead class="table-light">
                    <tr>
                        <th>رقم الرحلة</th>
                        <th>شركة الطيران</th>
                        <th>المغادرة</th>
                        <th>الوصول</th>
                        <th>وقت الرحلة</th>
                        <th>السعر</th>
                        <th>المقاعد المتاحة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestFlights as $flight)
                        <tr>
                            <td>{{ $flight->flight_number }}</td>
                            <td>{{ $flight->airline }}</td>
                            <td>{{ $flight->departure_city }}</td>
                            <td>{{ $flight->arrival_city }}</td>
                            <td>{{ optional($flight->departure_time)->format('Y-m-d H:i') }}</td>
                            <td>{{ $flight->price ?? 0 }} USD</td>
                            <td>{{ $flight->seats ?? '-' }}</td>
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

    <!-- جميع الرحلات -->
    <div class="mb-4">
        <h4>جميع الرحلات</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center" style="background-color: rgba(255,255,255,0.85);">
                <thead class="table-light">
                    <tr>
                        <th>رقم الرحلة</th>
                        <th>شركة الطيران</th>
                        <th>المغادرة</th>
                        <th>الوصول</th>
                        <th>وقت الرحلة</th>
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
                            <td>{{ $flight->price ?? 0 }} USD</td>
                            <td>{{ $flight->seats ?? '-' }}</td>
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
