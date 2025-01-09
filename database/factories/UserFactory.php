<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phoneno' => $this->faker->phoneNumber,
            'terms_and_conditions' => true,
        ];
    }

    /**
     * Set the user role to admin.
     *
     * @return static
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 0,
            'is_admin' => true,
        ]);
    }

    /**
     * Set the user role to doctor.
     *
     * @return static
     */
    public function doctor(): static
    {
        return $this->state(fn(array $attributes) => [
            'username' => 'doctor',
            'email' => 'doctor@gmail.com',
            'role' => 2,
        ]);
    }

    /**
     * Set the user role to nurse.
     *
     * @return static
     */
    public function nurse(): static
    {
        return $this->state(fn(array $attributes) => [
            'username' => 'nurse',
            'email' => 'nurse@gmail.com',
            'role' => 3,
        ]);
    }

    public function patient(): static
    {
        return $this->state(fn(array $attributes) => [
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail,
            'role' => 1,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

}
