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
                'title' => '🎨 Open Call For Vendors - Hailerz Marketplace Expo 🛍️',
                'date' => Carbon::parse('2026-08-14 09:00:00'),
                'description' => '<p>Hailerz Global Talent is excited to host our upcoming <strong>Business Expo on August 14th</strong>, and we\'re inviting passionate vendors to showcase their products and connect with a wider audience during our <strong>live online event</strong>.</p><p>This is a great opportunity for business owners, creators, and artisans to present their work, meet potential customers, and network in dedicated virtual meeting rooms.</p><p><strong>Event:</strong> Hailerz Marketplace Expo<br><strong>Date:</strong> August 14th<br><strong>Who We\'re Looking For:</strong><br>Sellers, creators, and business owners across all product categories.<br><strong>Vendor Fee:</strong><br>₦10,000/$7 (Early Bird)</p><p>Whether you create <strong>bags, jewelry, baked goods, textiles, artwork, skincare, consumer goods, or financial products</strong>, we would love to feature you at the Expo.</p><p>Spaces are limited — <strong>apply early to secure your spot.</strong></p><p>We look forward to spotlighting incredible vendors like you and helping your business reach new audiences.</p>',
                'location' => 'Virtual',
                'exhibitor_price' => 10000.00,
                'attendee_price' => 50000.00,
                'demographics' => ['Corporate Planners', 'Brand Managers', 'Event Professionals', 'Talent Agents'],
                'universities' => ['University of Lagos', 'Pan-Atlantic University', 'Covenant University'],
                'status' => 'published',
                'banner_image' => '/images/events/hailerz-expo-banner.webp',
            ]
        );
    }
}
