<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement([User::TYPE_SERVICE_USER, User::TYPE_ADMINISTRATOR]),
        ];
    }
}