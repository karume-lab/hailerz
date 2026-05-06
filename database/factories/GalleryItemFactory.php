<?php

namespace Database\Factories;

use App\Models\GalleryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GalleryItem>
 */
class GalleryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $media = [
            [
                'url' => 'https://www.youtube.com/watch?v=zHn1A6M6_Yk',
                'title' => 'Live at Madison Square Garden',
                'description' => 'A sold-out performance featuring our premier DJ set with integrated light show.'
            ],
            [
                'url' => 'https://www.youtube.com/watch?v=7Pq-S557XQU',
                'title' => 'TEDx Talk 2025: The Future of AI',
                'description' => 'A visionary keynote address on the intersection of technology and humanity.'
            ],
            [
                'url' => 'https://www.youtube.com/watch?v=j_S6M9Z6mE8',
                'title' => 'Royal Albert Hall Showcase',
                'description' => 'Our flagship ensemble performing for the international diplomatic gala.'
            ],
            [
                'url' => 'https://www.youtube.com/watch?v=uD4izufzh28',
                'title' => 'Global Business Awards Hosting',
                'description' => 'Impeccable moderation for the annual industry recognition ceremony.'
            ],
            [
                'url' => 'https://www.youtube.com/watch?v=60fD1432f78',
                'title' => 'Digital Illusionist World Tour',
                'description' => 'Revolutionary holographic magic performance captured live in Tokyo.'
            ]
        ];

        $selected = fake()->randomElement($media);

        return [
            'url' => $selected['url'],
            'title' => $selected['title'],
            'description' => $selected['description'],
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
