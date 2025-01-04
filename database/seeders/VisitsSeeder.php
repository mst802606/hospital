<?php

namespace Database\Seeders;

use App\Models\Visits;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Visits::factory(10)->create();
       // Visits::factory(10)->hasAppointment(1)->hasDiagnosis(4)->create();
    }
}
