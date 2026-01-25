<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(rgba(255, 255, 255, 0.57), rgba(255, 255, 255, 0.06)), url('{{ asset("images/flight2_.png") }}') no-repeat center top fixed;
            background-size: cover;
        }

        .hero-section {
    height: 100vh;
    background: linear-gradient(
        rgba(0, 0, 0, 0.36),
        rgba(15, 15, 15, 0.43)
    ),
    url('/images/flight-bg.jpg') center center no-repeat;
    background-size: cover;
}


        .navbar {
            backdrop-filter: blur(6px);
            background: rgba(9, 41, 128, 0.88);
        }

        .navbar .nav-link {
            color: #faf6f6e5 !important;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.93);
        }

        .content-wrapper {
            flex: 1;
            margin: 20px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0);
            border-radius: 20px;
        }

        .flight-card img {
            border-radius: 15px 15px 0 0;
            height: 180px;
            background: #f7f1f1;
            object-fit: cover;
        }

        .flight-info h5 {
            font-weight: 700;
        }

        .btn-primary {
            background-color: #0d6dfdf5;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #201f1fff;
            font-size: 14px;
        }

    </style>
</head>
<body>

<!-- شريط التنقل -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('user.dashboard') }}">SkyReserve ✈️</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.flights.index') }}">الرحلات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.bookings.index') }}">حجوزاتي</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.profile.index') }}">الملف الشخصي</a>
                </li>

            </ul>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm">تسجيل خروج</button>
            </form>
        </div>
    </div>
</nav>

<!-- المحتوى الرئيسي -->
<div class="container content-wrapper">
    @yield('content')
</div>

<!-- Footer -->
<footer>
    &copy; 2025 SkyReserve - جميع الحقوق محفوظة
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
