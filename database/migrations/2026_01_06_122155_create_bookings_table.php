<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        // تأكد من الأعمدة الموجودة بالفعل قبل الإضافة
        if (!Schema::hasColumn('bookings', 'flight_id')) {
            $table->foreignId('flight_id')->constrained()->cascadeOnDelete();
        }
        if (!Schema::hasColumn('bookings', 'seat_number')) {
            $table->string('seat_number');
        }
        if (!Schema::hasColumn('bookings', 'status')) {
            $table->string('status')->default('confirmed');
        }
        // أعمدة اختيارية أخرى إذا لزم الأمر
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
