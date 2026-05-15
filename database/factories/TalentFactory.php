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
        $categories = [
            'DJs' => [
                'names' => ['DJ Horizon', 'Mixmaster Pro', 'Sound Architect X', 'Electronic Pulse', 'Sonic Curator'],
                'bios' => [
                    "A technical virtuoso behind the decks, specializing in high-energy corporate galas and luxury product launches.",
                    "Blending deep house with industrial textures, this artist creates the perfect sonic backdrop for premium brand experiences.",
                    "With over 15 years of international experience, they are the go-to sound architect for Fortune 500 closing parties."
                ],
                'riders' => "Pioneer CDJ-3000 x 3, DJM-900NXS2 mixer, dedicated monitoring system, and professional-grade booth lighting.",
                'images' => ['dj-hero', 'dj-set-1', 'dj-set-2'],
                'video' => 'https://www.youtube.com/watch?v=zHn1A6M6_Yk'
            ],
            'Speakers' => [
                'names' => ['Dr. Elena Vance', 'Marcus Chen, Futurist', 'Sarah O\'Connor, CEO', 'Julian Thorne', 'Amara Okafor'],
                'bios' => [
                    "A visionary leader focused on the intersection of AI and human creativity, helping organizations navigate the future.",
                    "Global strategic advisor known for high-impact keynotes on digital transformation and sustainable corporate growth.",
                    "Empowering teams through narrative-driven sessions on leadership, resilience, and the evolving global economy."
                ],
                'riders' => "Lavalier microphone (Sennheiser or Shure), confidence monitor, remote slide clicker, and high-speed fiber internet for live demos.",
                'images' => ['speaker-hero', 'speaker-1', 'speaker-2'],
                'video' => 'https://www.youtube.com/watch?v=7Pq-S557XQU'
            ],
            'Musicians' => [
                'names' => ['The Skyline Quintet', 'Midnight Velvet', 'Apex Live', 'The Grand Ensembles', 'Pulse Collective'],
                'bios' => [
                    "A premium live band delivering sophisticated jazz and contemporary fusion for diplomatic and black-tie dinners.",
                    "The ultimate high-octane ensemble for corporate celebrations, featuring exceptional vocalists and a tight horn section.",
                    "Specializing in tailored musical journeys that elevate event atmospheres with elegance and professional artistry."
                ],
                'riders' => "Full PA system, 5x vocal mics, drum kit shell pack, bass & guitar amps, and a 20x15ft stage area.",
                'images' => ['band-hero', 'musician-1', 'musician-2'],
                'video' => 'https://www.youtube.com/watch?v=j_S6M9Z6mE8'
            ],
            'MCs' => [
                'names' => ['Koffi Lion', 'Jessica Sterling', 'The Master of Ceremonies', 'David Grant', 'Elena Rossi'],
                'bios' => [
                    "Professional moderator and event host with extensive experience in international summit facilitation.",
                    "The premier choice for corporate awards ceremonies, known for impeccable timing and a sophisticated stage presence.",
                    "An executive host who seamlessly bridges the gap between speakers and the audience with wit and authority."
                ],
                'riders' => "Wireless handheld microphone, lectern with reading light, and a detailed run-of-show briefing session.",
                'images' => ['mc-hero', 'mc-1', 'mc-2'],
                'video' => 'https://www.youtube.com/watch?v=uD4izufzh28'
            ],
            'Variety Artists' => [
                'names' => ['Digital Illusionist X', 'Aerial Synergy', 'The Light Painters', 'Cyber Cirque', 'Neo-Classical Fusion'],
                'bios' => [
                    "Pushing the boundaries of perception with cutting-edge digital magic and interactive holographic technology.",
                    "A breathtaking display of gravity-defying aerial performance tailored for grand openings and gala finales.",
                    "Creating live, light-based art installations that transform event spaces into immersive brand stories."
                ],
                'riders' => "DMX-controlled lighting rig, heavy-duty rigging points (certified), and a 30-minute technical soundcheck.",
                'images' => ['illusionist-hero', 'variety-1', 'variety-2'],
                'video' => 'https://www.youtube.com/watch?v=60fD1432f78'
            ]
        ];

        $categoryName = fake()->randomElement(array_keys($categories));
        $data = $categories[$categoryName];
        
        $name = fake()->randomElement($data['names']);
        $imageNumber = fake()->numberBetween(1, 4);
        $imageName = "talent-{$imageNumber}";

        return [
            'category_id' => \App\Models\Category::where('name', $categoryName)->first()?->id ?? \App\Models\Category::factory(),
            'name' => $name,
            'slug' => str($name)->slug() . '-' . fake()->unique()->numberBetween(100, 999),
            'bio' => fake()->randomElement($data['bios']),
            'technical_rider' => $data['riders'],
            'video_url' => $data['video'],
            'primary_image_url' => "/images/home/featured/{$imageName}.webp",
            'starting_price' => fake()->randomFloat(2, 500, 5000),
            'location' => fake()->city(),
            'country' => fake()->country(),
            'status' => 'active',
            'internal_notes' => 'Premium B2B talent generated for production-grade testing.',
            'is_featured' => fake()->boolean(20),
        ];
    }
}
