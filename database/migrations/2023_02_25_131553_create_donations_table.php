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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->integer("patient_id");
            $table->integer("hospital_id")->default(1);
            $table->string("doctor_id")->nullable();
            $table->string("organ");
            $table->longText("time");
            $table->longText("donor_message");
            $table->longText("message")->nullable();
            $table->boolean("tested")->nullable();
            $table->boolean("accepted")->nullable();
            $table->boolean("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
