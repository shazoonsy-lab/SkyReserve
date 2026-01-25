
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
            background: url('{{ asset("images/flight-bg.jpg.png") }}') no-repeat center top fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #05101bd7;
        }

        /* اسم الموقع */
        .navbar-brand {
            font-size: 22px;
            font-weight: bold;
            color: #ffffff !important;
            text-shadow: 1px 1px 3px #faf3f3ef;
            margin-right: 20px;
        }

        .sidebar {
            width: 240px;
            background-color: rgba(45, 104, 163, 0.42);
            color: #ffffff;
            min-height: 100vh;
            padding-top: 20px;
        }

        .sidebar a {
            color: #fdfdfdff;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: rgba(240, 242, 245, 0.21);
            border-radius: 5px;
        }

        .content-wrapper {
            flex: 1;
            padding: 20px;
            background-color: rgba(241, 236, 236, 0.01);
            border-radius: 10px;
            margin: 80px 20px 20px 20px;
            box-shadow: 0 8px 20px rgba(253, 247, 247, 0.02);
        }

        /* NAVBAR */
        .navbar-custom {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            height: 50px;
            z-index: 1000;
            background: rgba(247, 246, 239, 0);
            backdrop-filter: blur(5px);
            padding: 10px;
        }

        /* لون الجرس */
        .notification-bell {
            color: #ffdf00;
            font-size: 22px;
        }

        .dropdown-menu {
            max-height: 260px;
            overflow-y: auto;
        }
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
                <a href="{{ route('employee.flights.index') }}" class="nav-link {{ request()->is('employee/flights*') ? 'active' : '' }}">
                    <i class="fas fa-plane me-2"></i> الرحلات
                </a>
            </li>

            <li>
                <a href="{{ route('employee.profile.edit') }}" class="nav-link {{ request()->is('employee/profile*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i> الملف الشخصي
                </a>
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
