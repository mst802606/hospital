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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->nullable();
            $table->integer("doctor_id")->nullable();
            $table->integer("patient_id")->nullable();
            $table->integer("nurse_id")->nullable();
            $table->string("title");
            $table->longText("message");
            $table->longText("replies")->nullable();;
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};