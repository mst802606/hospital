<?php

namespace Database\Factories;

use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ward>
 */
class WardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ward::class;

    public function definition(): array
    {
        return [
            'hospital_id' => 1,
            'name' => $this->faker->userName,
            'capacity' => rand(10, 100),
            'description' => "The oldest ward",
        ];
    }
}
