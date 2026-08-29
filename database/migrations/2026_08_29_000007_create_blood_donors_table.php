<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_donors', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('blood_group');
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->date('last_donated_date')->nullable();
            $table->boolean('is_eligible')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_donors');
    }
};
