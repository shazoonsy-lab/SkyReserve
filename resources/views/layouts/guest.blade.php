<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkyReserve')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

     <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(rgba(255, 255, 255, 0.57), rgba(255, 255, 255, 0.06)), url('{{ asset("images/flight2_.png") }}') no-repeat center top fixed;
            background-size: cover;
        }

         .navbar {
            backdrop-filter: blur(6px);
            background: rgba(91, 126, 207, 0.88);
        }

        .navbar .nav-link {
            color: #faf6f6 !important;
        }

        .content-wrapper {
            flex: 1;
            margin: 20px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0);
            border-radius: 20px;
        }

        footer {
            background: rgba(255, 255, 255, 0);
        }


        .chatbot-btn {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 60px;
    height: 60px;
    background: #0d6efd;
    color: white;
    font-size: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(0,0,0,.25);
    transition: all .3s ease;
    z-index: 999;
}

.chatbot-btn:hover {
    background: #084298;
    transform: scale(1.1);
}



        </style>
</head>
<body>

    <!-- شريط علوي بسيط للواجهة العامة -->
    <nav class="navbar navbar-expand-lg shadow-sm"
     style="background: linear-gradient(120deg, #0d6dfd96, #003566);">

        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="{{ route('home') }}">SkyReserve</a>
          <!-- <div>
               <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">تسجيل الدخول</a>
             <a href="{{ route('register') }}" class="btn btn-primary">إنشاء حساب</a>
            </div> -->
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3">
        &copy; {{ date('Y') }} SkyReserve. جميع الحقوق محفوظة.
    </footer>

   @stack('scripts')

</body>
</html>
