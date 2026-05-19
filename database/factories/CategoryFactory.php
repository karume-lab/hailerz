<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Musicians',
            'DJs',
            'Speakers',
            'Dancers',
            'Artists',
            'Poets',
            'Content Creators',
            'Comedians',
            'MCs',
            'Variety Artists',
        ]);

        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'is_active' => true,
        ];
    }
}
