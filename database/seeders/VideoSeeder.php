<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Hailerz: Connecting Talent with Opportunities',
                'slug' => 'hailerz-connecting-talent-opportunities',
                'category' => 'Video',
                'author' => 'Hailerz Team',
                'image_url' => 'https://img.youtube.com/vi/1nNNBbmKP48/maxresdefault.jpg',
                'subtitle' => 'Explore how Hailerz is revolutionizing the way talent and events connect globally.',
                'content' => [
                    ['type' => 'p', 'text' => 'Watch this overview to understand the core mission of Hailerz.'],
                    ['type' => 'video', 'url' => 'https://www.youtube.com/embed/1nNNBbmKP48'],
                ],
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Hailerz Academy: 2026 Training Session',
                'slug' => 'hailerz-academy-2026-training',
                'category' => 'Video',
                'author' => 'Hailerz Team',
                'image_url' => 'https://img.youtube.com/vi/8gC13CPoRhk/maxresdefault.jpg',
                'subtitle' => 'A deep dive into the platform features and best practices for talent and event organizers.',
                'content' => [
                    ['type' => 'p', 'text' => 'This recording covers everything you need to know to get started with the Hailerz Academy.'],
                    ['type' => 'video', 'url' => 'https://www.youtube.com/embed/8gC13CPoRhk'],
                ],
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Hailerz Platform Feature Highlight',
                'slug' => 'hailerz-feature-highlight',
                'category' => 'Video',
                'author' => 'Hailerz Team',
                'image_url' => 'https://img.youtube.com/vi/V_kCq027_1E/maxresdefault.jpg',
                'subtitle' => 'Quick tips and tricks to make the most out of your Hailerz profile.',
                'content' => [
                    ['type' => 'p', 'text' => 'Discover the powerful tools available at your fingertips.'],
                    ['type' => 'video', 'url' => 'https://www.youtube.com/embed/V_kCq027_1E'],
                ],
                'is_published' => true,
                'published_at' => now()->subDays(4),
            ],
        ];

        foreach ($videos as $videoData) {
            Post::updateOrCreate(['slug' => $videoData['slug']], $videoData);
        }
    }
}
