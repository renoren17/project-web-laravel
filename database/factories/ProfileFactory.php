<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'umur' => fake()->numberBetween(17, 60),
            'bio' => fake()->jobTitle(),
            'alamat' => fake('id_ID')->address(),
        ];
    }
}
