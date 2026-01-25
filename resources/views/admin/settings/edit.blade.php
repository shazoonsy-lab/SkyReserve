@extends('layouts.admin')

@section('title', 'إعدادات الموقع')

@section('content')
<div class="container">
    <h3 class="mb-4">إعدادات الموقع</h3>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">اسم الموقع</label>
            <input type="text" name="site_name" class="form-control" value="{{ $setting->site_name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">شعار الموقع</label>
            <input type="file" name="logo" class="form-control">
            @if($setting->logo)
                <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" class="mt-2" style="height:50px;">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">خلفية لوحة الإدارة</label>
            <input type="file" name="admin_bg" class="form-control">
            @if($setting->admin_bg)
                <img src="{{ asset('storage/'.$setting->admin_bg) }}" alt="Admin BG" class="mt-2" style="height:80px;">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">أسعار المقاعد (USD)</label>
            <input type="number" step="0.01" name="seat_prices[economy]" class="form-control mb-1" placeholder="اقتصادي" value="{{ $setting->seat_prices['economy'] ?? '' }}">
            <input type="number" step="0.01" name="seat_prices[business]" class="form-control mb-1" placeholder="أعمال" value="{{ $setting->seat_prices['business'] ?? '' }}">
            <input type="number" step="0.01" name="seat_prices[vip]" class="form-control" placeholder="VIP" value="{{ $setting->seat_prices['vip'] ?? '' }}">
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني للإشعارات</label>
            <input type="email" name="notification_email" class="form-control" value="{{ $setting->notification_email }}">
        </div>

        <button type="submit" class="btn btn-success">حفظ الإعدادات</button>
    </form>
</div>
@endsection
