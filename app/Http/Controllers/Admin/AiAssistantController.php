<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\AiChat;

class AiAssistantController extends Controller
{
    // عرض صفحة المساعد + سجل المحادثات
    public function showPage()
    {
        $chats = AiChat::latest()->get();
        return view('admin.ai-assistant', compact('chats'));
    }

    // استقبال السؤال
    public function ask(Request $request)
    {
        $question = trim($request->question ?? '');

        if ($question === '') {
            return back();
        }

        $q = mb_strtolower($question);
        $lang = $this->detectLanguage($question);
        $answer = '';

        /* =========================
         | عدد الحجوزات
         ========================= */
        if (
            (str_contains($q, 'عدد') && str_contains($q, 'حجز')) ||
            (str_contains($q, 'how many') && str_contains($q, 'booking'))
        ) {
            $count = Booking::count();

            $answer = $lang === 'ar'
                ? "📦 عدد الحجوزات الحالي هو: **{$count}**"
                : "📦 Total bookings count is: **{$count}**";

            $this->saveChat($question, $answer);
            return back();
        }

        /* =========================
         | آخر الحجوزات
         ========================= */
        if (str_contains($q, 'حجز') || str_contains($q, 'booking')) {

            $bookings = Booking::latest()->take(5)->get();

            if ($bookings->isEmpty()) {
                $answer = $lang === 'ar'
                    ? "لا توجد حجوزات حالياً."
                    : "There are no bookings at the moment.";
            } else {

                $answer = $lang === 'ar'
                    ? "📦 **آخر الحجوزات:**\n\n"
                    : "📦 **Latest Bookings:**\n\n";

                foreach ($bookings as $b) {

                    $flight = $b->flight_number ?: ($lang === 'ar' ? 'غير محدد' : 'Unknown');

                    $statusText = match ($b->status) {
                        'pending'     => $lang === 'ar' ? 'قيد المراجعة' : 'Pending',
                        'employee_ok' => $lang === 'ar' ? 'موافق عليه من الموظف' : 'Employee approved',
                        'admin_ok'    => $lang === 'ar' ? 'موافق عليه نهائيًا' : 'Final approval',
                        default       => $b->status
                    };

                    $answer .= $lang === 'ar'
                        ? "• ✈️ رحلة رقم {$flight} — الحالة: {$statusText}\n"
                        : "• ✈️ Flight {$flight} — Status: {$statusText}\n";
                }

                $pendingCount = $bookings->where('status', 'pending')->count();

                if ($pendingCount > 0) {
                    $answer .= $lang === 'ar'
                        ? "\n⚠️ يوجد {$pendingCount} حجز قيد المراجعة.\n💡 يُنصح بمتابعتها اليوم."
                        : "\n⚠️ {$pendingCount} bookings are pending.\n💡 Recommended to review them today.";
                }
            }

            $this->saveChat($question, $answer);
            return back();
        }

        /* =========================
         | نصائح ذكية
         ========================= */
        $answer = $this->generateSmartReply($q, $lang);
        $this->saveChat($question, $answer);

        return back();
    }

    // كشف اللغة
    private function detectLanguage($text)
    {
        return preg_match('/[اأإآء-ي]/u', $text) ? 'ar' : 'en';
    }

    // ردود ذكية
    private function generateSmartReply($q, $lang)
    {
        if (str_contains($q, 'ضغط') || str_contains($q, 'busy')) {
            return $lang === 'ar'
                ? "⚠️ **تنبيه إداري:**\nيوجد ضغط عمل.\n\n💡 اقتراح: وزّع الحجوزات على الموظفين المتاحين."
                : "⚠️ **Admin Alert:**\nHigh workload detected.\n\n💡 Suggestion: distribute bookings among staff.";
        }

        if (str_contains($q, 'نصيحة') || str_contains($q, 'tip')) {
            return $lang === 'ar'
                ? "💡 **نصيحة إدارية:**\nتابع الحجوزات المعلقة يوميًا وفعّل الإشعارات التلقائية."
                : "💡 **Management Tip:**\nReview pending bookings daily and enable auto notifications.";
        }

        return $lang === 'ar'
            ? "🤖 يمكنني مساعدتك في:\n• عدد الحجوزات\n• آخر الحجوزات\n• نصائح إدارية"
            : "🤖 I can help you with:\n• bookings count\n• latest bookings\n• management tips";
    }

    // حفظ المحادثة
    private function saveChat($question, $answer)
    {
        AiChat::create([
            'question' => $question,
            'answer'   => $answer,
        ]);
    }
}
