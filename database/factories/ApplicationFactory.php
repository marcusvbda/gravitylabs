<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => 1
        ];
    }
}
