<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('SkyReserve');
            $table->string('logo')->nullable();
            $table->string('admin_bg')->nullable(); // صورة الخلفية
            $table->json('seat_prices')->nullable(); // تخزين أسعار المقاعد كـ JSON
            $table->string('notification_email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
