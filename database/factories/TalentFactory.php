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
                'images' => ['photo-1571266028243-e4733b0f0bb1', 'photo-1598387181032-a3103a2db5b3', 'photo-1574672280600-4accfa5b6f98'],
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
                'images' => ['photo-1507679799987-c73779587ccf', 'photo-1475721027185-39a12947c004', 'photo-1544717305-2782549b5136'],
                'video' => 'https://www.youtube.com/watch?v=7Pq-S557XQU'
            ],
            'Musicians' => [
                'names' => ['The Skyline Quintet', 'Midnight Velvet', 'Apex Live', 'The Grand Ensembles', 'Pulse Collective'],
                'bios' => [
                    "A premium live band delivering sophisticated jazz and contemporary fusion for diplomatic and black-tie dinners.",
                    "The ultimate high-octane ensemble for corporate celebrations, featuring world-class vocalists and a tight horn section.",
                    "Specializing in tailored musical journeys that elevate event atmospheres with elegance and professional artistry."
                ],
                'riders' => "Full PA system, 5x vocal mics, drum kit shell pack, bass & guitar amps, and a 20x15ft stage area.",
                'images' => ['photo-1533174072545-7a4b6ad7a6c3', 'photo-1501386761578-eac5c94b800a', 'photo-1511671782779-c97d3d27a1d4'],
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
                'images' => ['photo-1515187029135-18ee286d815b', 'photo-1551818255-e6e10975bc17', 'photo-1520333789090-1afc82db536a'],
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
                'images' => ['photo-1492684223066-81342ee5ff30', 'photo-1481162853357-588f0fb38581', 'photo-1504196606672-aef5c9cefc92'],
                'video' => 'https://www.youtube.com/watch?v=60fD1432f78'
            ]
        ];

        $categoryName = $this->faker->randomElement(array_keys($categories));
        $data = $categories[$categoryName];
        
        $name = $this->faker->randomElement($data['names']);
        $imageId = $this->faker->randomElement($data['images']);

        return [
            'category_id' => \App\Models\Category::where('name', $categoryName)->first()?->id ?? \App\Models\Category::factory(),
            'name' => $name,
            'slug' => str($name)->slug() . '-' . $this->faker->unique()->numberBetween(100, 999),
            'bio' => $this->faker->randomElement($data['bios']),
            'technical_rider' => $data['riders'],
            'video_url' => $data['video'],
            'primary_image_url' => "https://images.unsplash.com/{$imageId}?auto=format&fit=crop&w=1200&q=80",
            'starting_price' => $this->faker->randomFloat(2, 2500, 20000),
            'location' => $this->faker->city() . ', ' . $this->faker->country(),
            'status' => 'active',
            'internal_notes' => 'Premium B2B talent generated for production-grade testing.',
            'is_featured' => $this->faker->boolean(20),
        ];
    }
}
