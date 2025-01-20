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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->date('date_of_birth')->nullable();
            $table->boolean('admitted')->default(false);
            $table->text('medical_history')->nullable();
            $table->dateTime('medication_required_at')->nullable();
            $table->foreignId('ward_id')->nullable()->references('id')->on('wards');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }

};
