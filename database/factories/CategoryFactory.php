<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Keynote Speakers',
            'Live Event Bands',
            'Executive MCs',
            'Technical DJs',
            'Experiential Acts',
            'Symphonic Ensembles',
            'Tech & Futurist Speakers',
            'Luxury Event Performers',
            'Strategic Moderators'
        ]);
        
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'is_active' => true,
        ];
    }
}
