<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
    public function definition()
    {
        $identification = $this->faker->numberBetween(1000,9999);

        return [
            'name' => $this->faker->name(),
            'identification' => $identification,
            'password' => Hash::make($identification),
        ];
    }
}
