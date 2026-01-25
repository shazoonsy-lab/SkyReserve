@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>💳 الحجوزات بانتظار موافقة الدفع</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>رقم الحجز</th>
                <th>اسم العميل</th>
                <th>المبلغ</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->customer_name }}</td>
                <td>{{ $booking->total_price }} USD</td>
                <td>{{ $booking->manager_approval }}</td>
                <td>
                    <form action="{{ route('admin.payments.approve', $booking) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-success btn-sm">✅ موافقة</button>
                    </form>

                    <form action="{{ route('admin.payments.reject', $booking) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-danger btn-sm">❌ رفض</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
