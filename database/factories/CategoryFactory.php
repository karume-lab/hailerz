<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        // Removed B2C terms: 'Influencers', 'Celebrity Chefs'
        // Added B2B terms: 'Brand Ambassadors', 'Master Chefs', 'Illusionists'
        $name = $this->faker->unique()->randomElement([
            'Musicians', 'Corporate Dancers', 'Comedians', 'Keynote Speakers', 'Illusionists', 
            'Acrobatic Troupes', 'Brand Ambassadors', 'Event Hosts', 'Live Event Painters',
            'DJs', 'Jazz Saxophonists', 'Motivational Speakers', 'Master Chefs', 'Spoken Word Artists'
        ]);
        
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'is_active' => true,
        ];
    }
}
