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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('active_ingredient');
            $table->string('trade_name');
            $table->string('strength');
            $table->enum('form', ['tabl', 'ampulle', 'kapsel'])->default('tabl');
            $table->integer('amount_taken_morning')->default(0);
            $table->integer('amount_taken_noon')->default(0);
            $table->integer('amount_taken_evening')->default(0);
            $table->integer('amount_taken_night')->default(0);
            $table->double('maximum_amount_per_day')->nullable();
            $table->string('unit')->default('stuck');
            $table->string('duration')->nullable();
            $table->dateTime('last_given')->nullable();
            $table->longText('notes')->default('During the meal');
            $table->text('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medications');
    }
};
