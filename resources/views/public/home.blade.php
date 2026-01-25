@extends('layouts.guest')

@section('title', 'SkyReserve | رحلاتك تبدأ من هنا')

@section('content')

<!-- HERO SECTION -->
<section class="py-5 text-white text-center"
    style="background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0,0,0,.55)),
           url('{{ asset('images/flight2_.png') }}') center/cover no-repeat;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold">SkyReserve</h1>
        <p class="lead mt-3">
            احجز رحلتك بسهولة • اكتشف أفضل العروض • تواصل معنا فورًا
        </p>

        <div class="mt-4">
            <a href="{{ route('flights.index') }}" class="btn btn-primary btn-lg">
    ✈️ استعرض الرحلات
</a>

            <a href="#contact" class="btn btn-outline-light btn-lg">📞 تواصل معنا</a>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <h4>✈️ رحلات متنوعة</h4>
                <p>رحلات داخلية ودولية لأفضل الوجهات العالمية.</p>
            </div>

            <div class="col-md-4">
                <h4>💬 شات بوت ذكي</h4>
                <p>
                    مساعد ذكي متاح دائمًا للإجابة عن استفساراتك  
                    <br>
                    <small class="text-muted">اضغط على أيقونة الشات أسفل الصفحة</small>
                </p>
            </div>

            <div class="col-md-4">
                <h4>📧 تذكرة على الإيميل</h4>
                <p>احجز أونلاين واستلم تذكرتك مباشرة.</p>
            </div>
        </div>
    </div>
</section>

<!-- FLIGHTS PREVIEW -->
<section id="flights" class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">🌍 وجهات مميزة</h2>

        <div class="row g-4">
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('images/OIP (1).webp') }}"
                             class="card-img-top" alt="Destination">
                        <div class="card-body">
                            <h5 class="card-title">وجهة سياحية</h5>
                            <p class="card-text">عروض خاصة وأسعار تنافسية.</p>
                            <a href="#" class="btn btn-outline-primary w-100">
                                تفاصيل الرحلة
                            </a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- CONTACT -->
<section id="contact" class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">📞 تواصل معنا</h2>

        <div class="row text-center">
            <div class="col-md-4">
                <h5>📍 العنوان</h5>
                <p>SkyReserve HQ</p>
            </div>

            <div class="col-md-4">
                <h5>📧 البريد</h5>
                <p>support@skyreserve.com</p>
            </div>

            <div class="col-md-4">
                <h5>☎️ الهاتف</h5>
                <p>+31 000 000 000</p>
            </div>
        </div>
    </div>
</section>

<!-- FLOATING CHAT BUTTON -->
<a href="{{ route('chatbot') }}"
   title="تحدث مع SkyBot"
   class="btn btn-primary rounded-circle shadow-lg"
   style="
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        z-index: 999;
   ">
   💬
</a>

@endsection
