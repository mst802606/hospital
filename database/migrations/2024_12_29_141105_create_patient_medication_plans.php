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
        //
        Schema::create('patient_medication_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_plan_id')->constrained('medication_plans');
            $table->foreignId('patient_id')->nullable()->constrained('patients');
            $table->foreignId('nurse_id')->nullable()->constrained('users');
            $table->foreignId('doctor_id')->nullable()->constrained('users');
            $table->text('recommendation_notes')->nullable();
            $table->enum('status', ['pending', 'active', 'completed'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("patient_medication_plans");
    }
};
