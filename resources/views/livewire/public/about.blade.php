<div class="bg-surface-muted min-h-screen">
  <!-- Hero Section -->
  <section class="relative h-[70vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img src="{{ asset('images/about-hero.webp') }}" alt="Venue crowd" class="w-full h-full object-cover brightness-64" />
      <div class="absolute inset-0 bg-linear-to-b from-surface-dark/70 via-surface-dark/20 to-surface-muted/20"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
      <x-heading level="h1" title="Making Every Event Unforgettable" align="center"
        class="text-text-inverse mb-6 text-5xl md:text-7xl" />
      <p class="text-xl md:text-2xl text-text-inverse/90 max-w-3xl mx-auto leading-relaxed font-light">
        We connect event planners with premium talent to create extraordinary experiences that audiences remember
        forever.
      </p>
    </div>
  </section>

  <!-- Our Story Section -->
  <section class="py-24 bg-surface-muted">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <x-heading level="h2" title="Our Story" align="center" class="mb-12" />
      <div class="space-y-8 text-lg text-text-secondary leading-relaxed font-light">
        <p>
          Hailerz exists for one reason — to make discovering and booking incredible talent effortless. Born from the
          real struggles event planners face when trying to find reliable, high-quality performers, Hailerz was created
          to bridge that gap with a platform built on trust, creativity, and community.
        </p>
        <p>
          Today, we proudly represent a growing network of over 100 talented creatives across multiple categories and
          genres. From intimate gatherings to large corporate events and festivals, we've helped bring unforgettable
          performances to life.
        </p>
        <p>
          Hailerz has become the go-to space for planners who value excellence. Every talent on our platform goes
          through a careful vetting process to ensure they deliver standout performances. And with our team handling the
          logistics, you're free to focus on what matters most — creating meaningful, memorable experiences.
        </p>
      </div>
    </div>
  </section>

  <!-- Our Values Section -->
  <section class="py-24 bg-surface-light border-y border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <x-heading level="h2" title="Our Values" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary">These core principles guide everything we do</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
        @php
          $values = [
            ['title' => 'Excellence', 'icon' => 'target', 'desc' => 'We curate only the finest talent and deliver exceptional service on every booking.'],
            ['title' => 'Passion', 'icon' => 'heart', 'desc' => 'We love what we do and it shows in our dedication to creating unforgettable events.'],
            ['title' => 'Partnership', 'icon' => 'users', 'desc' => 'We build lasting relationships with both clients and talent based on trust and respect.'],
            ['title' => 'Integrity', 'icon' => 'shield-check', 'desc' => 'We operate with transparency, honesty, and professionalism in every interaction.'],
          ];
        @endphp

        @foreach($values as $value)
          <div class="text-center group">
            <div
              class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-primary group-hover:scale-110 transition-all duration-300">
              @if($value['icon'] === 'target') <x-lucide-target
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($value['icon'] === 'heart') <x-lucide-heart
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($value['icon'] === 'users') <x-lucide-users
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @elseif($value['icon'] === 'shield-check') <x-lucide-shield-check
                class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
              @endif
            </div>
            <h3 class="text-xl font-bold mb-3 text-text-primary">{{ $value['title'] }}</h3>
            <p class="text-text-secondary text-sm leading-relaxed">{{ $value['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- What Sets Us Apart Section -->
  <section class="py-24 bg-surface-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <x-heading level="h2" title="What Sets Us Apart" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary">Why event planners choose Hailerz</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
        @php
          $features = [
            ['title' => 'Rigorous Vetting Process', 'desc' => 'Every artist undergoes a comprehensive evaluation including performance reviews, technical assessments, and professionalism checks before joining our roster.'],
            ['title' => 'Full-Service Support', 'desc' => 'From initial inquiry to post-event follow-up, our dedicated team handles contracts, logistics, technical requirements, and coordination.'],
            ['title' => 'Transparent Pricing', 'desc' => 'No hidden fees or surprises. You pay the artist directly - our service is completely free for clients.'],
            ['title' => 'Worldwide Network', 'desc' => 'Access top talent worldwide with our extensive network of performers in major cities and global markets.'],
            ['title' => 'Quick Response Time', 'desc' => 'Our team responds to inquiries within 24 hours with personalized recommendations tailored to your event.'],
            ['title' => 'Proven Track Record', 'desc' => 'Thousands of successful events and a 98% client satisfaction rate speak to our commitment to excellence.'],
          ];
        @endphp

        @foreach($features as $feature)
          <div
            class="bg-surface-light border border-subtle p-8 rounded-2xl flex gap-6 items-start hover:border-brand-primary transition-colors duration-300">
            <x-lucide-circle-check class="w-6 h-6 text-brand-primary shrink-0 mt-1" />
            <div>
              <h3 class="text-lg font-bold mb-2 text-text-primary">{{ $feature['title'] }}</h3>
              <p class="text-text-secondary text-sm leading-relaxed">{{ $feature['desc'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Meet Our Team Section -->
  <section class="py-24 bg-surface-light border-t border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <x-heading level="h2" title="Meet Our Team" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary">Passionate professionals dedicated to your success</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        @php
          $team = [
            [
              'name' => 'David Somoye',
              'role' => 'CFO',
              'desc' => '10+ years in event planning and entertainment booking',
              'image' => 'founder.jpeg'
            ],
            [
              'name' => 'Lolitasville',
              'role' => 'Talent Management',
              'desc' => 'Former broadcaster with deep industry connections',
              'image' => 'head-of-talent-relation.jpg'
            ],
            [
              'name' => 'Anne James',
              'role' => 'Community Manager',
              'desc' => 'Dedicated to ensuring every event exceeds expectations',
              'image' => 'client-success-director.jpeg'
            ],
          ];
        @endphp

        @foreach($team as $member)
          <div
            class="group relative overflow-hidden rounded-[2.5rem] aspect-3/4 bg-surface-dark border border-subtle shadow-xl">
            <img src="{{ asset('images/about/' . $member['image']) }}" alt="{{ $member['name'] }}"
              class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
            <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-10 left-10 right-10">
              <h3 class="text-3xl font-bold text-text-inverse mb-2">{{ $member['name'] }}</h3>
              <p class="text-brand-secondary text-xs font-bold uppercase tracking-widest mb-4">{{ $member['role'] }}</p>
              <p class="text-text-inverse/60 text-sm leading-relaxed">{{ $member['desc'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Ready to Work Together -->
  <section class="py-24 bg-surface-muted text-center border-t border-subtle">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-8">
        <x-lucide-music class="w-8 h-8 text-brand-primary" />
      </div>
      <x-heading level="h2" title="Ready to Work Together?" align="center" class="mb-6" />
      <p class="text-xl text-text-secondary mb-12 max-w-2xl mx-auto">
        Let's create an unforgettable event. Browse our talent directory or submit a booking inquiry today.
      </p>
      <div class="flex flex-col sm:flex-row gap-6 justify-center">
        <x-button variant="outline" size="lg" href="/talent" wire:navigate class="w-full sm:w-auto">
          Browse Talent
        </x-button>
        <x-button variant="primary" size="lg" href="/book" wire:navigate class="w-full sm:w-auto">
          Book Now
        </x-button>
      </div>
    </div>
  </section>
</div>