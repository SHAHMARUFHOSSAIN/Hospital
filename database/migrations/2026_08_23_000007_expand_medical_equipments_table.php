<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medical_equipments', function (Blueprint $table) {
            if (!Schema::hasColumn('medical_equipments', 'manufacturer')) {
                $table->string('manufacturer')->nullable()->after('model_name');
            }
            if (!Schema::hasColumn('medical_equipments', 'country_of_origin')) {
                $table->string('country_of_origin')->nullable()->after('manufacturer');
            }
            if (!Schema::hasColumn('medical_equipments', 'scan_fee')) {
                $table->decimal('scan_fee', 10, 2)->nullable()->default(0.00)->after('department_name');
            }
            if (!Schema::hasColumn('medical_equipments', 'features')) {
                $table->text('features')->nullable()->after('description');
            }
            if (!Schema::hasColumn('medical_equipments', 'specifications')) {
                $table->text('specifications')->nullable()->after('features');
            }
            if (!Schema::hasColumn('medical_equipments', 'gallery_images')) {
                $table->text('gallery_images')->nullable()->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('medical_equipments', function (Blueprint $table) {
            if (Schema::hasColumn('medical_equipments', 'manufacturer')) {
                $table->dropColumn(['manufacturer', 'country_of_origin', 'scan_fee', 'features', 'specifications', 'gallery_images']);
            }
        });
    }
};
