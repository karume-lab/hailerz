<?php

namespace Database\Factories;

use App\Models\Talent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Talent>
 */
class TalentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        
        $corporateBios = [
            "Highly acclaimed professional with over 10 years of experience performing for Fortune 500 corporate summits and international galas.",
            "Specialist in delivering high-impact performances tailored for luxury brand launches and exclusive private events.",
            "A versatile performer known for technical excellence and a sophisticated presence on the global stage.",
            "Dedicated to elevating event atmospheres with world-class artistry and professional production standards.",
            "Renowned for collaborating with visionary event planners to create unforgettable brand experiences and cultural showcases."
        ];

        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $name,
            'slug' => str($name)->slug() . '-' . $this->faker->unique()->numberBetween(100, 999),
            'bio' => $this->faker->randomElement($corporateBios) . " " . $this->faker->paragraph(1),
            'technical_rider' => "Professional stage requirements: " . $this->faker->sentence(10),
            'starting_price' => $this->faker->randomFloat(2, 2000, 15000),
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'status' => 'active',
            'internal_notes' => 'Generated via procurement seeder for agency testing.',
            'is_featured' => $this->faker->boolean(15),
        ];
    }
}
