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
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $name,
            'slug' => str($name)->slug() . '-' . $this->faker->unique()->numberBetween(100, 999), // Ensure uniqueness
            'bio' => $this->faker->paragraphs(2, true),
            'technical_rider' => $this->faker->sentence(10),
            'starting_price' => $this->faker->randomFloat(2, 500, 10000),
            'location' => $this->faker->city() . ', ' . $this->faker->stateAbbr(),
            'status' => 'active',
            'internal_notes' => 'Generated via seeder for testing.',
            'is_featured' => $this->faker->boolean(10), // 10% chance of being featured
        ];
    }
}
