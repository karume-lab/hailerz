<div class="bg-surface-muted min-h-screen">
  <!-- Hero Section -->
  <section class="relative bg-surface-dark py-24 lg:py-32 border-b border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
      <x-heading level="h1" title="Our Services" emphasis="Services" align="center" class="text-text-inverse mb-6" />
      <p class="text-xl text-text-inverse/80 max-w-3xl mx-auto leading-relaxed font-light">
        Comprehensive talent booking and event entertainment solutions tailored to your needs
      </p>
    </div>
  </section>

  <!-- Talent Categories Section -->
  <section class="py-24 bg-surface-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <x-heading level="h2" title="Talent Categories" emphasis="Categories" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary max-w-2xl mx-auto">Premium performers across every category and genre</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
        @php
          $categories = [
            [
              'name' => 'Musicians',
              'slug' => 'musicians',
              'icon' => 'music',
              'desc' => 'Solo instrumentalists and vocalists across all genres - from classical pianists to contemporary guitarists.',
              'genres' => ['Jazz', 'Classical', 'Pop', 'Rock', 'Country', 'R&B'],
              'popular' => 'Weddings, Corporate Dinners, Private Parties'
            ],
            [
              'name' => 'Variety Artists',
              'slug' => 'variety-artists',
              'icon' => 'users',
              'desc' => 'Full ensembles and variety acts that bring energy and diversity to any event, from acoustic trios to full performance groups.',
              'genres' => ['Rock', 'Jazz', 'Cover Bands', 'Indie', 'Blues', 'Folk'],
              'popular' => 'Weddings, Festivals, Corporate Events'
            ],
            [
              'name' => 'DJs',
              'slug' => 'djs',
              'icon' => 'disc',
              'desc' => 'Professional DJs who read the room and keep the energy high with expertly curated playlists and mixing.',
              'genres' => ['EDM', 'Hip Hop', 'House', 'Top 40', 'Latin', 'Throwback'],
              'popular' => 'Clubs, Parties, Weddings, Corporate Events'
            ],
            [
              'name' => 'Speakers',
              'slug' => 'speakers',
              'icon' => 'mic',
              'desc' => 'Keynote speakers, motivational speakers, and industry experts who inspire and educate audiences.',
              'genres' => ['Business', 'Tech', 'Motivation', 'Entertainment', 'Education'],
              'popular' => 'Conferences, Corporate Events, Fundraisers'
            ],
            [
              'name' => 'Dancers',
              'slug' => 'dancers',
              'icon' => 'sparkles',
              'desc' => 'Professional dancers and choreographers specializing in contemporary, traditional, and Afrobeat performances.',
              'genres' => ['Contemporary', 'Afrobeat', 'Traditional', 'Hip Hop', 'Ballet'],
              'popular' => 'Weddings, Cultural Events, Corporate Shows'
            ],
            [
              'name' => 'Artists',
              'slug' => 'artists',
              'icon' => 'palette',
              'desc' => 'Live painters and visual artists who create stunning artwork during your event as entertainment.',
              'genres' => ['Live Painting', 'Portrait Art', 'Abstract', 'Graffiti', 'Digital Art'],
              'popular' => 'Corporate Events, Exhibitions, Private Parties'
            ],
            [
              'name' => 'Poets',
              'slug' => 'poets',
              'icon' => 'book-open',
              'desc' => 'Spoken word artists and poets who captivate audiences with powerful performances and storytelling.',
              'genres' => ['Spoken Word', 'Poetry', 'Storytelling', 'Slam Poetry'],
              'popular' => 'Cultural Events, Conferences, Intimate Gatherings'
            ],
            [
              'name' => 'Content Creators',
              'slug' => 'content-creators',
              'icon' => 'video',
              'desc' => 'Social media influencers and content creators who bring modern digital engagement to your brand.',
              'genres' => ['Social Media', 'Lifestyle', 'Fashion', 'Tech', 'Food'],
              'popular' => 'Brand Launches, Product Events, Marketing Campaigns'
            ],
            [
              'name' => 'Comedians',
              'slug' => 'comedians',
              'icon' => 'laugh',
              'desc' => 'Stand-up comedians and comedy performers who bring laughter and entertainment to any occasion.',
              'genres' => ['Stand-up', 'Improv', 'Sketch Comedy', 'Clean Comedy', 'Roast'],
              'popular' => 'Corporate Events, Private Parties, Fundraisers'
            ],
            [
              'name' => 'MCs',
              'slug' => 'mcs',
              'icon' => 'megaphone',
              'desc' => 'Professional event hosts and masters of ceremony who keep your event flowing smoothly and engaging.',
              'genres' => ['Event Hosting', 'Emcee', 'Announcer', 'Moderator'],
              'popular' => 'Weddings, Conferences, Award Ceremonies, Galas'
            ]
          ];
        @endphp

        @foreach($categories as $cat)
          <a href="/talent?category={{ $cat['slug'] }}" wire:navigate
            class="group rounded-3xl border border-subtle bg-surface-light p-8 shadow-sm flex flex-col h-full hover:border-brand-primary hover:shadow-lg transition-all duration-300">
            <div
              class="w-16 h-16 bg-brand-primary/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-brand-primary group-hover:text-text-inverse transition-colors duration-300">
              @if($cat['icon'] === 'music') <x-lucide-music
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'users') <x-lucide-users
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'disc') <x-lucide-disc
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'mic') <x-lucide-mic
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'sparkles') <x-lucide-sparkles
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'palette') <x-lucide-palette
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'book-open') <x-lucide-book-open
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'video') <x-lucide-video
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'laugh') <x-lucide-laugh
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($cat['icon'] === 'megaphone') <x-lucide-megaphone
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @endif
            </div>
            <h3 class="text-2xl font-bold mb-3 text-text-primary group-hover:text-brand-primary transition-colors">
              {{ $cat['name'] }}
            </h3>
            <p class="text-text-secondary text-sm leading-relaxed mb-6 grow">{{ $cat['desc'] }}</p>

            <div class="mb-6">
              <h4 class="text-xs font-bold text-text-primary uppercase tracking-widest mb-3">Popular Genres:</h4>
              <div class="flex flex-wrap gap-2">
                @foreach($cat['genres'] as $genre)
                  <span
                    class="px-3 py-1 bg-surface-muted text-text-secondary text-[10px] font-bold rounded-full border border-subtle">
                    {{ $genre }}
                  </span>
                @endforeach
              </div>
            </div>

            <div class="pt-6 border-t border-subtle">
              <p class="text-xs text-text-muted italic">Most Popular for: {{ $cat['popular'] }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Events We Serve -->
  <section class="py-24 bg-surface-muted/30 border-y border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <x-heading level="h2" title="Events We Serve" emphasis="Serve" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary">Specialized talent for every occasion</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @php
          $events = [
            ['title' => 'Weddings', 'desc' => 'Create magical moments with ceremony musicians, reception bands, and DJs who understand your vision.'],
            ['title' => 'Corporate Events', 'desc' => 'Professional entertainment for galas, conferences, product launches, and team building events.'],
            ['title' => 'Private Parties', 'desc' => 'Elevate birthdays, anniversaries, and celebrations with the perfect musical backdrop.'],
            ['title' => 'Festivals', 'desc' => 'Headline acts and supporting performers for music festivals and outdoor events.'],
            ['title' => 'Fundraisers & Galas', 'desc' => 'Sophisticated entertainment that enhances your fundraising efforts and donor experience.'],
            ['title' => 'Conferences', 'desc' => 'Keynote speakers and entertainment that engage and inspire attendees.'],
          ];
        @endphp

        @foreach($events as $event)
          <div
            class="rounded-2xl border border-subtle bg-surface-light p-8 hover:border-brand-primary transition-colors duration-300">
            <h3 class="text-xl font-bold mb-3 text-text-primary">{{ $event['title'] }}</h3>
            <p class="text-text-secondary text-sm leading-relaxed">{{ $event['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Full-Service Support -->
  <section class="py-24 bg-surface-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <x-heading level="h2" title="Full-Service Support" emphasis="Support" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary max-w-2xl mx-auto">We handle everything so you can focus on your event</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 max-w-6xl mx-auto">
        @php
          $supports = [
            ['title' => 'Booking Coordination', 'icon' => 'calendar', 'desc' => 'We manage all communication, scheduling, and logistics between you and the talent.'],
            ['title' => 'Contract Management', 'icon' => 'file-text', 'desc' => 'Professional contracts that protect both parties with clear terms and expectations.'],
            ['title' => 'Technical Support', 'icon' => 'headphones', 'desc' => 'Guidance on sound systems, staging, and technical requirements for optimal performance.'],
            ['title' => 'Insurance & Liability', 'icon' => 'shield', 'desc' => 'All our talent carries professional liability insurance for your peace of mind.'],
            ['title' => 'Day-of Coordination', 'icon' => 'users', 'desc' => 'On-site support available to ensure smooth setup and performance execution.'],
            ['title' => 'Quality Assurance', 'icon' => 'circle-check', 'desc' => 'Post-event follow-up to ensure satisfaction and gather feedback.'],
          ];
        @endphp

        @foreach($supports as $s)
          <div class="text-center">
            <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
              @if($s['icon'] === 'calendar') <x-lucide-calendar class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'file-text') <x-lucide-file-text class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'headphones') <x-lucide-headphones class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'shield') <x-lucide-shield class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'users') <x-lucide-users class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'circle-check') <x-lucide-circle-check class="w-8 h-8 text-brand-primary" />
              @endif
            </div>
            <h3 class="text-xl font-bold mb-3 text-text-primary">{{ $s['title'] }}</h3>
            <p class="text-text-secondary text-sm leading-relaxed">{{ $s['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section class="py-24 bg-surface-muted/30 border-y border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <x-heading level="h2" title="How It Works" emphasis="Works" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary">Simple, transparent process from inquiry to performance</p>
      </div>

      <div class="max-w-4xl mx-auto space-y-12">
        @php
          $steps = [
            ['title' => 'Submit Your Request', 'desc' => 'Tell us about your event - date, location, type, budget, and preferences. Browse our directory or let us recommend talent.'],
            ['title' => 'Review Recommendations', 'desc' => 'Within 24 hours, receive personalized talent recommendations with profiles, videos, reviews, and availability.'],
            ['title' => 'Book Your Talent', 'desc' => 'Choose your performer and we\'ll handle contracts, deposits, and all coordination details.'],
            ['title' => 'Event Preparation', 'desc' => 'We coordinate technical requirements, timing, and special requests leading up to your event.'],
            ['title' => 'Showtime', 'desc' => 'Your talent arrives prepared and delivers an exceptional performance. Optional on-site support available.'],
            ['title' => 'Follow-Up', 'desc' => 'We check in post-event to ensure everything exceeded expectations and gather feedback.'],
          ];
        @endphp

        @foreach($steps as $index => $step)
          <div class="flex gap-8">
            <div class="shrink-0">
              <div
                class="w-16 h-16 bg-brand-primary rounded-full flex items-center justify-center text-2xl font-bold text-text-inverse">
                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
              </div>
            </div>
            <div class="pt-2">
              <h3 class="text-2xl font-bold mb-2 text-text-primary">{{ $step['title'] }}</h3>
              <p class="text-text-secondary text-lg leading-relaxed">{{ $step['desc'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Transparent Pricing -->
  <section class="py-24 bg-surface-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">
        <x-heading level="h2" title="Transparent Pricing" emphasis="Pricing" align="center" class="mb-12" />

        <div class="rounded-3xl border border-subtle bg-surface-light p-8 md:p-12 shadow-sm mb-12">
          <div class="space-y-10">
            <div class="flex items-start gap-6">
              <x-lucide-circle-check class="h-8 w-8 text-brand-primary shrink-0 mt-1" />
              <div>
                <h3 class="text-xl font-bold mb-2 text-text-primary">No Booking Fees for Clients</h3>
                <p class="text-text-secondary leading-relaxed">Our service is completely free for event planners. You
                  pay the talent directly for their performance - no hidden fees or commissions added.</p>
              </div>
            </div>
            <div class="flex items-start gap-6">
              <x-lucide-circle-check class="h-8 w-8 text-brand-primary shrink-0 mt-1" />
              <div>
                <h3 class="text-xl font-bold mb-2 text-text-primary">Clear Pricing Information</h3>
                <p class="text-text-secondary leading-relaxed">Every talent profile includes transparent pricing ranges.
                  Final rates are negotiable based on event details, duration, and travel requirements.</p>
              </div>
            </div>
            <div class="flex items-start gap-6">
              <x-lucide-circle-check class="h-8 w-8 text-brand-primary shrink-0 mt-1" />
              <div>
                <h3 class="text-xl font-bold mb-2 text-text-primary">Flexible Payment Terms</h3>
                <p class="text-text-secondary leading-relaxed">Standard terms include a deposit to secure the booking
                  with the balance due before or after the event, depending on the agreement.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-surface-muted rounded-3xl p-8 md:p-12 text-center">
          <p class="text-text-muted text-sm font-bold uppercase tracking-widest mb-8">Typical pricing ranges by
            category:</p>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
              <div class="font-bold text-xl text-text-primary mb-1">₦30k - ₦80k</div>
              <div class="text-sm text-text-secondary">Solo Musicians</div>
            </div>
            <div>
              <div class="font-bold text-xl text-text-primary mb-1">₦50k - ₦120k</div>
              <div class="text-sm text-text-secondary">DJs</div>
            </div>
            <div>
              <div class="font-bold text-xl text-text-primary mb-1">₦80k - ₦230k</div>
              <div class="text-sm text-text-secondary">Variety Artists</div>
            </div>
            <div>
              <div class="font-bold text-xl text-text-primary mb-1">₦150k - ₦750k+</div>
              <div class="text-sm text-text-secondary">Speakers</div>
            </div>
          </div>
          <p class="mt-8 text-xs text-text-muted italic">* Prices are estimates and vary based on event specifics.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Ready to Get Started -->
  <section class="py-24 bg-brand-accent border-t border-subtle">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <x-heading level="h2" title="Ready to Get Started?" emphasis="Started?" align="center" class="text-text-inverse mb-6" />
      <p class="text-xl text-text-inverse/80 mb-12">Let's find the perfect talent for your event. Browse our directory
        or submit a booking inquiry today.</p>
      <div class="flex flex-col sm:flex-row gap-6 justify-center">
        <x-button variant="outline" size="lg" href="/book" wire:navigate>
          Submit Booking Request
        </x-button>
        <x-button variant="primary" size="lg" href="/talent" wire:navigate>
          Browse Talent Directory
        </x-button>
      </div>
    </div>
  </section>
</div>