@extends('layouts.guest')

@section('title', 'SkyBot | المساعد الذكي')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width:600px">
        <div class="card-header bg-primary text-white fw-bold">
            💬 SkyBot
        </div>

        <div id="chatBody"
             class="card-body"
             style="height:400px; overflow-y:auto; background:#f8f9fa">
        </div>

        <div class="card-footer d-flex">
            <input type="text" id="chatInput"
                   class="form-control me-2"
                   placeholder="اكتب سؤالك...">
            <button id="sendBtn" class="btn btn-primary">
                إرسال
            </button>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const sendBtn = document.getElementById('sendBtn');
    const input = document.getElementById('chatInput');
    const chatBody = document.getElementById('chatBody');

    function sendMessage() {
        let message = input.value.trim();
        if (!message) return;

        chatBody.innerHTML += `<div><b>أنت:</b> ${message}</div>`;

        fetch("{{ route('chatbot.message') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message })
        })
        .then(res => res.json())
        .then(data => {
            chatBody.innerHTML += `<div><b>SkyBot:</b> ${data.reply}</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        })
        .catch(() => {
            chatBody.innerHTML += `<div>⚠️ خطأ في الاتصال</div>`;
        });

        input.value = '';
    }

    sendBtn.addEventListener('click', sendMessage);

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

});
</script>

@endpush


