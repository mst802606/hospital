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

        Schema::create('nurses_wards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nurse_id')->references('id')->on('nurses');
            $table->foreignId('ward_id')->references('id')->on('wards');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('nurses_wards');
    }
};
