<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial; direction: rtl">

    <h2>✈️ تم تأكيد حجزك بنجاح</h2>

    <p>مرحبًا {{ $booking->customer_name }},</p>

    <p>نشكرك لاختيارك <strong>SkyReserve</strong>.</p>

    <hr>

    <p><strong>كود الحجز:</strong> {{ $booking->booking_code }}</p>
    <p><strong>عدد المقاعد:</strong> {{ $booking->seats }}</p>
    <p><strong>نوع المقعد:</strong> {{ $booking->seat_type }}</p>
    <p><strong>السعر الإجمالي:</strong> {{ $booking->total_price }} $</p>

    <hr>

    <p>📧 إذا كان لديك أي استفسار لا تتردد بالتواصل معنا.</p>

    <p>✈️ فريق SkyReserve</p>

</body>
</html>
