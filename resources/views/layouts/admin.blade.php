<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة تحكم SkyReserve')</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>
        body {
            min-height: 100vh;
            display: flex;
            background: url('{{ asset("images/flight-bg.jpg.png") }}') no-repeat center top fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            height: 55px;
            z-index: 1000;
            backdrop-filter: blur(6px);
            background: rgba(255,255,255,0.15);
        }

        .notification-bell {
            font-size: 22px;
            color: #ffdf00;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            padding-top: 70px;
        }

        .sidebar .nav-link {
            color: #fff;
            margin-bottom: 5px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            border-radius: 6px;
        }

        .content-wrapper {
            flex: 1;
            margin: 80px 20px 20px 20px;
            padding: 25px;
            background: rgba(255,255,255,0.85);
            border-radius: 15px;
        }
    </style>
</head>

<body>

<!-- ===== TOP NAVBAR ===== -->
<nav class="navbar navbar-expand navbar-custom px-4">
    <span class="navbar-brand fw-bold text-white">SkyReserve</span>

    <ul class="navbar-nav ms-auto align-items-center">

        <!-- 🔔 Notifications -->
        <li class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle position-relative"
               href="#"
               role="button"
               data-bs-toggle="dropdown">

                <i class="fas fa-bell notification-bell"></i>

                @if(auth()->user()->unreadNotifications->count())
                    <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end p-2" style="min-width:300px">
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <li class="dropdown-item small">
                        <strong>حجز</strong><br>
                        العميل: {{ $notification->data['customer'] }}<br>
                        الرحلة: {{ $notification->data['flight'] }}<br>
                        الحالة: <span class="text-primary">{{ $notification->data['status'] }}</span><br>
                        بواسطة: {{ $notification->data['employee'] }}
                    </li>
                    <li><hr class="dropdown-divider"></li>
                @empty
                    <li class="dropdown-item text-muted text-center">
                        لا توجد إشعارات
                    </li>
                @endforelse
            </ul>
        </li>

        <!-- Logout -->
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-danger">تسجيل الخروج</button>
            </form>
        </li>
    </ul>
</nav>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar px-3">
    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> الرئيسية
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.flights.index') }}"
               class="nav-link {{ request()->is('admin/flights*') ? 'active' : '' }}">
                <i class="fas fa-plane me-2"></i> الرحلات
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.bookings.index') }}"
               class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt me-2"></i> الحجوزات
            </a>
        </li>



        <li class="nav-item">
            <a href="{{ route('admin.payments.approvals') }}"
               class="nav-link {{ request()->is('admin/payments/approvals') ? 'active' : '' }}">
                <i class="fas fa-credit-card me-2"></i> موافقات الدفع
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.ai.ask') }}"
               class="nav-link {{ request()->is('admin/ai-assistant') ? 'active' : '' }}">
                <i class="fas fa-robot me-2"></i> المساعد الذكي
            </a>
        </li>


            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> المستخدمون
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}"
               class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i> البروفايل
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.activity.logs') }}"
               class="nav-link {{ request()->is('admin/activity*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list me-2"></i> سجل النشاطات
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.settings.edit') }}"
               class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                <i class="fas fa-cog me-2"></i> الإعدادات
            </a>
        </li>

    </ul>
</div>

<!-- ===== CONTENT ===== -->
<div class="content-wrapper">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
