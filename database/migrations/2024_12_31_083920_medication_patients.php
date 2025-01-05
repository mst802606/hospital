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
            $table->foreignId('medication_id')->references('id')->on('medications');
            $table->foreignId('patient_id')->nullable()->references('id')->on('patients');
            $table->foreignId('nurse_id')->nullable()->references('id')->on('nurses');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors');
            $table->double('amount_taken_morning')->nullable();
            $table->double('amount_taken_noon')->nullable();
            $table->double('amount_taken_evening')->nullable();
            $table->double('amount_taken_night')->nullable();
            $table->double('total_amount_given')->nullable();
            $table->text('recommendation_notes')->nullable();
            $table->dateTime('last_given')->nullable();
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
