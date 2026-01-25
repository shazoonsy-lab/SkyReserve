<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id');
            }
        });

        // ⚠️ إضافة المفتاح الأجنبي بدون onDelete
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};

