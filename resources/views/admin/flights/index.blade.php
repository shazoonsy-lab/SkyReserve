@extends('layouts.admin')

@section('title','إدارة الرحلات')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>الرحلات</h3>
        <a href="{{ route('admin.flights.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> إضافة رحلة جديدة
        </a>


    </div>

    <!-- نموذج الفلترة -->
    <form method="GET" action="{{ route('admin.flights.index') }}" class="mb-3 d-flex gap-2">
        <input type="text" name="departure_city" value="{{ request('departure_city') }}" placeholder="مدينة المغادرة" class="form-control">
        <input type="text" name="arrival_city" value="{{ request('arrival_city') }}" placeholder="مدينة الوصول" class="form-control">
        <input type="text" name="airline" value="{{ request('airline') }}" placeholder="شركة الطيران" class="form-control">
        <button type="submit" class="btn btn-primary">فلترة</button>
        <a href="{{ route('admin.flights.index') }}" class="btn btn-secondary">إعادة ضبط</a>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>رقم الرحلة</th>
                            <th>الخط</th>
                            <th>المغادرة</th>
                            <th>الوصول</th>
                            <th>تاريخ ووقت المغادرة</th>
                            <th>تاريخ ووقت الوصول</th>
                            <th>السعر (USD)</th>
                            <th>المقاعد المتاحة</th>
                            <th>الإجراءات</th>
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
                            <td>{{ optional($flight->arrival_time)->format('Y-m-d H:i') }}</td>
                            <td>{{ $flight->price }}</td>
                            <td>{{ $flight->seats ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.flights.show', $flight->id) }}" class="btn btn-sm btn-info mb-1">عرض</a>
                                <a href="{{ route('admin.flights.edit', $flight->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">لا توجد رحلات حالياً</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $flights->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
@endsection
