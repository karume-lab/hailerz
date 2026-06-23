<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::updateOrCreate(
            ['slug' => 'hailerz-market-place-expo-2026'],
            [
                'title' => 'Hailerz Market Place Expo',
                'date' => Carbon::now()->addMonths(4),
                'description' => 'The premier gathering for corporate event planners, luxury brands, and top-tier talent. Connect with industry leaders, discover innovative event solutions, and secure the perfect talent for your next corporate function.',
                'location' => 'Landmark Centre, Victoria Island, Lagos',
                'exhibitor_price' => 10000.00,
                'attendee_price' => 50000.00,
                'demographics' => ['Corporate Planners', 'Brand Managers', 'Event Professionals', 'Talent Agents'],
                'universities' => ['University of Lagos', 'Pan-Atlantic University', 'Covenant University'],
                'status' => 'upcoming',
                'banner_image' => '/images/events/hailerz-expo-banner.webp',
            ]
        );
    }
}
