<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cabins & Ward Beds Table
        if (!Schema::hasTable('cabins')) {
            Schema::create('cabins', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('room_type')->default('VIP Cabin'); // VIP, Deluxe, Single, Shared, ICU
                $table->decimal('rent_per_day', 10, 2);
                $table->text('amenities')->nullable(); // AC, TV, Attached Bath, Fridge, Attendant Bed
                $table->string('image')->nullable();
                $table->boolean('is_available')->default(true);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Diagnostic Tests & Price List Table
        if (!Schema::hasTable('diagnostic_tests')) {
            Schema::create('diagnostic_tests', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code')->nullable();
                $table->string('category_name')->default('General Diagnostics');
                $table->decimal('price', 10, 2);
                $table->text('description')->nullable();
                $table->text('preparation_instructions')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Medical Machinery & Equipment Table
        if (!Schema::hasTable('medical_equipments')) {
            Schema::create('medical_equipments', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('model_name')->nullable();
                $table->string('department_name')->nullable();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Add doctor degree, fee, and chamber columns to directors table if missing
        Schema::table('directors', function (Blueprint $table) {
            if (!Schema::hasColumn('directors', 'degree')) {
                $table->string('degree')->nullable()->after('designation');
            }
            if (!Schema::hasColumn('directors', 'specialization')) {
                $table->string('specialization')->nullable()->after('degree');
            }
            if (!Schema::hasColumn('directors', 'experience_years')) {
                $table->integer('experience_years')->default(10)->after('specialization');
            }
            if (!Schema::hasColumn('directors', 'consultation_fee')) {
                $table->decimal('consultation_fee', 10, 2)->default(1000.00)->after('experience_years');
            }
            if (!Schema::hasColumn('directors', 'chamber_days')) {
                $table->string('chamber_days')->default('Sat - Wed')->after('consultation_fee');
            }
            if (!Schema::hasColumn('directors', 'chamber_time')) {
                $table->string('chamber_time')->default('4:00 PM - 8:00 PM')->after('chamber_days');
            }
            if (!Schema::hasColumn('directors', 'room_no')) {
                $table->string('room_no')->default('Room 302')->after('chamber_time');
            }
        });

        // Add doctor_id, serial_no, appointment_date to custom_orders table if missing
        Schema::table('custom_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('custom_orders', 'doctor_id')) {
                $table->unsignedBigInteger('doctor_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('custom_orders', 'serial_no')) {
                $table->integer('serial_no')->nullable()->after('doctor_id');
            }
            if (!Schema::hasColumn('custom_orders', 'appointment_date')) {
                $table->date('appointment_date')->nullable()->after('serial_no');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabins');
        Schema::dropIfExists('diagnostic_tests');
        Schema::dropIfExists('medical_equipments');
    }
};
