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
      <div class="text-center max-w-3xl mx-auto mb-24">
        <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">Entertainment <span class="text-brand-secondary">Categories</span></h2>
        <p class="text-text-secondary text-lg">World-class performers across every category and genre</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @php
          $categories = [
            [
              'name' => 'Solo Musicians',
              'desc' => 'Solo instrumentalists and vocalists across all genres - from classical pianists to contemporary guitarists.',
              'popular' => 'Weddings, Corporate Dinners, Private Parties',
              'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z'
            ],
            [
              'name' => 'Bands & Ensembles',
              'desc' => 'Full ensembles and variety acts that bring energy and diversity to any event, from acoustic trios to full performance groups.',
              'popular' => 'Weddings, Festivals, Corporate Events',
              'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857'
            ],
            [
              'name' => 'DJs',
              'desc' => 'Professional DJs who read the room and keep the energy high with expertly curated playlists and mixing.',
              'popular' => 'Clubs, Parties, Weddings, Corporate Events',
              'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z'
            ],
            [
              'name' => 'Keynote Speakers',
              'desc' => 'Motivational speakers and industry experts who inspire and educate audiences.',
              'popular' => 'Conferences, Corporate Events, Fundraisers',
              'icon' => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z'
            ],
            [
              'name' => 'Dancers & Performers',
              'desc' => 'Professional dancers and choreographers specializing in contemporary, traditional, and Afrobeat performances.',
              'popular' => 'Weddings, Cultural Events, Corporate Shows',
              'icon' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
            ],
            [
              'name' => 'Visual Artists',
              'desc' => 'Live painters and visual artists who create stunning artwork during your event as entertainment.',
              'popular' => 'Corporate Events, Exhibitions, Private Parties',
              'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'
            ],
          ];
        @endphp

        @foreach($categories as $cat)
          <div class="bg-surface-light p-10 rounded-[2.5rem] border border-subtle shadow-sm hover:shadow-2xl transition-all duration-500 group">
            <div class="w-16 h-16 bg-brand-primary/10 rounded-2xl flex items-center justify-center text-brand-primary mb-8 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">{{ $cat['name'] }}</h3>
            <p class="text-text-secondary mb-6 leading-relaxed">{{ $cat['desc'] }}</p>
            <p class="text-xs font-bold text-brand-primary uppercase tracking-widest">Most Popular for:</p>
            <p class="text-sm text-text-muted italic">{{ $cat['popular'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Occasions -->
  <section class="py-32 bg-surface-light border-y border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-20">
        <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">Specialized for <span class="text-brand-secondary">Every Occasion</span></h2>
        <p class="text-lg text-text-secondary">We provide the perfect talent to match your event's atmosphere.</p>
      </div>

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

        @foreach($occasions as $occ)
          <div class="bg-surface-muted p-8 rounded-3xl border border-subtle hover:border-brand-primary transition-colors">
            <h3 class="text-xl font-bold text-text-primary mb-4">{{ $occ['title'] }}</h3>
            <p class="text-text-secondary leading-relaxed font-light">{{ $occ['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Process -->
  <section class="py-32 bg-surface-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-24">
        <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">The <span class="text-brand-secondary">Booking</span> Process</h2>
        <p class="text-text-secondary text-lg">A simple, three-step process to secure world-class talent.</p>

        <div class="mt-12 aspect-video max-w-4xl mx-auto rounded-[2.5rem] overflow-hidden shadow-2xl border border-subtle bg-surface-dark">
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
          <div class="relative text-center">
            <div class="w-16 h-16 bg-brand-primary text-text-inverse rounded-full flex items-center justify-center mx-auto mb-8 text-2xl font-bold shadow-lg">
              {{ $index + 1 }}
            </div>
            <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">{{ $step[0] }}</h3>
            <p class="text-text-secondary leading-relaxed font-light">{{ $step[1] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Final CTA -->
  <section class="py-32 bg-brand-primary text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 relative z-10">
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
