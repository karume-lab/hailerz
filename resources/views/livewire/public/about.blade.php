<div class="bg-surface-muted min-h-screen">
  <!-- Hero Section -->
  <div class="relative bg-surface-dark min-h-[60vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
      <img src="{{ asset('images/about/about-hero.webp') }}" alt="Premium Event" loading="eager" width="1280"
        height="720" class="w-full h-full object-cover grayscale opacity-40">
      <div
        class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70">
      </div>
      <div class="absolute inset-0 bg-linear-to-t from-brand-primary via-brand-primary/40 to-transparent"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <x-heading level="h1" title="Making Every Event Unforgettable" emphasis="Event" class="text-text-inverse mb-8" />
      <p class="mt-4 max-w-3xl text-xl md:text-2xl text-text-muted mx-auto leading-relaxed font-light">
        We connect event planners with world-class talent to create extraordinary experiences that audiences remember
        forever.
      </p>
    </div>
  </div>

  <!-- Our Story Section -->
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32 reveal">
    <x-heading subtitle="Our Story" title="Making Talent Effortless" emphasis="Effortless" />
    <div class="space-y-10 text-xl text-text-secondary leading-relaxed font-light">
      <p>
        Hailerz exists for one reason — to make discovering and booking incredible talent effortless. Born from the real
        struggles event planners face when trying to find reliable, high‑quality performers, Hailerz was created to
        bridge that gap with a platform built on trust, creativity, and community.
      </p>
      <p>
        Today, we proudly represent a growing network of over 100 talented creatives across multiple categories and
        genres. From intimate gatherings to large corporate events and festivals, we've helped bring unforgettable
        performances to life.
      </p>
      <p>
        Hailerz has become the go‑to space for planners who value excellence. Every talent on our platform goes through
        a careful vetting process to ensure they deliver standout performances. And with our team handling the
        logistics, you're free to focus on what matters most — creating meaningful, memorable experiences.
      </p>
    </div>
  </div>

  <!-- Our Values -->
  <div class="bg-surface-light py-32 border-y border-subtle ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <x-heading align="center" subtitle="These core principles guide everything we do"
        title="Our Core Principles" emphasis="Core Principles" class="reveal" />

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
          $values = [
            ['title' => 'Quality', 'desc' => 'We curate only the finest talent and deliver exceptional service on every booking.'],
            ['title' => 'Passion', 'desc' => 'We love what we do and it shows in our dedication to creating unforgettable events.'],
            ['title' => 'Community', 'desc' => 'We build lasting relationships with both clients and talent based on trust and respect.'],
            ['title' => 'Integrity', 'desc' => 'We operate with transparency, honesty, and professionalism in every interaction.'],
          ];
        @endphp

        @foreach($values as $index => $value)
          <x-feature-card :index="$index" :title="$value['title']" :desc="$value['desc']"
            class="bg-surface-muted group hover:bg-brand-primary transition-all duration-300" />
        @endforeach
      </div>
    </div>
  </div>

  <!-- Why Choose Us -->
  <div class="bg-surface-muted py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <x-heading align="center" subtitle="We handle the logistics so you can focus on the experience."
        title="Why Planners Choose Hailerz" emphasis="Choose Hailerz" class="reveal" />

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        @php
          $reasons = [
            ['title' => 'Rigorous Vetting', 'desc' => 'Every artist undergoes a comprehensive evaluation including performance reviews and technical assessments.'],
            ['title' => 'End-to-End Support', 'desc' => 'Our dedicated team handles contracts, logistics, technical requirements, and coordination.'],
            ['title' => 'No Booking Fees', 'desc' => 'No hidden fees or surprises. You pay the artist directly - our service is free for clients.'],
            ['title' => 'Nationwide Reach', 'desc' => 'Access top talent across the country with our extensive network of performers in major cities.'],
            ['title' => 'Rapid Response', 'desc' => 'Our team responds to inquiries within 24 hours with personalized recommendations.'],
            ['title' => 'Proven Results', 'desc' => 'Thousands of successful events and a 98% client satisfaction rate speak to our commitment.'],
          ];
        @endphp

        @foreach($reasons as $index => $reason)
          <div
            class="flex gap-6 reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
            <div
              class="shrink-0 h-12 w-12 rounded-2xl bg-brand-primary/10 flex items-center justify-center text-brand-primary">
              <x-lucide-check class="w-6 h-6" stroke-width="2" />
            </div>
            <div>
              <h3 class="text-xl font-bold text-text-primary mb-2">{{ $reason['title'] }}</h3>
              <p class="text-text-secondary leading-relaxed font-light">{{ $reason['desc'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Team Section -->
  <div class="bg-surface-light py-32 border-t border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <x-heading align="center" subtitle="Passionate professionals dedicated to your success"
        title="Our Specialists" emphasis="Specialists" class="reveal" />

      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        @php
          $team = [
            ['name' => 'David Somoye', 'role' => 'Founder / Senior Agent', 'img' => 'founder.webp', 'bio' => '10+ years in premium talent booking.'],
            ['name' => 'Lolitasville', 'role' => 'Director of Talent', 'img' => 'head-of-talent-relation.webp', 'bio' => 'Expert in industry relations and artist vetting.'],
            ['name' => 'Anne James', 'role' => 'Client Success', 'img' => 'client-success-director.webp', 'bio' => 'Specialist in on-site coordination and logistics.'],
          ];
        @endphp

        @foreach($team as $index => $member)
          <div
            class="group relative overflow-hidden rounded-[2.5rem] aspect-3/4 bg-surface-dark border border-subtle shadow-xl reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
            <img src="{{ asset('images/about/' . $member['img']) }}" loading="lazy" width="400" height="533"
              class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110"
              alt="{{ $member['name'] }}" />
            <div
              class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70">
            </div>
            <div class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-brand-primary/20 to-transparent"></div>
            <div class="absolute bottom-10 left-10 right-10">
              <h3 class="text-3xl font-bold text-text-inverse mb-2 ">{{ $member['name'] }}</h3>
              <p class="text-brand-secondary text-xs font-bold uppercase tracking-widest mb-4">{{ $member['role'] }}</p>
              <p
                class="text-text-inverse/60 text-sm leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                {{ $member['bio'] }}
              </p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Bottom CTA -->
  <div class="relative py-40 overflow-hidden bg-brand-primary">
    <div class="absolute inset-0 opacity-20 bg-cover bg-center grayscale"
      style="background-image: url('{{ asset('images/about/about-hero.webp') }}')">
    </div>
    <div
      class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-40">
    </div>

    <div class="relative max-w-4xl mx-auto px-4 text-center reveal">
      <x-heading level="h2" title="Ready to book top talent for your next event?" emphasis="book top talent" class="text-text-inverse mb-8" />
      <p class="text-xl md:text-2xl text-text-muted mb-12 font-light leading-relaxed">
        Let us help you find the perfect performer for your next event. Browse our roster or submit a booking inquiry
        today.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-6">
        <x-button variant="outline" size="lg" href="/talent" wire:navigate>
          Find Talent
        </x-button>
        <x-button variant="accent" size="lg" href="/book" wire:navigate>
          Book Now
        </x-button>
      </div>
    </div>
  </div>
</div>