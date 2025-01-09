<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medication_medication_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_id')->rerefences('id')->on('medication_plans');
            $table->foreignId('medication_plan_id')->rerefences('id')->on('medication_plans');
            $table->foreignId('nurse_id')->nullable()->rerefences('id')->on('nurses');
            $table->foreignId('doctor_id')->nullable()->rerefences('id')->on('doctors');
            $table->text('recommendation_notes')->nullable();
            $table->enum('status', ['pending', 'active', 'completed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_medication_plans');
    }
};
