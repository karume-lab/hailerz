<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'When should I start the booking process?',
                'answer' => 'For the best availability, we recommend reaching out 3-6 months in advance, especially for high-profile talent and peak dates. However, we can often accommodate last-minute requests depending on the roster.',
                'sort_order' => 1,
            ],
            [
                'question' => 'What happens after I submit a request?',
                'answer' => 'Our agents will review your vision and provide a curated list of recommendations with pricing and availability within 24 hours. You\'ll have the opportunity to review media kits and profiles before securing your booking.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Are there hidden booking fees?',
                'answer' => 'Transparency is our priority. Our booking service is free for clients; you only pay the agreed performance fee for the talent you choose. We handle all logistics and contracts as part of our premium service.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Can I browse multiple categories?',
                'answer' => 'Of course. We encourage you to explore our entire directory to find the perfect combination of entertainment for your event.',
                'sort_order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
