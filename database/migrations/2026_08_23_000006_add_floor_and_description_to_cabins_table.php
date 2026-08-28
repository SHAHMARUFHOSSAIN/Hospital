<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cabins', function (Blueprint $table) {
            if (!Schema::hasColumn('cabins', 'floor_no')) {
                $table->string('floor_no')->nullable()->after('room_type');
            }
            if (!Schema::hasColumn('cabins', 'bed_count')) {
                $table->string('bed_count')->nullable()->after('floor_no');
            }
            if (!Schema::hasColumn('cabins', 'oxygen_type')) {
                $table->string('oxygen_type')->nullable()->after('bed_count');
            }
            if (!Schema::hasColumn('cabins', 'description')) {
                $table->text('description')->nullable()->after('amenities');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cabins', function (Blueprint $table) {
            if (Schema::hasColumn('cabins', 'floor_no')) {
                $table->dropColumn(['floor_no', 'bed_count', 'oxygen_type', 'description']);
            }
        });
    }
};
