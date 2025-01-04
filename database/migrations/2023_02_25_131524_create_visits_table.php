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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id');
            $table->integer('doctor_id');
            $table->integer('patient_id');
            $table->integer('hopsital_id')->default(1);
            $table->integer('diagnosis_id')->nullable();
            $table->longText('doctor_comment');
            $table->longText('patient_comment')->nullable();;
            $table->integer('patient_rating')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
