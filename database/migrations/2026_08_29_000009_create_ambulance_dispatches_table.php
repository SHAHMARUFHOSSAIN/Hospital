<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ambulance_dispatches', function (Blueprint $table) {
            $table->id();
            $table->string('dispatch_no')->unique();
            $table->string('patient_name');
            $table->string('phone');
            $table->string('vehicle_no');
            $table->string('driver_name');
            $table->string('driver_phone')->nullable();
            $table->string('pickup_location');
            $table->string('destination')->default('CarePlus Hospital Emergency Unit');
            $table->decimal('fare_amount', 10, 2)->default(0.00);
            $table->string('status')->default('dispatched'); // dispatched, on_route, completed, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ambulance_dispatches');
    }
};
