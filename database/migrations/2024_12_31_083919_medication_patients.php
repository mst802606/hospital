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
        Schema::create('medications_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_id')->constrained('medications');
            $table->foreignId('patient_id')->constrained('patients')->nullable();
            $table->foreignId('nurse_id')->constrained('users')->nullable();
            $table->foreignId('doctor_id')->constrained('users')->nullable();
            $table->double('amount_taken_morning')->nullable();
            $table->double('amount_taken_noon')->nullable();
            $table->double('amount_taken_evening')->nullable();
            $table->double('amount_taken_night')->nullable();
            $table->double('total_amount_given')->nullable();
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
        Schema::dropIfExists('medications_patients');
    }
};
