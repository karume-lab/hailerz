<x-layouts.app>
    <x-slot:title>Benefits of Challenges | Hailerz</x-slot>

    <div class="bg-surface-muted min-h-screen">
      <!-- Hero Section -->
      <section class="relative bg-surface-dark py-24 lg:py-32 border-b border-subtle">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
          <x-heading level="h1" title="Benefits of" highlight="Challenges" align="center" class="text-text-inverse mb-6" />
          <p class="text-xl text-text-inverse/80 max-w-3xl mx-auto leading-relaxed font-light">
            Discover why participating in Hailerz Challenges accelerates your career, builds your portfolio, and connects you with industry leaders.
          </p>
        </div>
      </section>

      <!-- Why Participate -->
      <section class="py-24 bg-surface-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-16 reveal">
            <x-heading level="h2" title="Why" highlight="Participate?" align="center" class="mb-4" />
            <p class="text-lg text-text-secondary max-w-2xl mx-auto">Elevate your technical and creative skills through competitive sprints.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @php
              $benefits = [
                ['title' => 'Skill Development', 'desc' => 'Push your boundaries with real-world problems and technical requirements that demand growth.'],
                ['title' => 'Peer Recognition', 'desc' => 'Stand out in the Hailerz community. Winning or placing highly boosts your profile visibility.'],
                ['title' => 'Portfolio Building', 'desc' => 'Every challenge you complete results in a polished, verified project to showcase to potential clients.'],
                ['title' => 'Prizes & Awards', 'desc' => 'Compete for prize pools, exclusive software licenses, and direct financial compensation.'],
                ['title' => 'Industry Networking', 'desc' => 'Interact with judges, sponsors, and other top-tier talent during collaborative sprints.'],
                ['title' => 'Exclusive Workshops', 'desc' => 'Gain access to private masterclasses and technical breakdowns available only to active participants.'],
              ];
            @endphp

            @foreach($benefits as $index => $benefit)
              <div class="rounded-2xl border border-subtle bg-surface-light p-8 hover:border-brand-primary transition-colors duration-300 reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
                <h3 class="text-xl font-bold mb-3 text-text-primary">{{ $benefit['title'] }}</h3>
                <p class="text-text-secondary text-sm leading-relaxed">{{ $benefit['desc'] }}</p>
              </div>
            @endforeach
          </div>
        </div>
      </section>

      <!-- What You Get -->
      <section class="py-24 bg-surface-muted/30 border-y border-subtle">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-16 reveal">
            <x-heading level="h2" title="What You" highlight="Get" align="center" class="mb-4" />
            <p class="text-lg text-text-secondary max-w-2xl mx-auto">Tangible outcomes from your competitive efforts</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
            @php
              $supports = [
                ['title' => 'Expert Feedback', 'icon' => 'file-text', 'desc' => 'Receive constructive, actionable feedback from industry veterans and specialized judges.'],
                ['title' => 'Global Exposure', 'icon' => 'zap', 'desc' => 'Top entries are featured on our homepage, newsletter, and social media channels.'],
                ['title' => 'Verified Certificates', 'icon' => 'circle-check', 'desc' => 'Earn cryptographic badges and certificates of completion for your digital resume.'],
              ];
            @endphp

            @foreach($supports as $index => $s)
              <div class="text-center reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
                <div class="w-16 h-16 bg-brand-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                  @if($s['icon'] === 'file-text') <x-lucide-file-text class="w-8 h-8 text-brand-primary" />
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

      <!-- Ready to Get Started -->
      <section class="py-24 bg-brand-accent border-t border-subtle">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
          <x-heading level="h2" title="Ready to Elevate Your" highlight="Craft?" align="center" highlightClass="text-[#65c4af]" class="text-text-inverse mb-6" />
          <p class="text-xl text-text-inverse/80 mb-12">Join the next sprint, test your skills against the best, and start earning recognition today.</p>
          <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <x-button ksize="lg" href="/challenges/browse" wire:navigate>
              Browse Active Challenges
            </x-button>
          </div>
        </div>
      </section>
    </div>
</x-layouts.app>
