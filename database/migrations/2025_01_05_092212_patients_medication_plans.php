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

        Schema::create('patients_medication_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_plan_id')->constrained('medication_plans');
            $table->foreignId('patient_id')->constrained('patients')->nullable();
            $table->foreignId('nurse_id')->constrained('users')->nullable();
            $table->foreignId('doctor_id')->constrained('users')->nullable();
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
        //

        Schema::dropIfExists('patients_medication_plans');
    }
};
