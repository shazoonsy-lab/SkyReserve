@extends('layouts.user2')

@section('title', 'الملف الشخصي | SkyReserve')

@section('content')
<div class="container my-5">

    <div class="row g-4">

        <!-- بطاقة المستخدم -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4">

                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&size=120"
                     class="rounded-circle mb-3">

                <h5 class="fw-bold">{{ $user->name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>

                <span class="badge bg-primary">مستخدم</span>

                <hr>

                <a href="#" class="btn btn-outline-primary btn-sm w-100">
                    تعديل البيانات
                </a>
            </div>
        </div>

        <!-- الإحصائيات -->
        <div class="col-md-8">
            <div class="row g-4">

                <div class="col-md-6">
                    <div class="card shadow-sm p-4">
                        <h6 class="text-muted">رصيد الحساب</h6>
                        <h2 class="fw-bold text-success">
                            {{ $profileBalance }} USD
                        </h2>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm p-4">
                        <h6 class="text-muted">عدد الحجوزات</h6>
                        <h2 class="fw-bold">
                            {{ $myBookingsCount }}
                        </h2>
                    </div>
                </div>

                <!-- ملاحظة مستقبلية -->
                <div class="col-12">
                    <div class="alert alert-info">
                        ✈️ قريبًا: نظام مكافآت للمسافرين الدائمين
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
