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
        // Admin user for logging into Filament
        User::updateOrCreate(
            ['email' => config('app.admin_email', 'admin@mail.com')],
            [
                'name' => config('app.admin_name', 'Agency Admin'),
                'password' => bcrypt(config('app.admin_password', 'password')),
                'email_verified_at' => now(),
            ]
        );

        // Create Categories idempotently
        $musicians = Category::firstOrCreate(['slug' => 'musicians'], ['name' => 'Musicians', 'is_active' => true]);
        $speakers = Category::firstOrCreate(['slug' => 'keynote-speakers'], ['name' => 'Keynote Speakers', 'is_active' => true]);
        $comedians = Category::firstOrCreate(['slug' => 'comedians'], ['name' => 'Comedians', 'is_active' => true]);

        // Create Talents idempotently
        $djTalent = Talent::firstOrCreate(
            ['slug' => 'dj-horizon'],
            [
                'category_id' => $musicians->id,
                'name' => 'DJ Horizon',
                'bio' => 'Award-winning club DJ and producer.',
                'technical_rider' => 'Pioneer CDJ-3000 x 4, DJM-900NXS2 mixer.',
                'starting_price' => 1500.00,
                'location' => 'Los Angeles, CA',
                'status' => 'active',
                'is_featured' => true,
            ]
        );

        $speakerTalent = Talent::firstOrCreate(
            ['slug' => 'dr-jane-smith'],
            [
                'category_id' => $speakers->id,
                'name' => 'Dr. Jane Smith',
                'bio' => 'Futurist and AI expert.',
                'technical_rider' => 'Lavalier mic, projector, clicker.',
                'starting_price' => 5000.00,
                'location' => 'New York, NY',
                'status' => 'active',
                'is_featured' => false,
            ]
        );
        // Create 100 additional Talents randomly distributed among existing categories
        $categories = Category::all();
        
        if (Talent::count() < 100) {
            Talent::factory()->count(100)->create([
                'category_id' => fn() => $categories->random()->id,
            ]);
        }

        // Create Inquiries (only if they don't exist yet to avoid duplicates)
        if (Inquiry::count() === 0) {
            Inquiry::create([
                'talent_id' => $djTalent->id,
                'client_name' => 'Acme Corp',
                'client_email' => 'events@acmecorp.com',
                'event_date' => Carbon::now()->addMonths(2),
                'event_type' => 'Corporate',
                'budget' => 2000.00,
                'message' => 'Looking for a DJ for our annual summer party.',
                'status' => InquiryStatus::New,
            ]);

            Inquiry::create([
                'talent_id' => $speakerTalent->id,
                'client_name' => 'Tech Summit 2026',
                'client_email' => 'booking@techsummit.io',
                'event_date' => Carbon::parse('2026-10-24'),
                'event_type' => 'Conference',
                'budget' => 6000.00,
                'message' => 'We need Dr. Smith for the closing keynote.',
                'status' => InquiryStatus::Quoted,
            ]);
        }

        // Create Posts
        Post::firstOrCreate(
            ['slug' => 'future-of-corporate-entertainment-2026'],
            [
                'title' => 'The Future of Corporate Entertainment in 2026',
                'content' => "As we move further into 2026, the corporate event landscape is shifting towards immersive, AI-driven experiences mixed with high-touch personal engagement.\n\nKey trends we are seeing include dynamic stage environments, holographic artist telepresence for remote global offices, and a return to high-energy live performance that bridges the gap between digital and physical attendees.",
                'is_published' => true,
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'booking-top-talent-on-a-budget'],
            [
                'title' => 'How to Book Top Tier Talent on a Middle Tier Budget',
                'content' => "Booking elite artists doesn't always require a multi-million dollar budget. Strategy is key.\n\nConsider booking on off-peak days, looking for rising stars just before they hit the global charts, and focusing on technical efficiency. Often, the largest cost after the talent fee is the technical rider-working with agencies to optimize sound and light can save thousands without compromising quality.",
                'is_published' => true,
            ]
        );
    }
}