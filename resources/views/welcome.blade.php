@extends('layouts.guest')

@section('title', 'SkyReserve - رحلاتك بأمان وسهولة')

@section('content')
<div class="container-fluid p-0">

    <!-- قسم المقدمة -->
    <section class="bg-primary text-white text-center p-5">
        <div class="container">
            <h1 class="display-4 fw-bold">مرحباً بك في SkyReserve</h1>
            <p class="lead my-4">
                SkyReserve يجعل حجز رحلات الطيران تجربة سهلة، سريعة وآمنة.
                اكتشف أفضل الوجهات حول العالم واحجز مقعدك بثقة خلال دقائق.
            </p>
        </div>
    </section>

    <!-- لماذا تختارنا -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">لماذا تختار SkyReserve؟</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <h4>✈️ حجز ذكي</h4>
                    <p>اختر الرحلة والمقعد المناسب بكل سهولة وسرعة.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h4>🔒 أمان وموثوقية</h4>
                    <p>نظام موثوق لحجز الرحلات مع إدارة احترافية.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h4>🌍 وجهات عالمية</h4>
                    <p>رحلات محلية ودولية بأسعار تنافسية.</p>
                </div>
            </div>

            <!-- زر الشات بوت -->
<a href="{{ route('chatbot') }}"
   class="chatbot-btn"
   title="تحدث مع مساعد SkyReserve">
    💬
</a>

        </div>
    </section>

    <!-- تسجيل الدخول للمستخدم فقط -->
    <section class="py-5 text-center"
        style="background: linear-gradient(120deg, #f2f4f8, #e8eef5);">

        <div class="container">
            <h2 class="fw-bold mb-4 text-dark">ابدأ رحلتك الآن</h2>

            <!-- تسجيل دخول المستخدم العادي -->
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                تسجيل الدخول
            </a>

            <!-- تصفح الرحلات كزائر -->
            <div class="mt-4">
                <a href="{{ route('user.flights.index') }}" class="btn btn-outline-primary btn-lg">
                    🔎 تصفح الرحلات كزائر
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
