<div class="bg-surface-muted min-h-screen">
  <!-- Hero Section -->
  <section class="relative bg-surface-dark py-32 lg:py-48 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
      <div class="flex items-center justify-center gap-3 mb-8">
        <span class="h-px w-12 bg-brand-primary"></span>
        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Our Services</span>
        <span class="h-px w-12 bg-brand-primary"></span>
      </div>
      <h1 class="text-5xl md:text-8xl font-bold text-text-inverse tracking-tight mb-8 font-serif leading-tight">World-Class <span class="text-brand-secondary">Performers</span> for Every Event</h1>
      <p class="text-xl md:text-2xl text-text-muted max-w-3xl mx-auto leading-relaxed font-light">
        Comprehensive talent booking and event entertainment solutions tailored to your needs. We handle everything so you can focus on your event.
      </p>
    </div>
    
    <!-- Abstract design elements -->
    <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-brand-primary/10 rounded-full blur-[150px] opacity-20"></div>
  </section>

  <!-- Talent Categories -->
  <section class="py-32 bg-surface-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <x-section-heading 
        align="center" 
        title='Entertainment <span class="text-brand-secondary">Categories</span>' 
        subtitle="World-class performers across every category and genre"
        class="reveal"
      />

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @php
          $categories = [
            [
              'name' => 'Solo Musicians',
              'desc' => 'Solo instrumentalists and vocalists across all genres - from classical pianists to contemporary guitarists.',
              'popular' => 'Weddings, Corporate Dinners, Private Parties',
              'icon' => 'music'
            ],
            [
              'name' => 'Bands & Ensembles',
              'desc' => 'Full ensembles and variety acts that bring energy and diversity to any event, from acoustic trios to full performance groups.',
              'popular' => 'Weddings, Festivals, Corporate Events',
              'icon' => 'users'
            ],
            [
              'name' => 'DJs',
              'desc' => 'Professional DJs who read the room and keep the energy high with expertly curated playlists and mixing.',
              'popular' => 'Clubs, Parties, Weddings, Corporate Events',
              'icon' => 'disc'
            ],
            [
              'name' => 'Keynote Speakers',
              'desc' => 'Motivational speakers and industry experts who inspire and educate audiences.',
              'popular' => 'Conferences, Corporate Events, Fundraisers',
              'icon' => 'mic'
            ],
            [
              'name' => 'Dancers & Performers',
              'desc' => 'Professional dancers and choreographers specializing in contemporary, traditional, and Afrobeat performances.',
              'popular' => 'Weddings, Cultural Events, Corporate Shows',
              'icon' => 'smile'
            ],
            [
              'name' => 'Visual Artists',
              'desc' => 'Live painters and visual artists who create stunning artwork during your event as entertainment.',
              'popular' => 'Corporate Events, Exhibitions, Private Parties',
              'icon' => 'palette'
            ],
          ];
        @endphp

        @foreach($categories as $index => $cat)
          <x-card class="reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
            <div class="w-16 h-16 bg-brand-primary/10 rounded-2xl flex items-center justify-center text-brand-primary mb-8 group-hover:scale-110 transition-transform">
              <x-dynamic-component :component="'lucide-' . $cat['icon']" class="w-8 h-8" stroke-width="2" />
            </div>
            <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">{{ $cat['name'] }}</h3>
            <p class="text-text-secondary mb-6 leading-relaxed">{{ $cat['desc'] }}</p>
            <p class="text-xs font-bold text-brand-primary uppercase tracking-widest">Most Popular for:</p>
            <p class="text-sm text-text-muted italic">{{ $cat['popular'] }}</p>
          </x-card>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Occasions -->
  <section class="py-32 bg-surface-light border-y border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <x-section-heading 
        align="center" 
        title='Specialized for <span class="text-brand-secondary">Every Occasion</span>' 
        subtitle="We provide the perfect talent to match your event's atmosphere."
        class="reveal"
      />

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
          $occasions = [
            ['title' => 'Weddings', 'desc' => 'Create magical moments with ceremony musicians, reception bands, and DJs who understand your vision.'],
            ['title' => 'Corporate Events', 'desc' => 'Professional entertainment for galas, conferences, product launches, and team building events.'],
            ['title' => 'Private Parties', 'desc' => 'Elevate birthdays, anniversaries, and celebrations with the perfect musical backdrop.'],
            ['title' => 'Festivals', 'desc' => 'Headline acts and supporting performers for music festivals and outdoor events.'],
            ['title' => 'Fundraisers', 'desc' => 'Sophisticated entertainment that enhances your fundraising efforts and donor experience.'],
            ['title' => 'Conferences', 'desc' => 'Keynote speakers and entertainment that engage and inspire attendees.'],
          ];
        @endphp

        @foreach($occasions as $index => $occ)
          <x-card padding="p-8" class="bg-surface-muted hover:border-brand-primary reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
            <h3 class="text-xl font-bold text-text-primary mb-4">{{ $occ['title'] }}</h3>
            <p class="text-text-secondary leading-relaxed font-light">{{ $occ['desc'] }}</p>
          </x-card>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Process -->
  <section class="py-32 bg-surface-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <x-section-heading 
        align="center" 
        title='The <span class="text-brand-secondary">Booking</span> Process' 
        subtitle="A simple, three-step process to secure world-class talent."
        class="reveal"
      />

      <div class="mt-12 aspect-video max-w-4xl mx-auto rounded-[2.5rem] overflow-hidden shadow-2xl border border-subtle bg-surface-dark reveal reveal-delay-200">
            <iframe 
                class="w-full h-full"
                src="https://www.youtube.com/embed/LLdr6BqljEw" 
                title="Hailerz - How it Works" 
                frameborder="0" 
                loading="lazy"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                referrerpolicy="strict-origin-when-cross-origin" 
                allowfullscreen>
            </iframe>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
        @php
          $steps = [
            ['Search', 'Search our curated directory of top talent by category, genre, or location to find the perfect fit.'],
            ['Review', 'View detailed profiles with photos, videos, and reviews to find your perfect match with confidence.'],
            ['Book', 'Submit an inquiry directly from their profile and finalize your booking with our dedicated agents.'],
          ];
        @endphp

        @foreach($steps as $index => $step)
          <div class="relative text-center reveal {{ $index === 1 ? 'reveal-delay-100' : ($index === 2 ? 'reveal-delay-200' : '') }}">
            <div class="w-16 h-16 bg-brand-primary text-text-inverse rounded-full flex items-center justify-center mx-auto mb-8 text-2xl font-bold shadow-lg">
              {{ $index + 1 }}
            </div>
            <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">{{ $step[0] }}</h3>
            <p class="text-text-secondary leading-relaxed font-light">{{ $step[1] }}</p>
          </div>
        @endforeach
      </div>
    </section>

  <!-- Final CTA -->
  <section class="py-32 bg-brand-primary text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 relative z-10 reveal">
      <h2 class="text-3xl md:text-6xl font-bold text-text-inverse mb-8 font-serif leading-tight">Ready to Find Your <span class="text-brand-secondary">Perfect Match?</span></h2>
      <p class="text-xl text-text-inverse/80 mb-12 max-w-2xl mx-auto font-light leading-relaxed">
        Let us help you find the perfect performer for your next event. Browse our roster or submit a booking inquiry today.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-6">
        <x-button variant="secondary" size="lg" href="/talent" wire:navigate>
          Browse Talent
        </x-button>
        <x-button variant="primary" size="lg" href="/book" wire:navigate>
          Book Now
        </x-button>
      </div>
    </div>
    <div class="absolute top-0 right-0 w-1/3 h-full bg-linear-to-l from-text-inverse/5 to-transparent"></div>
  </section>
</div>
