<?php

namespace Database\Seeders;

use App\Models\MedicationPlan;
use Illuminate\Database\Seeder;

class MedicationPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MedicationPlan::factory(4)->create();
    }
}
