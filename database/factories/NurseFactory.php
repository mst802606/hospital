<?php

namespace Database\Factories;

use App\Models\Nurse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nurse>
 */
class NurseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Nurse::class;

    public function definition(): array
    {
        return [
            //
            "hospital_id" => 1,
            'tag' => $this->faker->imei(),
            'office_days' => $this->faker->dayOfWeek(now()),
            'available' => true,
        ];
    }
}
