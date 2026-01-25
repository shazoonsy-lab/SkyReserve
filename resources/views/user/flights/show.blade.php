@extends('layouts.user2')

@section('title', 'تفاصيل الرحلة')

@section('content')

<div class="container my-5">

    <div class="row">
        <div class="col-md-7">
            <img src="{{asset('images/flight2_.png')}}" alt="Flight Image"
                 class="img-fluid rounded shadow">
        </div>

        <div class="col-md-5">
            <div class="card shadow border-0 p-4">
                <h3 class="fw-bold mb-3">
                    ✈️ رحلة رقم {{ $flight->flight_number }}
                </h3>

                <p>📍 {{ $flight->from }} → {{ $flight->to }}</p>
                <p>🕒 {{ $flight->departure_time }}</p>
                <p>💺 المقاعد المتاحة: {{ $flight->seats }}</p>
                <p class="fw-bold">💰 السعر: {{ $flight->price }} USD</p>

                <hr>

                <form method="POST" action="{{ route('user.bookings.store', $flight->id) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">عدد المقاعد</label>
                        <input type="number" name="seats" class="form-control" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">نوع المقعد</label>
                        <select name="seat_type" class="form-select">
                            <option value="economy">اقتصادي</option>
                            <option value="business">رجال أعمال</option>
                            <option value="first">درجة أولى</option>
                        </select>
                    </div>

                    <button class="btn btn-primary w-100">
                        ✅ احجز الآن
                    </button>
                </form>

            </div>
        </div>
    </div>

</div>

@endsection
