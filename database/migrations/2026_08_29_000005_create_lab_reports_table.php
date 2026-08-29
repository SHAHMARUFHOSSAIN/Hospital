<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_no')->unique(); // e.g. LAB-2026-0001
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->string('test_name');
            $table->string('category')->nullable(); // pathology, biochemistry, radiology, hematology
            $table->json('parameters')->nullable(); // Array of {parameter, value, unit, reference_range}
            $table->string('status')->default('completed'); // pending, processing, completed
            $table->text('impression')->nullable();
            $table->string('referred_by')->nullable();
            $table->date('report_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_reports');
    }
};
