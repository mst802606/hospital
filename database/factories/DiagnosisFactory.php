<?php

namespace Database\Factories;

use App\Models\Diagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnosis>
 */

class DiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Diagnosis::class;
    public function definition(): array
    {
        return [
            //
            "doctor_id" => rand(1, 10),
            "visit_id" => rand(1, 10),
            "diagnosis" => $this->faker->name,
            "prescription" => $this->faker->sentence,
            "regulation" => $this->faker->sentence,
            "message" => $this->faker->sentence,
            "patient_comment" => $this->faker->sentence,
            "patient_rating" =>rand(1, 10),
            "status" => $this->faker->boolean(),
        ];
    }
}
