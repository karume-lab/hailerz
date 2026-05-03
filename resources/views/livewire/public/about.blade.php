<div class="bg-surface-muted min-h-screen">
  <!-- Hero Section -->
  <div class="relative bg-surface-dark min-h-[70vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
      <img src="{{ asset('images/about/about-hero.webp') }}" alt="Premium Event" loading="eager" width="1280"
        height="720" class="w-full h-full object-cover grayscale opacity-40">
      <div
        class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70">
      </div>
      <div class="absolute inset-0 bg-linear-to-t from-brand-primary via-brand-primary/40 to-transparent"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <div class="flex items-center justify-center gap-3 mb-8">
        <span class="h-px w-12 bg-brand-primary"></span>
        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">About the Agency</span>
        <span class="h-px w-12 bg-brand-primary"></span>
      </div>
       <h1 class="text-5xl md:text-8xl font-bold text-text-inverse tracking-tight mb-8 font-serif leading-tight">
        We Curate the <span class="text-brand-secondary">Artists</span> Who Define Your Event.
      </h1>
      <p class="mt-4 max-w-3xl text-xl md:text-2xl text-text-muted mx-auto leading-relaxed font-light">
        Hailerz is a premier entertainment agency dedicated to bridging the gap between top-tier talent and high-profile events. We deliver excellence, every time.
      </p>
    </div>
  </div>

  <!-- Our Story Section -->
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
    <div class="flex items-center gap-3 mb-6">
      <span class="h-px w-8 bg-brand-primary"></span>
      <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Our Legacy</span>
    </div>
    <h2 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight mb-12 font-serif">Our <span class="text-brand-secondary">Vision</span></h2>
    <div class="space-y-10 text-xl text-text-secondary leading-relaxed font-light">
      <p>
        Hailerz was born from a commitment to excellence in the entertainment industry. We believe that booking top-tier talent should be a seamless, premium experience for every client.
      </p>
      <p>
        Our curated roster features the world’s most sought-after musicians, speakers, and performers. We don’t just book talent; we curate memories, ensuring each act perfectly aligns with the tone and luxury of your event.
      </p>
      <p>
        From vetting to execution, we handle every detail with precision. Our reputation is built on reliability, professionalism, and an unwavering focus on quality.
      </p>
    </div>
  </div>

  <!-- Our Values -->
  <div class="bg-surface-light py-32 border-y border-subtle ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-20">
        <h2 class="text-3xl md:text-5xl font-bold text-text-primary tracking-tight mb-6 font-serif">Our <span class="text-brand-secondary">Core Standards</span></h2>
        <p class="text-lg text-text-secondary">We operate at the intersection of luxury, talent, and professional execution.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
          $values = [
            ['title' => 'Curation', 'desc' => 'We only represent artists who meet our rigorous standards for performance, professionalism, and stage presence.'],
            ['title' => 'Discretion', 'desc' => 'Operating with the utmost confidentiality for our high-profile clients and exclusive events.'],
            ['title' => 'Excellence', 'desc' => 'Our team is dedicated to providing a white-glove service that exceeds expectations from first inquiry to final applause.'],
            ['title' => 'Transparency', 'desc' => 'Clear communication, secure contracts, and professional negotiations are the foundation of our agency.'],
          ];
        @endphp

        @foreach($values as $value)
          <div
            class="bg-surface-muted p-10 rounded-3xl border border-subtle group hover:bg-brand-primary transition-all duration-500 hover:shadow-2xl">
            <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif group-hover:text-text-inverse transition-colors">
              {{ $value['title'] }}</h3>
            <p class="text-text-secondary leading-relaxed font-light group-hover:text-text-inverse/70 transition-colors">
              {{ $value['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Team Section -->
  <div class="bg-surface-muted py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-20">
        <h2 class="text-3xl md:text-5xl font-bold text-text-primary tracking-tight mb-6 font-serif">The <span class="text-brand-secondary">Specialists</span></h2>
        <p class="text-lg text-text-secondary">Meet the dedicated agents who bring your vision to life with expertise and passion.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        @php
          $team = [
            ['name' => 'David Somoye', 'role' => 'Founder / Senior Agent', 'img' => 'founder.webp', 'bio' => '10+ years in premium talent procurement.'],
            ['name' => 'Lolitasville', 'role' => 'Director of Talent', 'img' => 'head-of-talent-relation.webp', 'bio' => 'Expert in industry relations and artist vetting.'],
            ['name' => 'Anne James', 'role' => 'Client Success', 'img' => 'client-success-director.webp', 'bio' => 'Specialist in on-site coordination and logistics.'],
          ];
        @endphp

        @foreach($team as $member)
          <div
            class="group relative overflow-hidden rounded-[2.5rem] aspect-3/4 bg-surface-dark border border-subtle shadow-xl">
            <img src="{{ asset('images/about/' . $member['img']) }}" loading="lazy" width="400" height="533"
              class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110"
              alt="{{ $member['name'] }}" />
            <div
              class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70">
            </div>
            <div class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-brand-primary/20 to-transparent"></div>
            <div class="absolute bottom-10 left-10 right-10">
              <h3 class="text-3xl font-bold text-text-inverse mb-2 font-serif">{{ $member['name'] }}</h3>
              <p class="text-brand-secondary text-xs font-bold uppercase tracking-widest mb-4">{{ $member['role'] }}</p>
              <p
                class="text-text-inverse/60 text-sm leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                {{ $member['bio'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Bottom CTA -->
  <div class="relative py-40 overflow-hidden bg-brand-primary">
    <div
      class="absolute inset-0 opacity-20 bg-cover bg-center grayscale" style="background-image: url('{{ asset('images/about/about-hero.webp') }}')">
    </div>
    <div
      class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-40">
    </div>

    <div class="relative max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-4xl md:text-7xl font-bold text-text-inverse mb-8 tracking-tight font-serif">Let’s Create Something Unforgettable.</h2>
      <p class="text-xl md:text-2xl text-text-muted mb-12 font-light leading-relaxed">
        Partner with Hailerz to secure premier talent for your next event. Experience the difference of a truly curated booking process.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-6">
        <x-button variant="primary" size="lg" href="/talent" wire:navigate>
          Find Talent
        </x-button>
        <x-button variant="secondary" size="lg" href="/book" wire:navigate>
          Book Now
        </x-button>
      </div>
    </div>
  </div>
</div>