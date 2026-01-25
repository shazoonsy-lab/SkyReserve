@extends('layouts.guest')

@section('title', 'تفاصيل الرحلة')

@section('content')
<div class="container py-5">

    <div class="card shadow-lg">
        <div class="card-body">

            <h3 class="fw-bold mb-3">
                ✈️ {{ $flight->from }} ➜ {{ $flight->to }}
            </h3>

            <p>📅 تاريخ المغادرة: {{ $flight->departure_date }}</p>
            <p>🕒 وقت المغادرة: {{ $flight->departure_time }}</p>
            <p>💺 المقاعد المتاحة: {{ $flight->seats }}</p>

           <!-- <h4 class="text-primary mt-3">
                💰 السعر: {{ $flight->price }} $
            </h4>-->

            <hr>

            <a href="{{ route('booking', ['flight' => $flight->id]) }}"
   class="btn btn-primary w-100">
   ✈️ احجز الآن
</a>


        </div>
    </div>

</div>
@endsection
