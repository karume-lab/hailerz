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
        // Admin user
        User::updateOrCreate(
            ['email' => config('app.admin_email', 'admin@mail.com')],
            [
                'name' => config('app.admin_name', 'Agency Admin'),
                'password' => bcrypt(config('app.admin_password', 'password')),
                'email_verified_at' => now(),
            ]
        );

        // Categories (Updated for B2B Pivot)
        $speakers = Category::firstOrCreate(['slug' => 'keynote-speakers'], ['name' => 'Keynote Speakers', 'is_active' => true]);
        $bands = Category::firstOrCreate(['slug' => 'live-bands-ensembles'], ['name' => 'Live Bands & Ensembles', 'is_active' => true]);
        $performers = Category::firstOrCreate(['slug' => 'corporate-performers'], ['name' => 'Corporate Performers', 'is_active' => true]);
        $djs = Category::firstOrCreate(['slug' => 'djs'], ['name' => 'DJs', 'is_active' => true]);
        $specialty = Category::firstOrCreate(['slug' => 'specialty-acts'], ['name' => 'Specialty Acts', 'is_active' => true]);

        // Enhanced Image Pool with reliable fallbacks
        $images = [
            'musician' => [
                'https://loremflickr.com/1200/800/musician,band,singer/all',
                'https://loremflickr.com/1200/800/jazz,concert,stage/all',
                'https://picsum.photos/seed/musician1/1200/800',
            ],
            'speaker' => [
                'https://loremflickr.com/1200/800/speaker,keynote,seminar/all',
                'https://loremflickr.com/1200/800/leadership,conference/all',
                'https://picsum.photos/seed/speaker1/1200/800',
            ],
            'dj' => [
                'https://loremflickr.com/1200/800/dj,nightclub,decks/all',
                'https://loremflickr.com/1200/800/electronic,music,mixer/all',
                'https://picsum.photos/seed/dj1/1200/800',
            ],
            'general' => [
                'https://loremflickr.com/1200/800/performance,luxury,event/all',
                'https://loremflickr.com/1200/800/gala,theatre,art/all',
                'https://picsum.photos/1200/800',
            ]
        ];

        // Talent 1: Horizon Elite
        $djTalent = Talent::firstOrCreate(
            ['slug' => 'horizon-elite'],
            [
                'category_id' => $djs->id,
                'name' => 'Horizon Elite',
                'bio' => 'Award-winning technical DJ and sound producer specializing in high-profile corporate galas and luxury brand launches.',
                'technical_rider' => 'Pioneer CDJ-3000 x 4, DJM-900NXS2 mixer, dedicated sound engineer on site.',
                'starting_price' => 3500.00,
                'location' => 'Nairobi, Kenya',
                'status' => 'active',
                'is_featured' => true,
            ]
        );
        if (!$djTalent->hasMedia('primary_image')) {
            try {
                $djTalent->addMediaFromUrl($images['dj'][0])->toMediaCollection('primary_image');
            } catch (\Exception $e) {
                try {
                    $djTalent->addMediaFromUrl("https://picsum.photos/seed/horizon/1200/800")->toMediaCollection('primary_image');
                } catch (\Exception $e2) {
                    \Illuminate\Support\Facades\Log::error("Failed to seed image for Horizon Elite: " . $e2->getMessage());
                }
            }
        }

        // Talent 2: Dr. Jane Smith
        $speakerTalent = Talent::firstOrCreate(
            ['slug' => 'dr-jane-smith'],
            [
                'category_id' => $speakers->id,
                'name' => 'Dr. Jane Smith',
                'bio' => 'Strategic advisor and keynote speaker specializing in emerging markets, corporate foresight, and African tech ecosystems.',
                'technical_rider' => 'Lavalier mic, high-brightness projector, DCI-compliant screen, remote clicker.',
                'starting_price' => 7500.00,
                'location' => 'Lagos, Nigeria',
                'status' => 'active',
                'is_featured' => true,
            ]
        );
        if (!$speakerTalent->hasMedia('primary_image')) {
            try {
                $speakerTalent->addMediaFromUrl($images['speaker'][0])->toMediaCollection('primary_image');
            } catch (\Exception $e) {
                try {
                    $speakerTalent->addMediaFromUrl("https://picsum.photos/seed/janesmith/1200/800")->toMediaCollection('primary_image');
                } catch (\Exception $e2) {
                    \Illuminate\Support\Facades\Log::error("Failed to seed image for Dr. Jane Smith: " . $e2->getMessage());
                }
            }
        }

        // Additional high-quality talents
        $talents = [
            [
                'name' => 'Sahara Symphonic Ensemble',
                'category' => $bands,
                'slug' => 'sahara-symphonic',
                'bio' => 'A premier live ensemble delivering sophisticated fusion performances for diplomatic and corporate dinners.',
                'img' => $images['musician'][0]
            ],
            [
                'name' => 'The Accra AfroBeat Collective',
                'category' => $bands,
                'slug' => 'accra-afrobeat',
                'bio' => 'Internationally acclaimed collective specializing in vibrant, large-scale event entertainment and cultural showcases.',
                'img' => $images['musician'][1]
            ],
            [
                'name' => 'Koffi Lion',
                'category' => $performers,
                'slug' => 'koffi-lion',
                'bio' => 'Executive event host and professional MC with extensive experience in international summit moderation.',
                'img' => $images['general'][1]
            ]
        ];

        foreach ($talents as $t) {
            $talent = Talent::firstOrCreate(
                ['slug' => $t['slug']],
                [
                    'category_id' => $t['category']->id,
                    'name' => $t['name'],
                    'bio' => $t['bio'],
                    'location' => 'Accra, Ghana',
                    'starting_price' => rand(2500, 8000),
                    'status' => 'active',
                    'is_featured' => true,
                ]
            );
            if (!$talent->hasMedia('primary_image')) {
                try {
                    $talent->addMediaFromUrl($t['img'])->toMediaCollection('primary_image');
                } catch (\Exception $e) {
                    try {
                        $talent->addMediaFromUrl("https://picsum.photos/seed/{$t['slug']}/1200/800")->toMediaCollection('primary_image');
                    } catch (\Exception $e2) {
                        \Illuminate\Support\Facades\Log::error("Failed to seed image for {$t['name']}: " . $e2->getMessage());
                    }
                }
            }
        }

        // Random additional talents
        $categories = Category::all();
        if (Talent::count() < 25) {
            Talent::factory()->count(15)->create([
                'category_id' => fn() => $categories->random()->id,
            ])->each(function ($t) use ($images) {
                // Determine appropriate image pool based on category
                $pool = 'general';
                if (str_contains($t->category->slug, 'speaker')) $pool = 'speaker';
                if (str_contains($t->category->slug, 'dj')) $pool = 'dj';
                if (str_contains($t->category->slug, 'band') || str_contains($t->category->slug, 'musician')) $pool = 'musician';

                try {
                    $t->addMediaFromUrl($images[$pool][array_rand($images[$pool])])->toMediaCollection('primary_image');
                } catch (\Exception $e) {
                    try {
                        $t->addMediaFromUrl("https://picsum.photos/seed/{$t->id}/1200/800")->toMediaCollection('primary_image');
                    } catch (\Exception $e2) {
                        \Illuminate\Support\Facades\Log::error("Failed to seed random image for talent: " . $e2->getMessage());
                    }
                }
            });
        }

        // Inquiries
        if (Inquiry::count() === 0) {
            Inquiry::create([
                'talent_id' => $djTalent->id,
                'client_name' => 'Global Procurement Group',
                'client_email' => 'procurement@globalgroup.com',
                'event_date' => Carbon::now()->addMonths(2),
                'event_type' => 'Corporate',
                'budget' => 5000.00,
                'message' => 'Seeking a premier DJ for an exclusive corporate gala at the Nairobi National Museum.',
                'status' => InquiryStatus::New,
            ]);
        }

        // News Posts
        $post = Post::firstOrCreate(
            ['slug' => 'future-of-corporate-entertainment-2026'],
            [
                'title' => 'The Evolution of Corporate Entertainment in 2026',
                'content' => "The global entertainment landscape for corporate events is shifting towards immersive, culturally-rich experiences. Keynote speakers and specialty acts are now central to brand narrative and engagement strategies.",
                'is_published' => true,
            ]
        );
        if (!$post->hasMedia('featured_image')) {
            try {
                $post->addMediaFromUrl("https://loremflickr.com/1200/800/business,event/all")->toMediaCollection('featured_image');
            } catch (\Exception $e) {}
        }

        // Email Templates (B2B Tone)
        EmailTemplate::firstOrCreate(
            ['name' => 'Application Received'],
            [
                'subject' => 'Application for Roster Representation: {{artist_name}}',
                'body' => '<p>Thank you for your interest in joining the Hailerz roster.</p><p>Our A&R and talent procurement team is currently reviewing your professional profile and performance assets. Due to the high volume of applications from world-class performers, we only reach out to candidates who align with our current corporate and luxury event requirements.</p><p>A senior agent will contact you within 5-7 business days if there is a potential fit for representation.</p><p>Regards,<br>Hailerz Talent Management</p>'
            ]
        );

        EmailTemplate::firstOrCreate(
            ['name' => 'Inquiry Submitted'],
            [
                'subject' => 'Booking Inquiry Received: {{event_type}}',
                'body' => '<p>Thank you for submitting your booking inquiry.</p><p>A senior booking agent has been assigned to your request and is currently reviewing your event specifications and investment parameters. We prioritize providing comprehensive, tailored proposals that ensure the perfect alignment between talent and event DNA.</p><p>You can expect a formal proposal or a request for a briefing call within 24 business hours.</p><p>Best regards,<br>Hailerz Agency Team</p>'
            ]
        );
    }
}