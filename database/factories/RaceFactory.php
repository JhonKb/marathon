<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Race>
 */
class RaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'day' => fake()->date(),
            'time' => fake()->time('H:i'),
            'turns' => fake()->randomDigitNotZero(),
            'total_distance_km' => fake()->randomFloat(1, 5, 50),
            'status' => fake()->randomElement(['Closed Registrations']),
            'description' => fake()->paragraph(),
        ];
    }
}
