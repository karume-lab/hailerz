<div class="bg-surface-muted min-h-screen">
  <!-- Hero Section -->
  <section class="relative bg-surface-dark py-24 lg:py-32 border-b border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
      <x-heading level="h1" title="Our Services" align="center" class="text-text-inverse mb-6" />
      <p class="text-xl text-text-inverse/80 max-w-3xl mx-auto leading-relaxed font-light">
        Comprehensive professional services, talent booking, and staff augmentation solutions tailored to your needs.
      </p>
    </div>
  </section>

  <!-- Talent Categories Section -->
  <section class="py-24 bg-surface-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 reveal">
        <x-heading level="h2" title="Talent" highlight="Categories" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary max-w-2xl mx-auto">Premium performers across every category and genre</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
        @foreach($allCategories as $index => $cat)
          <a href="/talent?category={{ $cat->slug }}" wire:navigate
            class="group rounded-3xl border border-subtle bg-surface-light p-8 shadow-sm flex flex-col h-full hover:border-brand-primary hover:shadow-lg transition-all duration-300 reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
            <div
              class="w-16 h-16 bg-brand-primary/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-brand-primary group-hover:text-text-inverse transition-colors duration-300">
              @php
                $iconName = $cat->icon ?? 'users';
              @endphp
              <x-dynamic-component :component="'lucide-' . $iconName" class="w-8 h-8 text-brand-primary group-hover:text-text-inverse" />
            </div>
            <h3 class="text-2xl font-bold mb-3 text-text-primary group-hover:text-brand-primary transition-colors">
              {{ $cat->name }}
            </h3>
            <p class="text-text-secondary text-sm leading-relaxed mb-6 grow">{{ $cat->description }}</p>

            @if($cat->popular_genres)
            <div class="mb-6">
              <h4 class="text-xs font-bold text-text-primary uppercase tracking-widest mb-3">Popular Genres:</h4>
              <div class="flex flex-wrap gap-2">
                @foreach($cat->popular_genres as $genre)
                  <span
                    class="px-3 py-1 bg-surface-muted text-text-secondary text-[10px] font-bold rounded-full border border-subtle">
                    {{ $genre }}
                  </span>
                @endforeach
              </div>
            </div>
            @endif

            <div class="pt-6 border-t border-subtle">
              <p class="text-xs text-text-muted italic">Most Popular for: {{ $cat->popular_for }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Events We Serve -->
  <section class="py-24 bg-surface-muted/30 border-y border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 reveal">
        <x-heading level="h2" title="Services We" highlight="Provide" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary">Specialized talent for your professional and creative needs</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @php
          $events = [
            ['title' => 'Professional Staffing', 'desc' => 'Scale your team with contract and remote talent for short or long-term projects.'],
            ['title' => 'Staff Augmentation', 'desc' => 'Fill skill gaps immediately with vetted professionals who integrate seamlessly into your workflows.'],
            ['title' => 'Creative Services', 'desc' => 'Access top-tier content creators, artists, and media specialists for your brand.'],
            ['title' => 'Corporate Speaking', 'desc' => 'Keynote speakers and industry professionals who deliver high-impact insights for your team.'],
            ['title' => 'Strategic Consulting', 'desc' => 'Consult with professionals who bring deep industry knowledge to your organization.'],
            ['title' => 'Managed Placements', 'desc' => 'End-to-end recruitment and placement services for professional roles.'],
          ];
        @endphp

        @foreach($events as $index => $event)
          <div
            class="rounded-2xl border border-subtle bg-surface-light p-8 hover:border-brand-primary transition-colors duration-300 reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
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
      <div class="text-center mb-16 reveal">
        <x-heading level="h2" title="Full-Service" highlight="Support" align="center" class="mb-4" />
        <p class="text-lg text-text-secondary max-w-2xl mx-auto">We handle everything so you can focus on your event</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 max-w-6xl mx-auto">
        @php
          $supports = [
            ['title' => 'Talent Vetting', 'icon' => 'shield', 'desc' => 'We conduct rigorous interviews and skill assessments to ensure quality.'],
            ['title' => 'Contract Management', 'icon' => 'file-text', 'desc' => 'Professional contracts that protect both parties with clear terms for remote and on-site work.'],
            ['title' => 'Project Coordination', 'icon' => 'calendar', 'desc' => 'We manage the logistics of talent integration and project timelines.'],
            ['title' => 'Remote Placements', 'icon' => 'mouse-pointer-2', 'desc' => 'Global talent ready to work in your time zone and digital environment.'],
            ['title' => 'Staff Augmentation', 'icon' => 'zap', 'desc' => 'Rapidly scale your workforce to meet changing project demands.'],
            ['title' => 'Quality Assurance', 'icon' => 'circle-check', 'desc' => 'Ongoing monitoring and support to ensure project success and satisfaction.'],
          ];
        @endphp

        @foreach($supports as $index => $s)
          <div class="text-center reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
            <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
              @if($s['icon'] === 'calendar') <x-lucide-calendar class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'file-text') <x-lucide-file-text class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'mouse-pointer-2') <x-lucide-mouse-pointer-2 class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'shield') <x-lucide-shield class="w-8 h-8 text-brand-primary" />
              @elseif($s['icon'] === 'zap') <x-lucide-zap class="w-8 h-8 text-brand-primary" />
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
      <div class="text-center mb-16 reveal">
        <x-heading level="h2" title="How It" highlight="Works" align="center" class="mb-4" />
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
          <div class="flex gap-8 reveal {{ $index % 2 === 1 ? 'reveal-delay-100' : '' }}">
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
        <x-heading level="h2" title="Transparent" highlight="Pricing" align="center" class="mb-12 reveal" />

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
              <div class="font-bold text-xl text-text-primary mb-1">$500 - $1,500</div>
              <div class="text-sm text-text-secondary">Solo Musicians</div>
            </div>
            <div>
              <div class="font-bold text-xl text-text-primary mb-1">$800 - $2,500</div>
              <div class="text-sm text-text-secondary">DJs</div>
            </div>
            <div>
              <div class="font-bold text-xl text-text-primary mb-1">$1,200 - $3,500</div>
              <div class="text-sm text-text-secondary">Variety Artists</div>
            </div>
            <div>
              <div class="font-bold text-xl text-text-primary mb-1">$2,500 - $10,000+</div>
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
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
      <x-heading level="h2" title="Ready to Get" highlight="Started?" align="center" class="text-text-inverse mb-6" />
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