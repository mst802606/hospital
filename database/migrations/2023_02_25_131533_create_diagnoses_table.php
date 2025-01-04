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
            $table->integer("doctor_id");
            $table->integer("visit_id");
            $table->longText("diagnosis");
            $table->longText("prescription");
            $table->longText("regulation");
            $table->longText("message");
            $table->longText("patient_comment")->nullable();
            $table->integer("patient_rating");
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
