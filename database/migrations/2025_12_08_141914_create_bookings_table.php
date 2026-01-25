<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->integer('seats')->default(0);
            $table->string('seat_type')->default('economy');
            $table->decimal('seat_price', 8, 2)->default(0);
            $table->enum('manager_approval', ['pending', 'approved', 'rejected'])
                  ->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
