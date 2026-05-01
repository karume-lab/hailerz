<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
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
