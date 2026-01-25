@extends('layouts.user2')

@section('title', 'الملف الشخصي | SkyReserve')

@section('content')

<div class="container my-5">

    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">👤 ملفك الشخصي</h2>
        <p class="text-muted">إدارة بياناتك، صورتك، وأمان حسابك</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        <!-- بطاقة المستخدم -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4">

                <img src="{{ $user->avatar
                    ? asset('storage/'.$user->avatar).'?v='.time()
                    : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&size=200' }}"
                    class="rounded-circle mx-auto mb-3"
                    width="140"
                    height="140"
                    style="object-fit: cover; border: 4px solid #0d6efd;">

                <h5 class="fw-bold">{{ $user->name }}</h5>
                <p class="text-muted mb-1">{{ $user->email }}</p>

                <span class="badge bg-primary mb-3">
                    {{ ucfirst($user->role) }}
                </span>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <small class="text-muted d-block">رصيدك الحالي</small>
                    <h4 class="fw-bold text-success mb-0">
                        {{ number_format($profileBalance) }} USD
                    </h4>
                </div>

                <!-- تغيير الصورة -->
               <form method="POST"
      action="{{ route('user.profile.avatar') }}"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="file"
           name="avatar"
           class="form-control form-control-sm mb-2"
           required>

    <button class="btn btn-outline-primary btn-sm w-100">
        📸 تحديث الصورة
    </button>
</form>

            </div>
        </div>

        <!-- تعديل البيانات -->
        <div class="col-lg-8">
    <div class="card border-0 shadow-sm p-4">

        <!-- Tabs -->
        <ul class="nav nav-pills mb-4" id="profileTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#profile-info">
                    👤 البيانات الشخصية
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#profile-security">
                    🔐 الأمان
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#profile-bookings">
                    ✈️ حجوزاتي
                </button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- البيانات الشخصية -->
            <div class="tab-pane fade show active" id="profile-info">
                <h5 class="fw-bold mb-3">✏️ تعديل البيانات</h5>

                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text" name="name"
                               value="{{ old('name', $user->name) }}"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               class="form-control">
                    </div>

                    <button class="btn btn-primary">
                        💾 حفظ التغييرات
                    </button>
                </form>
            </div>

            <!-- الأمان -->
            <div class="tab-pane fade" id="profile-security">
                <h5 class="fw-bold mb-3">🔐 تغيير كلمة المرور</h5>

                <form method="POST" action="{{ route('user.profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الحالية</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button class="btn btn-warning">
                        🔁 تغيير كلمة المرور
                    </button>
                </form>
            </div>

            <!-- الحجوزات -->
            <div class="tab-pane fade" id="profile-bookings">

    <h5 class="fw-bold mb-3">✈️ حجوزاتي</h5>

    @if($latestBookings->isEmpty())
        <div class="alert alert-info">
            لا توجد حجوزات حتى الآن ✨
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>من → إلى</th>
                        <th>شركة الطيران</th>
                        <th>التاريخ</th>
                        <th>السعر</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestBookings as $booking)
                        <tr>
                            <td>
                                {{ $booking->flight->departure_city }}
                                →
                                {{ $booking->flight->arrival_city }}
                            </td>
                            <td>{{ $booking->flight->airline }}</td>
                            <td>{{ $booking->flight->departure_time->format('Y-m-d H:i') }}</td>
                            <td class="fw-bold text-success">
                                {{ number_format($booking->flight->price) }} USD
                            </td>
                            <td>
                                <span class="badge
                                    @if($booking->status === 'confirmed') bg-success
                                    @elseif($booking->status === 'pending') bg-warning
                                    @else bg-danger @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('user.bookings.index') }}"
           class="btn btn-outline-primary btn-sm mt-2">
            عرض كل الحجوزات →
        </a>

    

    @endif

</div>


        </div>
    </div>
</div>


    </div>

</div>

@endsection
