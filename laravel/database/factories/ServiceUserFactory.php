<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ServiceUser;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceUser>
 */
class ServiceUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'handle_name' => $this->faker->unique()->userName(20),
            'display_name' => $this->faker->name(20),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'profile_path' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
