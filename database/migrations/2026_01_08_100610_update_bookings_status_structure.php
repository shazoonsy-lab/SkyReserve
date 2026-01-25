<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 🔎 جلب اسم قيد CHECK الحالي (إن وجد)
        $constraint = DB::selectOne("
            SELECT cc.name
            FROM sys.check_constraints cc
            JOIN sys.objects t ON cc.parent_object_id = t.object_id
            WHERE t.name = 'bookings'
              AND cc.definition LIKE '%status%'
        ");

        // 🧹 حذف القيد القديم إن وُجد
        if ($constraint) {
            DB::statement("
                ALTER TABLE bookings
                DROP CONSTRAINT {$constraint->name}
            ");
        }

        // ✅ إضافة القيد الجديد بالهيكل المطلوب
        DB::statement("
            ALTER TABLE bookings
            ADD CONSTRAINT CK_bookings_status
            CHECK (status IN ('pending', 'employee_ok', 'admin_ok', 'rejected'))
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE bookings
            DROP CONSTRAINT CK_bookings_status
        ");
    }
};
