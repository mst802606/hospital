<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create the admin user
        User::factory()->admin()->create();

        // Create the doctor user
        User::factory()->doctor()->hasDoctor(1)->create();

        // Create the nurse user
        User::factory()->nurse()->hasNurse(1)->create();

        // Create the patient user
        User::factory(10)->patient()->hasPatient(1)->create();
    }
}
