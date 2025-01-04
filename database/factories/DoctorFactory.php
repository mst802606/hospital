<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Doctor::class;
    public function definition(): array
    {
        return [
            //
            "user_id"=>2,
            'tag' => $this->faker->imei(),
            'department' => $this->faker->jobTitle(),
            'role' => $this->faker->jobTitle(),
            'office' => $this->faker->jobTitle(),
            'office_days' => $this->faker->dayOfWeek(now()),
            'office_hours' => rand(8, 21),
            'available' => $this->faker->boolean(),
        ];
    }
}
