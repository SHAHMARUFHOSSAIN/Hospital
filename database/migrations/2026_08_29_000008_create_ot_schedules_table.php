<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ot_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('ot_no')->unique();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('surgeon_id')->nullable()->constrained('directors')->onDelete('set null');
            $table->string('operation_type');
            $table->string('ot_room')->default('OT Suite 01');
            $table->timestamp('scheduled_datetime');
            $table->string('status')->default('scheduled'); // scheduled, in_progress, completed, cancelled
            $table->string('anesthetist_name')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ot_schedules');
    }
};
