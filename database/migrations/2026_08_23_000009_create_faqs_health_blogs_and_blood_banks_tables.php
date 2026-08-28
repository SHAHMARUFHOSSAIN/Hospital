<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('faqs')) {
            Schema::create('faqs', function (Blueprint $table) {
                $table->id();
                $table->string('question');
                $table->text('answer');
                $table->string('category')->default('General Inquiry');
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('health_blogs')) {
            Schema::create('health_blogs', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('author')->nullable();
                $table->string('category')->default('Health Tips');
                $table->text('content');
                $table->string('image')->nullable();
                $table->date('published_at')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('blood_banks')) {
            Schema::create('blood_banks', function (Blueprint $table) {
                $table->id();
                $table->string('blood_group'); // e.g. A+, A-, B+, B-, O+, O-, AB+, AB-
                $table->integer('units_available')->default(0);
                $table->string('last_updated')->nullable();
                $table->string('contact_number')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_banks');
        Schema::dropIfExists('health_blogs');
        Schema::dropIfExists('faqs');
    }
};
