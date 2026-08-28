<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('custom_orders', 'booking_type')) {
                $table->string('booking_type')->default('doctor_appointment')->after('doctor_id');
            }
            if (!Schema::hasColumn('custom_orders', 'cabin_id')) {
                $table->unsignedBigInteger('cabin_id')->nullable()->after('doctor_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('custom_orders', function (Blueprint $table) {
            if (Schema::hasColumn('custom_orders', 'booking_type')) {
                $table->dropColumn('booking_type');
            }
            if (Schema::hasColumn('custom_orders', 'cabin_id')) {
                $table->dropColumn('cabin_id');
            }
        });
    }
};
