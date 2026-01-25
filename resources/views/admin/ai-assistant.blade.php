@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">

    {{-- العنوان --}}
    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
        🤖 مساعد المدير الذكي
        <span class="text-sm text-gray-500">(AI Assistant)</span>
    </h2>

    {{-- الاقتراحات --}}
    <div class="mb-4 text-sm text-gray-600">
        💡 اقتراحات:
        <button onclick="fill('اعطني ملخص الحجوزات')" class="text-blue-600 underline mx-1">الحجوزات</button>
        <button onclick="fill('كيف أداء الموظفين؟')" class="text-blue-600 underline mx-1">الموظفين</button>
        <button onclick="fill('نصائح لزيادة الأرباح')" class="text-blue-600 underline mx-1">الأرباح</button>
    </div>

    {{-- صندوق المحادثة --}}
    <div id="chatBox" class="h-96 overflow-y-auto border rounded-lg p-4 bg-gray-50 space-y-3">

        @foreach($chats ?? [] as $chat)
            {{-- سؤال المدير --}}
            <div class="flex justify-end">
                <div class="bg-blue-600 text-white px-4 py-2 rounded-lg max-w-sm">
                    {{ $chat->question }}
                </div>
            </div>

            {{-- رد المساعد --}}
            <div class="flex justify-start">
                <div class="bg-gray-200 px-4 py-2 rounded-lg max-w-sm">
                    🤖 {{ $chat->answer }}
                </div>
            </div>
        @endforeach

        {{-- حالة الكتابة --}}
        <div id="typing" class="text-gray-400 text-sm hidden">
            🤖 المساعد يكتب...
        </div>
    </div>

    @if(session('answer'))
    <div class="mt-4 bg-green-50 border border-green-200 p-4 rounded-lg">
        🤖 {!! nl2br(session('answer')) !!}
    </div>
@endif


    {{-- الإدخال --}}
    <form method="POST" action="{{ route('admin.ai.ask') }}" class="mt-4 flex gap-2">
    @csrf

    <textarea id="question" name="question" rows="2"
        class="flex-1 p-3 border rounded-lg"
        placeholder="اكتب سؤالك هنا... (Enter للإرسال)"></textarea>

    <button class="bg-blue-600 text-white px-6 rounded-lg">
        إرسال
    </button>
</form>


</div>

{{-- JavaScript --}}
<script>
function fill(text) {
    document.getElementById('question').value = text;
}

const form = document.getElementById('ai-form');
const questionInput = document.getElementById('question');
const typing = document.getElementById('typing');

questionInput.addEventListener('keydown', function(e){
    if(e.key === 'Enter' && !e.shiftKey){
        e.preventDefault();
        form.requestSubmit();
    }
});

form.addEventListener('submit', function(e){
    e.preventDefault();
    typing.classList.remove('hidden');

    
});
</script>
@endsection
