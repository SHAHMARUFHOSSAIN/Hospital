<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ipd_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no')->unique();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('cabin_id')->nullable()->constrained('cabins')->onDelete('set null');
            $table->foreignId('attending_doctor_id')->nullable()->constrained('directors')->onDelete('set null');
            $table->timestamp('admission_date');
            $table->timestamp('discharge_date')->nullable();
            $table->string('status')->default('admitted'); // admitted, discharged, transferred
            $table->decimal('daily_rent', 10, 2)->default(0.00);
            $table->decimal('total_bill_amount', 10, 2)->default(0.00);
            $table->text('discharge_summary')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ipd_admissions');
    }
};
