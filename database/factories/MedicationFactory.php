<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medication>
 */
class MedicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            [
                'plan_id' => 1, // Assuming Plan ID 1
                'name' => 'Lisinopril',
                'dosage' => '10mg',
                'frequency' => 'Once daily',
                'instructions' => 'Take in the morning with water.',
            ],
            [
                'plan_id' => 1, // Assuming Plan ID 1
                'name' => 'Hydrochlorothiazide',
                'dosage' => '25mg',
                'frequency' => 'Once daily',
                'instructions' => 'Take in the evening with food.',
            ],
        ];
    }
}
