<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Talent;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\User;
use App\Models\EmailTemplate;
use App\Enums\InquiryStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => config('app.admin_email', 'admin@mail.com')],
            [
                'name' => config('app.admin_name', 'Agency Admin'),
                'password' => bcrypt(config('app.admin_password', 'password')),
                'email_verified_at' => now(),
            ]
        );

        // 2. High-End B2B Categories
        $categories = [
            'Keynote Speakers' => 'keynote-speakers',
            'Live Event Bands' => 'live-event-bands',
            'Executive MCs' => 'executive-mcs',
            'Technical DJs' => 'technical-djs',
            'Experiential Acts' => 'experiential-acts',
        ];

        $categoryModels = [];
        foreach ($categories as $name => $slug) {
            $categoryModels[$name] = Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'is_active' => true]
            );
        }

        // 3. Hero Records
        
        // Star DJ
        $djHero = Talent::updateOrCreate(
            ['slug' => 'dj-horizon-elite'],
            [
                'category_id' => $categoryModels['Technical DJs']->id,
                'name' => 'DJ Horizon',
                'primary_image_url' => 'https://images.unsplash.com/photo-1571266028243-e4733b0f0bb1?auto=format&fit=crop&w=1200&q=80',
                'video_url' => 'https://www.youtube.com/watch?v=zHn1A6M6_Yk',
                'bio' => 'A technical virtuoso behind the decks, DJ Horizon specializes in high-energy corporate galas and luxury product launches. Known for a seamless blend of deep house and industrial textures, they have headlined major tech summits across EMEA.',
                'technical_rider' => "Pioneer CDJ-3000 x 4\nDJM-900NXS2 mixer\n2x d&b audiotechnik M4 monitors\nDedicated sound engineer on site",
                'starting_price' => 4500.00,
                'location' => 'London, UK',
                'status' => 'active',
                'is_featured' => true,
            ]
        );

        // Tech/Futurist Speaker
        $speakerHero = Talent::updateOrCreate(
            ['slug' => 'marcus-chen-futurist'],
            [
                'category_id' => $categoryModels['Keynote Speakers']->id,
                'name' => 'Marcus Chen',
                'primary_image_url' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80',
                'video_url' => 'https://www.youtube.com/watch?v=7Pq-S557XQU',
                'bio' => 'Marcus Chen is a global strategic advisor and futurist known for high-impact keynotes on digital transformation, AI ethics, and the future of work. His sessions at the World Economic Forum have been cited as "essential guidance for the C-suite".',
                'technical_rider' => "Lavalier microphone (Sennheiser G4 or similar)\nConfidence monitor (min 24 inch)\nRemote slide clicker (Logitech Spotlight)\nHigh-speed fiber internet for live demos",
                'starting_price' => 12000.00,
                'location' => 'San Francisco, USA',
                'status' => 'active',
                'is_featured' => true,
            ]
        );

        // Premium Band
        $bandHero = Talent::updateOrCreate(
            ['slug' => 'skyline-quintet'],
            [
                'category_id' => $categoryModels['Live Event Bands']->id,
                'name' => 'The Skyline Quintet',
                'primary_image_url' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1200&q=80',
                'video_url' => 'https://www.youtube.com/watch?v=j_S6M9Z6mE8',
                'bio' => 'The Skyline Quintet delivers sophisticated jazz and contemporary fusion. From diplomatic dinners at the UN to black-tie galas in Monaco, their professional artistry and elegant presence are unmatched in the corporate circuit.',
                'technical_rider' => "Full PA system suitable for 500+ guests\n5x vocal microphones (Shure SM58)\nDrum kit shell pack\nBass & guitar amplifiers\n20x15ft stage area minimum",
                'starting_price' => 8500.00,
                'location' => 'Paris, France',
                'status' => 'active',
                'is_featured' => true,
            ]
        );

        // Executive MC
        $mcHero = Talent::updateOrCreate(
            ['slug' => 'jessica-sterling-mc'],
            [
                'category_id' => $categoryModels['Executive MCs']->id,
                'name' => 'Jessica Sterling',
                'primary_image_url' => 'https://images.unsplash.com/photo-1551818255-e6e10975bc17?auto=format&fit=crop&w=1200&q=80',
                'video_url' => 'https://www.youtube.com/watch?v=uD4izufzh28',
                'bio' => 'Jessica Sterling is the premier choice for corporate awards ceremonies. With a background in broadcast journalism, she brings impeccable timing, wit, and a sophisticated stage presence to every international summit she facilitates.',
                'technical_rider' => "Wireless handheld microphone\nLectern with reading light\nFull run-of-show briefing session 24h prior",
                'starting_price' => 5000.00,
                'location' => 'New York, USA',
                'status' => 'active',
                'is_featured' => true,
            ]
        );

        // Experiential Act
        $experientialHero = Talent::updateOrCreate(
            ['slug' => 'digital-illusionist-x'],
            [
                'category_id' => $categoryModels['Experiential Acts']->id,
                'name' => 'Digital Illusionist X',
                'primary_image_url' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1200&q=80',
                'video_url' => 'https://www.youtube.com/watch?v=60fD1432f78',
                'bio' => 'Pushing the boundaries of perception, Digital Illusionist X combines cutting-edge holographic technology with classic sleight of hand. Perfect for tech product launches and innovation-themed galas.',
                'technical_rider' => "4K Projector (min 10,000 lumens)\nDMX-controlled lighting rig\nBlack stage backdrop (Velvet)\nStage size: 12ft x 12ft minimum",
                'starting_price' => 7000.00,
                'location' => 'Berlin, Germany',
                'status' => 'active',
                'is_featured' => true,
            ]
        );

        // Add Gallery Items to Heroes
        foreach ([$djHero, $speakerHero, $bandHero, $mcHero, $experientialHero] as $hero) {
            \App\Models\GalleryItem::factory()->count(3)->create([
                'galleryable_id' => $hero->id,
                'galleryable_type' => Talent::class,
            ]);
        }

        // 4. Random Additional Talent (Factory)
        if (Talent::count() < 30) {
            Talent::factory()->count(25)->create()->each(function ($t) {
                \App\Models\GalleryItem::factory()->count(rand(2, 4))->create([
                    'galleryable_id' => $t->id,
                    'galleryable_type' => Talent::class,
                ]);
            });
        }

        // 5. Realistic Corporate Inquiries
        $inquiries = [
            [
                'talent_id' => $djHero->id,
                'client_name' => 'TechGlobal Summit 2026',
                'client_email' => 'events@techglobal.com',
                'event_date' => Carbon::now()->addMonths(3),
                'event_type' => 'Closing Gala',
                'budget' => 6000.00,
                'message' => 'Seeking a high-energy performance for our annual tech summit closing party in Barcelona. Expected attendance: 1,500 delegates.',
            ],
            [
                'talent_id' => $speakerHero->id,
                'client_name' => 'Future Finance Forum',
                'client_email' => 'info@futurefinance.org',
                'event_date' => Carbon::now()->addMonths(5),
                'event_type' => 'Keynote Session',
                'budget' => 15000.00,
                'message' => 'We would like Marcus to open our Q3 forum with a 45-minute keynote on the impact of decentralized finance on traditional banking.',
            ],
            [
                'talent_id' => $bandHero->id,
                'client_name' => 'Luxury Automotive Group',
                'client_email' => 'marketing@luxcars.de',
                'event_date' => Carbon::now()->addMonths(2),
                'event_type' => 'Product Launch',
                'budget' => 10000.00,
                'message' => 'Looking for sophisticated live music for the unveiling of our new electric sedan. The atmosphere should be modern, sleek, and premium.',
            ],
            [
                'talent_id' => $mcHero->id,
                'client_name' => 'International NGO Awards',
                'client_email' => 'awards@ingo.org',
                'event_date' => Carbon::now()->addMonths(4),
                'event_type' => 'Awards Ceremony',
                'budget' => 5000.00,
                'message' => 'Seeking an experienced MC to host our annual humanitarian awards. The role requires handling sensitive topics with grace and maintaining a formal tone.',
            ],
            [
                'talent_id' => $experientialHero->id,
                'client_name' => 'Cybersecurity Expo',
                'client_email' => 'exhibitions@cybersec.co.uk',
                'event_date' => Carbon::now()->addMonths(6),
                'event_type' => 'Exhibition Opener',
                'budget' => 8000.00,
                'message' => 'We want a "wow factor" opening act for our London expo. Your digital illusion set seems like a perfect fit for our theme.',
            ],
        ];

        foreach ($inquiries as $inquiryData) {
            Inquiry::create(array_merge($inquiryData, ['status' => InquiryStatus::New]));
        }

        // 6. News Posts
        Post::updateOrCreate(
            ['slug' => 'future-of-corporate-entertainment-2026'],
            [
                'title' => 'The Evolution of Corporate Entertainment in 2026',
                'content' => "The global entertainment landscape for corporate events is shifting towards immersive, culturally-rich experiences. Keynote speakers and specialty acts are now central to brand narrative and engagement strategies.",
                'is_published' => true,
            ]
        );

        // 7. Email Templates (B2B Tone)
        EmailTemplate::updateOrCreate(
            ['name' => 'Application Received'],
            [
                'subject' => 'Application for Roster Representation: {{artist_name}}',
                'body' => '<p>Thank you for your interest in joining the Hailerz roster.</p><p>Our A&R and talent procurement team is currently reviewing your professional profile and performance assets. Due to the high volume of applications from world-class performers, we only reach out to candidates who align with our current corporate and luxury event requirements.</p><p>A senior agent will contact you within 5-7 business days if there is a potential fit for representation.</p><p>Regards,<br>Hailerz Talent Management</p>'
            ]
        );

        EmailTemplate::updateOrCreate(
            ['name' => 'Inquiry Submitted'],
            [
                'subject' => 'Booking Inquiry Received: {{event_type}}',
                'body' => '<p>Thank you for submitting your booking inquiry.</p><p>A senior booking agent has been assigned to your request and is currently reviewing your event specifications and investment parameters. We prioritize providing comprehensive, tailored proposals that ensure the perfect alignment between talent and event DNA.</p><p>You can expect a formal proposal or a request for a briefing call within 24 business hours.</p><p>Best regards,<br>Hailerz Agency Team</p>'
            ]
        );
    }
}