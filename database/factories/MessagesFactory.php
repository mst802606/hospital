<?php

namespace Database\Factories;

use App\Models\Messages;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Messages>
 */
class MessagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Messages::class;
    public function definition(): array
    {
        $replies = array(
           array(
                "key" => "doctor",
                "message" => $this->faker->sentence(),
                "time" => now(),
            ),
             array(
                "key" => "patient",
                "message" => $this->faker->sentence(),
                "time" => $this->faker->date(),
            ),
            array(
                "key" => "doctor",
                "message" => $this->faker->sentence(),
                "time" => now(),
            ),
        );
        return [
            //
            "user_id" => 1,
            "doctor_id" => 2,
            "patient_id" => 1,
            "title" => "Need an abulance",
            "message" => "We are very happy. We need to see you soon",
            "replies" => json_encode($replies),
        ];
    }
}
