<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class PaymentApprovalController extends Controller
{
    /**
     * عرض جميع الحجوزات المدفوعة التي تنتظر موافقة المدير
     */
    public function index()
    {
        $bookings = Booking::where('is_paid', true)
            ->where('manager_approval', 'pending')
            ->latest()
            ->get();

        return view('admin.payments.approvals', compact('bookings'));
    }

    /**
     * الموافقة على الدفع
     */
    public function approve(Booking $booking)
    {
        $booking->update([
            'manager_approval' => 'approved',
            'status' => 'admin_ok', // تحديث حالة الحجز إن أردت
        ]);

        return back()->with('success', 'تمت الموافقة على الدفع ✅');
    }

    /**
     * رفض الدفع
     */
    public function reject(Booking $booking)
    {
        $booking->update([
            'manager_approval' => 'rejected',
            'status' => 'rejected',
        ]);

        return back()->with('error', 'تم رفض الدفع ❌');
    }
}

