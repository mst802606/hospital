<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\Doctor::factory(4)->create();
        // \App\Models\Appointments::factory(4)->create();
        \App\Models\Hospital::factory(1)->hasWards(4)->create();

        $this->call([
            UserSeeder::class,
            // VisitsSeeder::class,
            // PatientSeeder::class,
            // DiagnosisSeeder::class,
            // DonationSeeder::class,
            // AppointmentsSeeder::class,
            // MessagesSeeder::class,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
