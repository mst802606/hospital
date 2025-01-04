<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hospital>
 */
class HospitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<, mixed>
     */

     protected $model = Hospital::class;
    public function definition(): array
    {
        return [
            //
            'name'=>$this->faker->name(),
            'city'=>$this->faker->city(),
            'town'=>$this->faker->city(),
            'address'=>$this->faker->address(),
            'doctors'=>$this->faker->numberBetween(30,30),
            'nurses'=>$this->faker->numberBetween(30,30),
            'laboratories'=>$this->faker->numberBetween(4,6),
            'in_services'=>$this->faker->boolean(),
            'status'=>$this->faker->boolean(),
            'description'=>$this->faker->paragraph(),

        ];
    }
}
