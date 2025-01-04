<?php

namespace Database\Factories;

use App\Models\Appointments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointments>
 */

class AppointmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Appointments::class;

    public function definition(): array
    {
        return [
            //
            'patient_id' => 1,
            'doctor_id' => 1,
            'title' => $this->faker->sentence(),
            'purpose' => $this->faker->sentence(),
            'time' => now(),
            'status' => $this->faker->boolean(),
        ];
    }
}
