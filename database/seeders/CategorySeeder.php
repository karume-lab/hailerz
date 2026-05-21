<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Musicians',
                'slug' => 'musicians',
                'icon' => 'music',
                'description' => 'Solo instrumentalists and vocalists across all genres - from classical pianists to contemporary guitarists.',
                'popular_genres' => ['Jazz', 'Classical', 'Pop', 'Rock', 'Country', 'R&B'],
                'popular_for' => 'Weddings, Corporate Dinners, Private Parties',
                'typical_pricing' => '₦30k - ₦80k',
                'is_professional' => false,
            ],
            [
                'name' => 'Variety Artists',
                'slug' => 'variety-artists',
                'icon' => 'users',
                'description' => 'Full ensembles and variety acts that bring energy and diversity to any event, from acoustic trios to full performance groups.',
                'popular_genres' => ['Rock', 'Jazz', 'Cover Bands', 'Indie', 'Blues', 'Folk'],
                'popular_for' => 'Weddings, Festivals, Corporate Events',
                'typical_pricing' => '₦80k - ₦230k',
                'is_professional' => false,
            ],
            [
                'name' => 'DJs',
                'slug' => 'djs',
                'icon' => 'disc',
                'description' => 'Professional DJs who read the room and keep the energy high with beautifully curated playlists and mixing.',
                'popular_genres' => ['EDM', 'Hip Hop', 'House', 'Top 40', 'Latin', 'Throwback'],
                'popular_for' => 'Clubs, Parties, Weddings, Corporate Events',
                'typical_pricing' => '₦50k - ₦120k',
                'is_professional' => true,
            ],
            [
                'name' => 'Speakers',
                'slug' => 'speakers',
                'icon' => 'mic',
                'description' => 'Keynote speakers, motivational speakers, and industry specialists who inspire and educate audiences.',
                'popular_genres' => ['Business', 'Tech', 'Motivation', 'Performance', 'Education'],
                'popular_for' => 'Conferences, Corporate Events, Fundraisers',
                'typical_pricing' => '₦150k - ₦750k+',
                'is_professional' => true,
            ],
            [
                'name' => 'Dancers',
                'slug' => 'dancers',
                'icon' => 'sparkles',
                'description' => 'Professional dancers and choreographers specializing in contemporary, traditional, and Afrobeat performances.',
                'popular_genres' => ['Contemporary', 'Afrobeat', 'Traditional', 'Hip Hop', 'Ballet'],
                'popular_for' => 'Weddings, Cultural Events, Corporate Shows',
                'typical_pricing' => '₦40k - ₦100k',
                'is_professional' => false,
            ],
            [
                'name' => 'Artists',
                'slug' => 'artists',
                'icon' => 'palette',
                'description' => 'Live painters and visual artists who create stunning artwork during your event.',
                'popular_genres' => ['Live Painting', 'Portrait Art', 'Abstract', 'Graffiti', 'Digital Art'],
                'popular_for' => 'Corporate Events, Exhibitions, Private Parties',
                'typical_pricing' => '₦50k - ₦150k',
                'is_professional' => false,
            ],
            [
                'name' => 'Poets',
                'slug' => 'poets',
                'icon' => 'book-open',
                'description' => 'Spoken word artists and poets who captivate audiences with powerful performances and storytelling.',
                'popular_genres' => ['Spoken Word', 'Poetry', 'Storytelling', 'Slam Poetry'],
                'popular_for' => 'Cultural Events, Conferences, Intimate Gatherings',
                'typical_pricing' => '₦30k - ₦70k',
                'is_professional' => false,
            ],
            [
                'name' => 'Content Creators',
                'slug' => 'content-creators',
                'icon' => 'video',
                'description' => 'Social media influencers and content creators who bring modern digital engagement to your brand.',
                'popular_genres' => ['Social Media', 'Lifestyle', 'Fashion', 'Tech', 'Food'],
                'popular_for' => 'Brand Launches, Product Events, Marketing Campaigns',
                'typical_pricing' => '₦100k - ₦500k+',
                'is_professional' => false,
            ],
            [
                'name' => 'Comedians',
                'slug' => 'comedians',
                'icon' => 'laugh',
                'description' => 'Stand-up comedians and comedy performers who bring laughter and joy to any occasion.',
                'popular_genres' => ['Stand-up', 'Improv', 'Sketch Comedy', 'Clean Comedy', 'Roast'],
                'popular_for' => 'Corporate Events, Private Parties, Fundraisers',
                'typical_pricing' => '₦70k - ₦250k',
                'is_professional' => false,
            ],
            [
                'name' => 'MCs',
                'slug' => 'mcs',
                'icon' => 'megaphone',
                'description' => 'Professional event hosts and masters of ceremony who keep your event flowing smoothly and engaging.',
                'popular_genres' => ['Event Hosting', 'Emcee', 'Announcer', 'Moderator'],
                'popular_for' => 'Weddings, Conferences, Award Ceremonies, Galas',
                'typical_pricing' => '₦50k - ₦200k',
                'is_professional' => true,
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['is_active' => true])
            );
        }
    }
}
