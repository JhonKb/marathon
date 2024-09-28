<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cpf' => fake()->cpf(),
            'birthdate' => fake()->date(max:'-18 years'),
        ];
    }
}
