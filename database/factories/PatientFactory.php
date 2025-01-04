<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Patient::class;
    public function definition(): array
    {
        return [
            //
            'user_id'=>1,
            'hospital_id'=>1,
            'admitted'=>$this->faker->boolean(),
            'status'=>$this->faker->boolean(),
        ];
    }
}
