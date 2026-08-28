<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'head_of_dept')) {
                $table->string('head_of_dept')->nullable()->after('name');
            }
            if (!Schema::hasColumn('categories', 'opd_hours')) {
                $table->string('opd_hours')->nullable()->after('head_of_dept');
            }
            if (!Schema::hasColumn('categories', 'emergency_contact')) {
                $table->string('emergency_contact')->nullable()->after('opd_hours');
            }
            if (!Schema::hasColumn('categories', 'bed_info')) {
                $table->string('bed_info')->nullable()->after('emergency_contact');
            }
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'head_of_dept')) {
                $table->dropColumn(['head_of_dept', 'opd_hours', 'emergency_contact', 'bed_info']);
            }
        });
    }
};
