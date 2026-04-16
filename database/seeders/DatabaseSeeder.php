<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Talent;
use App\Models\Inquiry;
use App\Models\Post;
use App\Models\User;
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

        // Categories
        $musicians = Category::firstOrCreate(['slug' => 'musicians'], ['name' => 'Musicians', 'is_active' => true]);
        $speakers = Category::firstOrCreate(['slug' => 'keynote-speakers'], ['name' => 'Keynote Speakers', 'is_active' => true]);
        $comedians = Category::firstOrCreate(['slug' => 'comedians'], ['name' => 'Comedians', 'is_active' => true]);
        $dancers = Category::firstOrCreate(['slug' => 'dancers'], ['name' => 'Dancers', 'is_active' => true]);

        // African Talent Image Pool
        $images = [
            'musician' => [
                // African woman singing into a microphone
                'https://images.unsplash.com/photo-1516280440502-d964177dcc0c?auto=format&fit=crop&w=1200&q=80',
                // Black man playing the saxophone 
                'https://images.unsplash.com/photo-1549834125-82d3c48159a3?auto=format&fit=crop&w=1200&q=80',
                // African man playing acoustic guitar
                'https://images.unsplash.com/photo-1520690214124-2405c5217036?auto=format&fit=crop&w=1200&q=80',
            ],
            'speaker' => [
                // African woman presenting on stage
                'https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=1200&q=80',
                // Black businessman speaking/leading a discussion
                'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=80',
                // Confident African woman in a professional setting
                'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?auto=format&fit=crop&w=1200&q=80',
            ],
            'dj' => [
                // Black DJ performing live at a venue
                'https://images.unsplash.com/photo-1621841398031-645398d5c314?auto=format&fit=crop&w=1200&q=80',
                // African DJ mixing on a turntable
                'https://images.unsplash.com/photo-1516057747705-d2861c8a16db?auto=format&fit=crop&w=1200&q=80',
            ],
            'general' => [
                // Stylish African man portrait
                'https://images.unsplash.com/photo-1531384441138-2736e62e0919?auto=format&fit=crop&w=1200&q=80',
                // African woman portrait
                'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1200&q=80',
                // African man in a creative/studio setting
                'https://images.unsplash.com/photo-1506803682981-6e718a9dd3ee?auto=format&fit=crop&w=1200&q=80',
                // High-end African woman portrait
                'https://images.unsplash.com/photo-1523825036634-ab6bc7caeb14?auto=format&fit=crop&w=1200&q=80',
            ]
        ];

        // Talent 1: DJ Horizon
        $djTalent = Talent::firstOrCreate(
            ['slug' => 'dj-horizon'],
            [
                'category_id' => $musicians->id,
                'name' => 'DJ Horizon',
                'bio' => 'Award-winning club DJ and producer specializing in Afro-house and deep tech.',
                'technical_rider' => 'Pioneer CDJ-3000 x 4, DJM-900NXS2 mixer.',
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
            }
        }

        // Talent 2: Dr. Jane Smith
        $speakerTalent = Talent::firstOrCreate(
            ['slug' => 'dr-jane-smith'],
            [
                'category_id' => $speakers->id,
                'name' => 'Dr. Jane Smith',
                'bio' => 'Celebrated futurist and expert in African tech ecosystems.',
                'technical_rider' => 'Lavalier mic, projector, clicker.',
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
            }
        }

        // Additional high-quality talents
        $talents = [
            [
                'name' => 'The Sahara Soul Ensemble',
                'category' => $musicians,
                'slug' => 'sahara-soul',
                'img' => $images['musician'][0]
            ],
            [
                'name' => 'AfroBeat Collective',
                'category' => $musicians,
                'slug' => 'afrobeat-collective',
                'img' => $images['musician'][1]
            ],
            [
                'name' => 'Koffi "The Lion" MC',
                'category' => $comedians,
                'slug' => 'koffi-lion',
                'img' => $images['general'][1]
            ]
        ];

        foreach ($talents as $t) {
            $talent = Talent::firstOrCreate(
                ['slug' => $t['slug']],
                [
                    'category_id' => $t['category']->id,
                    'name' => $t['name'],
                    'bio' => "Professional {$t['category']->name} with international experience.",
                    'location' => 'Accra, Ghana',
                    'starting_price' => rand(1000, 5000),
                    'status' => 'active',
                    'is_featured' => true,
                ]
            );
            if (!$talent->hasMedia('primary_image')) {
                try {
                    $talent->addMediaFromUrl($t['img'])->toMediaCollection('primary_image');
                } catch (\Exception $e) {
                }
            }
        }

        // Random additional talents (smaller number to ensure seeder stability)
        $categories = Category::all();
        if (Talent::count() < 25) {
            Talent::factory()->count(15)->create([
                'category_id' => fn() => $categories->random()->id,
            ])->each(function ($t) use ($images) {
                // Attach a random generic image to half of them
                if (rand(0, 1) === 1) {
                    try {
                        $t->addMediaFromUrl($images['general'][array_rand($images['general'])])->toMediaCollection('primary_image');
                    } catch (\Exception $e) {
                    }
                }
            });
        }

        // Inquiries
        if (Inquiry::count() === 0) {
            Inquiry::create([
                'talent_id' => $djTalent->id,
                'client_name' => 'Global Events Ltd',
                'client_email' => 'booking@globalevents.com',
                'event_date' => Carbon::now()->addMonths(2),
                'event_type' => 'Corporate',
                'budget' => 4000.00,
                'message' => 'Looking for a high-energy DJ for our annual gala.',
                'status' => InquiryStatus::New ,
            ]);
        }

        // News Posts
        Post::firstOrCreate(
            ['slug' => 'future-of-corporate-entertainment-2026'],
            [
                'title' => 'The Future of African Corporate Entertainment in 2026',
                'content' => "The African entertainment landscape is shifting towards immersive, culturally-rich experiences mixed with global tech trends.\n\nKey trends include the rise of private showcases, digital-first talent discovery, and a return to high-energy live performance.",
                'is_published' => true,
            ]
        );
    }

}