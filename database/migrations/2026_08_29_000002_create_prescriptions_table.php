<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('prescription_no')->unique(); // e.g. RX-2026-0001
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('directors')->onDelete('set null');
            $table->string('vitals_bp')->nullable();
            $table->string('vitals_pulse')->nullable();
            $table->string('vitals_weight')->nullable();
            $table->string('vitals_temp')->nullable();
            $table->text('chief_complaints')->nullable();
            $table->text('diagnosis')->nullable();
            $table->json('medicines')->nullable(); // Array of {name, dosage, timing, duration}
            $table->text('advised_tests')->nullable();
            $table->text('general_advice')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
