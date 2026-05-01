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
        We represent the <span class="text-brand-secondary">artists</span> you want to book.
      </h1>
      <p class="mt-4 max-w-3xl text-xl md:text-2xl text-text-muted mx-auto leading-relaxed font-light">
        Hailerz is a specialized talent agency. We help event planners and brands secure the best performers in the world without the usual back-and-forth.
      </p>
    </div>
  </div>

  <!-- Our Story Section -->
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
    <div class="flex items-center gap-3 mb-6">
      <span class="h-px w-8 bg-brand-primary"></span>
      <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Our Legacy</span>
    </div>
    <h2 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight mb-12 font-serif">Why we started</h2>
    <div class="space-y-10 text-xl text-text-secondary leading-relaxed font-light">
      <p>
        Hailerz was founded on a simple idea: booking high-end talent should be easier. We saw too many planners struggling to get clear answers from artists, so we built an agency that prioritizes speed, clear pricing, and reliable service.
      </p>
      <p>
        Today, we represent a handpicked list of performers, speakers, and DJs. We don't just fill slots; we help you find an artist who actually fits the tone of your night, whether it's a corporate gala or a private party.
      </p>
      <p>
        We've built our reputation on being straightforward. We handle the contracts and the travel details so you can focus on running your event.
      </p>
    </div>
  </div>

  <!-- Our Values -->
  <div class="bg-surface-light py-32 border-y border-subtle ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-20">
        <h2 class="text-3xl md:text-5xl font-bold text-text-primary tracking-tight mb-6 font-serif">What we stand for</h2>
        <p class="text-lg text-text-secondary">Our core values define how we work with both artists and clients.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
          $values = [
            ['title' => 'Quality', 'desc' => 'We only work with artists who we know can deliver a professional show every single time.'],
            ['title' => 'Discretion', 'desc' => 'We operate with the highest level of confidentiality for our high-profile clients.'],
            ['title' => 'Collaboration', 'desc' => 'We work closely with you as a partner, not just another vendor.'],
            ['title' => 'Honesty', 'desc' => 'Clear pricing and straightforward contracts are at the core of how we work.'],
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
        <h2 class="text-3xl md:text-5xl font-bold text-text-primary tracking-tight mb-6 font-serif">The Agents</h2>
        <p class="text-lg text-text-secondary">Meet the specialists dedicated to your event's success.</p>
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
      class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center grayscale">
    </div>
    <div
      class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-40">
    </div>

    <div class="relative max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-4xl md:text-7xl font-bold text-text-inverse mb-8 tracking-tight font-serif">Ready to book?</h2>
      <p class="text-xl md:text-2xl text-text-muted mb-12 font-light leading-relaxed">
        Work with us to find the right artist and handle the booking from start to finish.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-6">
        <x-button variant="primary" size="lg" href="/talent" wire:navigate>
          Explore the Roster
        </x-button>
        <x-button variant="secondary" size="lg" href="/book" wire:navigate>
          Book Now
        </x-button>
      </div>
    </div>
  </div>
</div>