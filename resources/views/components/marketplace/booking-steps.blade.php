<section class="py-32 bg-surface-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-heading level="h2" title="Book Talent in" highlight="Three Simple Steps" align="center"
            class="text-text-primary mb-10" />
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @php
                $steps = [
                    [
                        'title' => 'Search',
                        'desc' => 'Search our curated directory of top talent by category, genre, or location to find the perfect fit.',
                        'icon' => 'search'
                    ],
                    [
                        'title' => 'Review',
                        'desc' => 'View detailed profiles with photos, videos, and reviews to find your perfect match with confidence.',
                        'icon' => 'user-check'
                    ],
                    [
                        'title' => 'Book',
                        'desc' => 'Submit an inquiry directly from their profile and finalize your booking with our dedicated agents.',
                        'icon' => 'calendar-check'
                    ]
                ];
            @endphp

            @foreach($steps as $index => $step)
                <x-feature-card :index="$index" :icon="$step['icon']" :title="$step['title']" :desc="$step['desc']"
                    iconVariant="secondary" />
            @endforeach
        </div>
    </div>
</section>
