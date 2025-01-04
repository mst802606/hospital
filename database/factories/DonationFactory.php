<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Donation::class;
    public function definition(): array
    {
        return [
            //

            "patient_id" => rand(1, 10),
            "hospital_id" => rand(1, 10),
            "doctor_id" => rand(1, 10),
            "organ" => $this->faker->bloodType(),
            "message" => $this->faker->sentence(),
            "tested" => $this->faker->boolean(),
            "accepted" => $this->faker->boolean(),
            "status" => $this->faker->boolean(),
            "time" => now(),
            "donor_message" => $this->faker->sentence(),
        ];
    }
}
