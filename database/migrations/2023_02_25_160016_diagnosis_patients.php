<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //

        // Schema::create('diagnosis_patients', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('diagnosis_id');
        //     $table->integer('patient_id');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // Schema::dropIfExists('diagnosis_patients');
    }
};
