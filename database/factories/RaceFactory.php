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
        $dateTime = fake()->dateTimeBetween('-3 months', '+3 months')->setTime(fake()->numberBetween(6,20), 0);
        $now = new \DateTime();
        $status = ($dateTime > $now) ? 'Open Registrations' : 'Closed Registrations';

        return [
            'name' => fake()->unique()->word(),
            'date_time' => $dateTime,
            'turns' => fake()->randomDigitNotZero(),
            'total_distance_km' => fake()->randomFloat(1, 5, 50),
            'status' => $status,
            'description' => fake()->paragraph(),
        ];
    }
}
