<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicationPlan>
 */
class MedicationPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Hypertension Control Plan',
            'description' => 'A medication plan aimed at controlling high blood pressure.',
            'start_date' => '2024-09-01',
            'end_date' => '2024-12-31',
        ];
    }
}
