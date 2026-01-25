@extends('employee.layout')

@section('content')
<h4>تفاصيل الدفع</h4>

<p>رقم الحجز: {{ $booking->booking_code }}</p>
<p>الحالة: {{ $booking->status }}</p>
<p>السعر الإجمالي: {{ $booking->total_price }}</p>
@endsection
