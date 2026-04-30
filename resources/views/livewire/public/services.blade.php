<div class="bg-surface-muted min-h-screen">
 <!-- Hero Section -->
 <section class="relative bg-surface-dark py-32 lg:py-48 overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
   <div class="flex items-center justify-center gap-3 mb-8">
    <span class="h-px w-12 bg-brand-primary"></span>
    <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Agency Solutions</span>
    <span class="h-px w-12 bg-brand-primary"></span>
   </div>
   <h1 class="text-5xl md:text-8xl font-bold text-text-inverse tracking-tight mb-8 font-serif leading-tight">Professional <span class="text-brand-secondary">Talent</span> Procurement</h1>
   <p class="text-xl md:text-2xl text-text-muted max-w-3xl mx-auto leading-relaxed font-light">
    Comprehensive entertainment solutions and secure booking services for global events, corporate galas, and private functions.
   </p>
  </div>
  
  <!-- Abstract design elements -->
  <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-brand-primary/10 rounded-full blur-[150px] opacity-20"></div>
 </section>

 <!-- Talent Categories -->
 <section class="py-32 bg-surface-muted">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   <div class="text-center max-w-3xl mx-auto mb-24">
    <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">Curated Disciplines</h2>
    <p class="text-text-secondary text-lg">World-class performers vetted for professional standards and exceptional delivery.</p>
   </div>

   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @php
     $categories = [
      [
       'name' => 'Keynote Speakers',
       'desc' => 'Thought leaders, industry experts, and motivational speakers for corporate summits and conferences.',
       'icon' => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z',
       'genres' => ['Business', 'Tech', 'Motivation', 'Policy']
      ],
      [
       'name' => 'Live Bands & Ensembles',
       'desc' => 'Full-scale musical acts providing high-energy entertainment for galas and large-scale celebrations.',
       'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z',
       'genres' => ['Contemporary', 'Jazz', 'Symphonic', 'Afro-Fusion']
      ],
      [
       'name' => 'Corporate Performers',
       'desc' => 'Dancers, specialty acts, and variety performers tailored for brand launches and gala dinners.',
       'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857',
       'genres' => ['Contemporary', 'Acrobatic', 'Cultural', 'Theatre']
      ],
     ];
    @endphp

    @foreach($categories as $cat)
    <div class="bg-surface-light p-12 rounded-[2.5rem] border border-subtle shadow-sm hover:shadow-2xl transition-all duration-500 group">
     <div class="w-16 h-16 bg-brand-primary/10 rounded-2xl flex items-center justify-center text-brand-primary mb-8 group-hover:scale-110 transition-transform">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"></path></svg>
     </div>
     <h3 class="text-2xl font-bold text-text-primary mb-6 font-serif">{{ $cat['name'] }}</h3>
     <p class="text-text-secondary mb-8 leading-relaxed">{{ $cat['desc'] }}</p>
     <div class="flex flex-wrap gap-2">
      @foreach($cat['genres'] as $genre)
      <span class="px-4 py-1.5 bg-surface-muted text-[10px] font-bold uppercase tracking-widest text-text-muted rounded-full border border-subtle ">{{ $genre }}</span>
      @endforeach
     </div>
    </div>
    @endforeach
   </div>
  </div>
 </section>

 <!-- Support Pillars -->
 <section class="py-32 bg-brand-primary relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
   <div class="lg:grid lg:grid-cols-2 lg:gap-24 items-center">
    <div>
     <h2 class="text-3xl md:text-6xl font-bold text-text-inverse mb-8 font-serif leading-tight">Full-Cycle Agency Support</h2>
     <p class="text-xl text-text-muted mb-12 leading-relaxed font-light">We handle the administrative and technical complexities, allowing you to focus on the production.</p>
     
     <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
      @foreach([
       ['Contract Negotiation', 'Professional, legally binding agreements ensuring protection for all parties.'],
       ['Technical Riders', 'Coordination of sound, lighting, and stage specifications with the talent.'],
       ['Logistics Management', 'Overseeing travel, accommodation, and on-site hospitality requirements.'],
       ['Performance Quality', 'Continuous vetting and post-event audits to maintain elite standards.'],
      ] as $pillar)
      <div class="space-y-3">
       <h3 class="text-brand-primary font-bold text-sm uppercase tracking-widest">{{ $pillar[0] }}</h3>
       <p class="text-white/60 text-sm leading-relaxed">{{ $pillar[1] }}</p>
      </div>
      @endforeach
     </div>
    </div>
    <div class="relative mt-16 lg:mt-0">
     <div class="group relative overflow-hidden rounded-[3rem] aspect-4/5 bg-surface-dark border border-white/5">
      <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=1000" loading="lazy" width="800" height="1000" class="w-full h-full object-cover grayscale opacity-60 transition-transform duration-700 group-hover:scale-105" alt="Event Logistics" />
      <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70"></div>
      <div class="absolute inset-0 bg-linear-to-t from-brand-primary via-transparent to-transparent"></div>
     </div>
    </div>
   </div>
  </div>
 </section>

 <!-- Process -->
 <section class="py-32 bg-surface-light border-b border-brand-primary/5">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   <div class="text-center max-w-3xl mx-auto mb-24">
    <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">The Procurement Process</h2>
    <p class="text-text-secondary text-lg">A transparent and structured approach from inquiry to execution.</p>
   </div>

   <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
    @foreach([
     ['01', 'Initial Inquiry', 'Submit event specifications and talent preferences via our secure booking portal.'],
     ['02', 'Strategic Proposal', 'Receive a curated selection of available talent with transparent investment details.'],
     ['03', 'Secure the Act', 'Formalize the engagement with professional contracting and initial commitment.'],
    ] as $step)
    <div class="relative">
     <span class="text-8xl font-black text-text-primary/5 dark:text-white/5 absolute -top-12 -left-4">{{ $step[0] }}</span>
     <div class="relative z-10">
      <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">{{ $step[1] }}</h3>
      <p class="text-text-secondary leading-relaxed font-light">{{ $step[2] }}</p>
     </div>
    </div>
    @endforeach
   </div>
  </div>
 </section>

 <!-- Final CTA -->
 <section class="py-32 bg-surface-muted text-center">
  <div class="max-w-4xl mx-auto px-4">
   <h2 class="text-3xl md:text-6xl font-bold text-text-primary mb-8 font-serif leading-tight">Elevate Your Next Occasion.</h2>
   <p class="text-xl text-text-secondary mb-12 max-w-2xl mx-auto font-light leading-relaxed">
    Our agents are available to provide expert recommendations and manage your talent requirements with precision.
   </p>
   <div class="flex flex-col sm:flex-row justify-center gap-6">
    <x-button variant="primary" size="lg" href="/talent" wire:navigate>
     Browse the Roster
    </x-button>
    <x-button variant="secondary" size="lg" href="/book" wire:navigate>
     Start Inquiry
    </x-button>
   </div>
  </div>
 </section>
</div>
