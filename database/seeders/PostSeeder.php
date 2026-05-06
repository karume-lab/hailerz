<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'How to Choose the Right Talent for Your Event',
                'slug' => 'how-to-choose-the-right-talent-for-your-event',
                'category' => 'Guides',
                'author' => 'Hailerz Team',
                'image_url' => asset('images/resources/blog-1.webp'),
                'subtitle' => 'Picking the perfect performer can make or break your event. Here are the key questions to ask before you book.',
                'content' => [
                    ['type' => 'p', 'text' => 'Choosing the right talent for your event is one of the most important decisions you will make. The right performer can elevate your event from good to unforgettable, while the wrong choice can leave guests disappointed.'],
                    ['type' => 'h2', 'text' => 'Know Your Audience'],
                    ['type' => 'p', 'text' => 'Before you start browsing talent profiles, take time to understand who will be attending your event. Are they corporate executives, wedding guests, or festival-goers? Different audiences have different expectations and preferences.'],
                    ['type' => 'h2', 'text' => 'Match the Vibe'],
                    ['type' => 'p', 'text' => 'Consider the atmosphere you want to create. A jazz trio might be perfect for an intimate corporate dinner, but a high-energy DJ could be better for a product launch party.'],
                    ['type' => 'h2', 'text' => 'Budget Wisely'],
                    ['type' => 'p', 'text' => 'Quality talent is an investment. Set a realistic budget that reflects the importance of entertainment to your event success.'],
                    ['type' => 'h2', 'text' => 'Check Reviews & Experience'],
                    ['type' => 'p', 'text' => 'Look for performers with proven track records. Read reviews, watch performance videos, and do not hesitate to ask for references.'],
                ],
                'is_published' => true,
                'published_at' => '2026-03-20 00:00:00',
            ],
            [
                'title' => 'Top Event Trends in Nigeria for 2026',
                'slug' => 'top-event-trends-in-nigeria-2026',
                'category' => 'Industry',
                'author' => 'Hailerz Team',
                'image_url' => asset('images/resources/blog-2.webp'),
                'subtitle' => 'From Afrobeats fusion to immersive experiences, discover what is shaping the Nigerian event industry this year.',
                'content' => [
                    ['type' => 'p', 'text' => 'The Nigerian event industry is booming, and 2026 is shaping up to be an exciting year. Here are the top trends we are seeing:'],
                    ['type' => 'h2', 'text' => '1. Afrobeats Fusion'],
                    ['type' => 'p', 'text' => 'Afrobeats continues to dominate, but we are seeing more fusion with other genres like jazz, R&B, and electronic music.'],
                    ['type' => 'h2', 'text' => '2. Immersive Experiences'],
                    ['type' => 'p', 'text' => 'Events are becoming more interactive, with live art installations, photo booths, and audience participation elements.'],
                    ['type' => 'h2', 'text' => '3. Sustainability Focus'],
                    ['type' => 'p', 'text' => 'Eco-friendly events are on the rise, with organizers choosing sustainable venues and reducing waste.'],
                    ['type' => 'h2', 'text' => '4. Hybrid Events'],
                    ['type' => 'p', 'text' => 'Combining in-person and virtual elements allows for broader reach and accessibility.'],
                ],
                'is_published' => true,
                'published_at' => '2026-03-15 00:00:00',
            ],
            [
                'title' => 'Hailerz Launch Event Recap',
                'slug' => 'hailerz-launch-event-recap',
                'category' => 'News',
                'author' => 'Hailerz Team',
                'image_url' => asset('images/resources/blog-3.webp'),
                'subtitle' => 'Over 200 guests joined us to celebrate the official launch of Hailerz. Here is what went down.',
                'content' => [
                    ['type' => 'p', 'text' => 'Last week, we celebrated the official launch of Hailerz with an unforgettable evening at the Eko Hotel & Suites in Lagos.'],
                    ['type' => 'h2', 'text' => 'The Night'],
                    ['type' => 'p', 'text' => 'Over 200 event planners, talent managers, and industry professionals joined us for an evening of networking, entertainment, and celebration.'],
                    ['type' => 'h2', 'text' => 'Featured Performances'],
                    ['type' => 'p', 'text' => 'We showcased some of Nigeria finest talent, including live jazz, Afrobeats DJ sets, and spoken word poetry.'],
                    ['type' => 'h2', 'text' => 'What is Next'],
                    ['type' => 'p', 'text' => 'This is just the beginning. We are excited to connect more talent with more events across Nigeria and beyond.'],
                ],
                'is_published' => true,
                'published_at' => '2026-03-10 00:00:00',
            ],
        ];

        foreach ($posts as $postData) {
            Post::updateOrCreate(['slug' => $postData['slug']], $postData);
        }
    }
}
