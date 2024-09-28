<?php

namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Race>
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
        $status = ($dateTime > $now) ? 'Closed Inscriptions': 'Open Inscriptions';

        $title = fake()->unique()->jobTitle();
        $name = ucfirst($title) . ' Race';

        return [
            'name' => $name,
            'date_time' => $dateTime,
            'laps' => fake()->randomDigitNotZero(),
            'checkpoints' => fake()->randomDigitNotZero(),
            'total_distance_km' => fake()->randomFloat(1, 5, 50),
            'status' => $status,
            'description' => fake()->paragraph(),
        ];
    }
}
