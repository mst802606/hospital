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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("doctor_id")->references('id')->on('doctors');
            $table->foreignId("patient_id")->references('id')->on('patients');
            $table->foreignId("visit_id")->nullable()->references('id')->on('visits');
            $table->longText("diagnosis");
            $table->longText("prescription");
            $table->longText("regulation");
            $table->longText("message")->nullable();
            $table->longText("patient_comment")->nullable();
            $table->integer("patient_rating")->default(0);
            $table->boolean("status")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
