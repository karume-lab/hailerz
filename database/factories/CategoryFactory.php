<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Musicians', 'Dancers', 'Comedians', 'Keynote Speakers', 'Magicians', 
            'Acrobats', 'Models', 'Influencers', 'Event Hosts', 'Live Painters',
            'DJs', 'Saxophonists', 'Motivational Speakers', 'Celebrity Chefs', 'Spoken Word Artists'
        ]);
        
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'is_active' => true,
        ];
    }
}
