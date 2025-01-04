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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->integer('hospital_id')->default(1);
            $table->string('tag');
            $table->string('department');
            $table->string('role');
            $table->string('office');
            $table->string('office_days');
            $table->string('office_hours');
            $table->boolean('available')->default(true); // default to true

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurses');
    }
};
