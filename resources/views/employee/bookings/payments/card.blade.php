@extends('employee.layout')

@section('content')
<div class="container">
    <h4>💳 الدفع بالبطاقة</h4>

    <div class="card p-3">
        <p><strong>المبلغ:</strong> {{ $booking->total_price }} USD</p>

        <form id="payment-form">
            <div id="card-element" class="form-control mb-3"></div>

            <button id="submit" class="btn btn-success w-100">
                ✅ تأكيد الدفع
            </button>

            <div id="error-message" class="text-danger mt-2"></div>
        </form>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
const stripe = Stripe("{{ config('services.stripe.key') }}");
const elements = stripe.elements();

const card = const card = elements.create('card'); 
    


card.mount('#card-element');

const form = document.getElementById('payment-form');
const errorEl = document.getElementById('error-message');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

   const { paymentIntent, error } = await stripe.confirmCardPayment(
    "{{ $clientSecret }}",
    {
        payment_method: {
            card: card,
            billing_details: {
                name: "{{ auth()->user()->name ?? 'Test User' }}",
                email: "{{ auth()->user()->email ?? 'test@example.com' }}",
                address: {
                    postal_code: '12345',
                    country: 'AE'
                }
            }
        }
    }
);


    if (error) {
        errorEl.textContent = error.message;
    } else {
        // الدفع نجح 🎉
        alert("تم الدفع بنجاح ✅");

        // التحديث الحقيقي سيتم عبر Webhook
        window.location.href = "{{ route('employee.bookings.show', $booking) }}";
    }
});
</script>
@endsection
