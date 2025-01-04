<?php

namespace Database\Factories;

use App\Models\Visits;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visits>
 */
class VisitsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Visits::class;
    public function definition(): array
    {
        return [
            //
            "appointment_id" => rand(1, 10),
            "doctor_id" => rand(1, 10),
            "patient_id" => rand(0, 3),
            "hopsital_id" => 1,
            "diagnosis_id" => rand(1, 10),
            "doctor_comment" => $this->faker->sentence(),
            "patient_comment" => $this->faker->sentence(),
            "patient_rating" => rand(1, 10),
            "status" => $this->faker->boolean(),
        ];
    }
}
