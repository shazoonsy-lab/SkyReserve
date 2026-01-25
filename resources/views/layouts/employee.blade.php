
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة تحكم الموظف')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: row;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #05101bd7;
        }

        .navbar-brand { font-size: 22px; font-weight: bold; color: #ffffff !important; margin-right: 20px; }

        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: #ffffff;
            min-height: 100vh;
            padding-top: 20px;
        }

        .sidebar a { color: #ffffff; text-decoration: none; transition: 0.2s; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { background-color: rgba(255,255,255,0.1); border-radius: 5px; }

        .content-wrapper { flex: 1; padding: 30px; background-color: #f8f9fa; }

        .navbar-custom { position: fixed; top: 0; left: 0; right: 0; height: 50px; z-index: 1000; background: #343a40; padding: 10px; color: #fff; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4">SkyReserve</h4>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('employee.dashboard') }}" class="nav-link {{ request()->is('employee/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i> الرئيسية
                </a>
            </li>

            <li>
                <a href="{{ route('employee.bookings.index') }}" class="nav-link {{ request()->is('employee/bookings*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt me-2"></i> الحجوزات
                </a>
            </li>

              <li>
                <a href="{{ route('employee.profile.edit') }}" class="nav-link {{ request()->is('employee/profile*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i> الملف الشخصي
                </a>
        </ul>

            <li>
                <a href="{{ route('employee.flights.index') }}" class="nav-link {{ request()->is('employee/flights*') ? 'active' : '' }}">
                    <i class="fas fa-plane me-2"></i> الرحلات
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content-wrapper">
        <div class="navbar navbar-custom d-flex justify-content-between">
            <span class="navbar-brand">SkyReserve - موظف</span>
            <form method="POST" action="{{ route('logout') }}"> 
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">تسجيل الخروج</button>
            </form>
        </div>

        <div style="margin-top: 70px;">
            @yield('content')
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
