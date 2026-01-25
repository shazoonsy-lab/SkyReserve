@extends('employee.layout')

@section('title', 'الرحلات')

@section('content')
<h3 class="mb-4">الرحلات المتاحة</h3>

@if($flights->count())
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>رقم الرحلة</th>
            <th>من</th>
            <th>إلى</th>
            <th>الإقلاع</th>
            <th>السعر</th>
        </tr>
    </thead>
    <tbody>
        @foreach($flights as $flight)
        <tr>
            <td>{{ $flight->id }}</td>
            <td>{{ $flight->flight_number }}</td>
            <td>{{ $flight->departure_city }}</td>
            <td>{{ $flight->arrival_city }}</td>
            <td>{{ $flight->departure_time }}</td>
            <td>{{ $flight->price }} $</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $flights->links() }}
@else
    <div class="alert alert-warning">لا توجد رحلات بعد</div>
@endif
@endsection
