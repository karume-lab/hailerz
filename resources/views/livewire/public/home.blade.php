@push('head')
 {{-- Preload above-fold hero images (highest priority) --}}
 <link rel="preload" as="image" href="{{ asset('images/home/hero-card-1.webp') }}" type="image/webp" fetchpriority="high">
 <link rel="preload" as="image" href="{{ asset('images/home/hero-card-2.webp') }}" type="image/webp" fetchpriority="high">
 {{-- Preload category images (lower priority) so they're ready when the user scrolls --}}
 <link rel="preload" as="image" href="{{ asset('images/home/musicians.webp') }}" type="image/webp" fetchpriority="low">
 <link rel="preload" as="image" href="{{ asset('images/home/speakers.webp') }}" type="image/webp" fetchpriority="low">
 <link rel="preload" as="image" href="{{ asset('images/home/djs.webp') }}" type="image/webp" fetchpriority="low">
 <link rel="preload" as="image" href="{{ asset('images/home/specialty.webp') }}" type="image/webp" fetchpriority="low">
@endpush

<div class="bg-surface-light">
 <!-- Hero Section -->
 <section class="relative bg-surface-dark pt-32 pb-40 overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
   <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
    <!-- Left Content -->
    <div class="mb-16 lg:mb-0">
     <h1 class="text-5xl md:text-7xl font-bold tracking-tight text-text-inverse mb-8 leading-[1.1] font-serif">
      Elevate Your Events with <span class="text-brand-primary">World-Class</span> Talent.
     </h1>
     <p class="mt-4 max-w-xl text-lg md:text-xl text-text-muted mb-12 leading-relaxed">
      Hailerz is the definitive roster for corporate events, galas, and private functions. Secure the act that transforms your occasion into an unforgettable experience.
     </p>
     <div class="flex flex-wrap gap-6">
      <x-button variant="primary" size="lg" href="/talent" wire:navigate>
       Explore the Roster
      </x-button>
      <x-button variant="secondary" size="lg" href="/contact" wire:navigate>
       Agency Inquiry
      </x-button>
     </div>
    </div>

    <!-- Right Content: Talent Showcase -->
    <div class="relative">
     <div class="grid grid-cols-2 gap-6">
      <div class="space-y-6 pt-12">
       <div class="group relative overflow-hidden rounded-2xl aspect-3/4 bg-surface-dark border border-white/5">
        <img src="{{ asset('images/home/hero-card-1.webp') }}" loading="eager" fetchpriority="high" width="664" height="887" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110" alt="Live Performance Showcase" />
        <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color"></div>
        <div class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-transparent to-transparent"></div>
        <div class="absolute bottom-6 left-6">
         <p class="text-white font-bold text-lg">Live Performance</p>
         <p class="text-brand-secondary text-sm">Gala Dinners</p>
        </div>
       </div>
      </div>
      <div class="space-y-6">
       <div class="group relative overflow-hidden rounded-2xl aspect-3/4 bg-surface-dark border border-white/5">
        <img src="{{ asset('images/home/hero-card-2.webp') }}" loading="eager" fetchpriority="high" width="664" height="887" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110" alt="Keynote Speaker Showcase" />
        <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color"></div>
        <div class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-transparent to-transparent"></div>
        <div class="absolute bottom-6 left-6">
         <p class="text-white font-bold text-lg">Keynote Speakers</p>
         <p class="text-brand-secondary text-sm">Corporate Summits</p>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>

  <!-- Background Elements -->
  <div class="absolute top-0 right-0 w-1/2 h-full bg-linear-to-l from-brand-primary/5 to-transparent"></div>
 </section>

 <!-- Services Overview -->
 <section class="py-32 bg-surface-muted">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   <div class="text-center max-w-3xl mx-auto mb-20">
    <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">A Full-Service Agency for Extraordinary Events</h2>
    <p class="text-lg text-text-secondary">From procurement to performance, we handle every detail of the booking process.</p>
   </div>

   <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
    @php
     $services = [
      [
       'title' => 'Talent Procurement',
       'desc' => 'Access an exclusive roster of world-class performers and keynote speakers tailored to your event\'s DNA.',
       'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'
      ],
      [
       'title' => 'Contract Negotiation',
       'desc' => 'Our experienced agents manage all legal and financial negotiations, ensuring secure and professional agreements.',
       'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
      ],
      [
       'title' => 'On-Site Coordination',
       'desc' => 'We provide comprehensive support and logistics to guarantee a flawless execution of the talent\'s performance.',
       'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'
      ]
     ];
    @endphp

    @foreach($services as $service)
     <div class="bg-surface-light p-10 rounded-3xl border border-subtle shadow-sm hover:shadow-xl transition-all duration-500 group">
      <div class="h-14 w-14 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
       <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"></path>
       </svg>
      </div>
      <h3 class="text-2xl font-bold text-text-primary mb-4">{{ $service['title'] }}</h3>
      <p class="text-text-secondary leading-relaxed">{{ $service['desc'] }}</p>
     </div>
    @endforeach
   </div>
  </div>
 </section>

 <!-- Categories / The Roster -->
 <section class="py-32 bg-surface-light">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
    <div class="max-w-2xl">
     <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">Curated Roster of Performers</h2>
     <p class="text-lg text-text-secondary">Explore our categories of vetted professionals ready to secure the act for your next gala or summit.</p>
    </div>
    <x-button variant="outline" href="/talent" wire:navigate>
     View Full Roster
    </x-button>
   </div>

   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @php
     $categories = [
      ['name' => 'Live Bands', 'slug' => 'musicians', 'img' => 'musicians.webp'],
      ['name' => 'Keynote Speakers', 'slug' => 'speakers', 'img' => 'speakers.webp'],
      ['name' => 'DJs & Electronics', 'slug' => 'djs', 'img' => 'djs.webp'],
      ['name' => 'Specialty Acts', 'slug' => 'specialty', 'img' => 'specialty.webp'],
     ];
    @endphp

    @foreach($categories as $cat)
     <a href="/talent?category={{ $cat['slug'] }}" class="group block relative h-[450px] rounded-3xl overflow-hidden shadow-lg">
      <img src="{{ asset('images/home/' . $cat['img']) }}" loading="eager" fetchpriority="low" width="640" height="720" class="absolute inset-0 w-full h-full object-cover grayscale transition-transform duration-1000 group-hover:scale-110" alt="{{ $cat['name'] }}" />
      <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-90"></div>
      <div class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-brand-primary/20 to-transparent"></div>
      <div class="absolute bottom-10 left-10">
       <h3 class="text-3xl font-bold text-text-inverse mb-2">{{ $cat['name'] }}</h3>
       <div class="flex items-center gap-2 text-brand-secondary font-semibold uppercase tracking-widest text-xs">
        <span>Browse Category</span>
        <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
       </div>
      </div>
     </a>
    @endforeach
   </div>
  </div>
 </section>

 <!-- Contact / Inquiry Section -->
 <section class="py-32 bg-brand-primary overflow-hidden relative">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
   <div class="lg:grid lg:grid-cols-2 lg:gap-24 items-center">
    <div>
     <h2 class="text-3xl md:text-6xl font-bold text-text-inverse mb-8 font-serif leading-tight">Ready to Secure the Act?</h2>
     <p class="text-xl text-text-muted mb-12 leading-relaxed">
      Our agents are standing by to help you find the perfect talent for your event. Whether you have a specific performer in mind or need expert recommendations, we are here to assist.
     </p>
     
     <ul class="space-y-8 mb-12">
      <li class="flex items-center gap-6">
       <div class="h-12 w-12 rounded-xl bg-brand-primary/10 flex items-center justify-center text-brand-primary shrink-0">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
         <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
       </div>
       <div>
        <h3 class="text-text-inverse font-bold">Email Our Agents</h3>
        <p class="text-text-muted text-sm">bookings@hailerz.com</p>
       </div>
      </li>
      <li class="flex items-center gap-6">
       <div class="h-12 w-12 rounded-xl bg-brand-primary/10 flex items-center justify-center text-brand-primary shrink-0">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
         <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
       </div>
       <div>
        <h3 class="text-text-inverse font-bold">Rapid Response</h3>
        <p class="text-text-muted text-sm">Typically within 24 business hours</p>
       </div>
      </li>
     </ul>
    </div>

    <div class="bg-white p-10 rounded-3xl shadow-2xl border border-subtle ">
     @if($contactSent)
      <div class="flex flex-col items-center text-center py-12 gap-6">
       <div class="h-20 w-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
         <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
        </svg>
       </div>
       <h3 class="text-3xl font-bold text-text-primary dark:text-white">Inquiry Received</h3>
       <p class="text-text-secondary dark:text-text-muted">An agent will review your request and contact you shortly.</p>
       <button wire:click="$set('contactSent', false)" class="text-brand-primary font-bold hover:underline">Submit another inquiry</button>
      </div>
     @else
      <form wire:submit="submitContact" class="space-y-6">
       <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
         <label for="contactName" class="block text-xs font-bold text-brand-primary dark:text-text-muted uppercase tracking-widest mb-2">Name</label>
         <input id="contactName" wire:model="contactName" type="text" placeholder="Full Name" class="w-full px-5 py-4 bg-white border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none transition-all text-text-primary dark:text-white placeholder-gray-500 dark:placeholder-gray-400" />
         @error('contactName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
         <label for="contactEmail" class="block text-xs font-bold text-brand-primary dark:text-text-muted uppercase tracking-widest mb-2">Email</label>
         <input id="contactEmail" wire:model="contactEmail" type="email" placeholder="Email Address" class="w-full px-5 py-4 bg-white border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none transition-all text-text-primary dark:text-white placeholder-gray-500 dark:placeholder-gray-400" />
         @error('contactEmail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
       </div>
       <div>
        <label for="contactMessage" class="block text-xs font-bold text-brand-primary dark:text-text-muted uppercase tracking-widest mb-2">Message</label>
        <textarea id="contactMessage" wire:model="contactMessage" rows="5" placeholder="Tell us about your event and the talent you're interested in..." class="w-full px-5 py-4 bg-white border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none transition-all resize-none text-text-primary dark:text-white placeholder-gray-500 dark:placeholder-gray-400"></textarea>
        @error('contactMessage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
       </div>
       <x-button type="submit" class="w-full" size="lg">
        Submit Booking Inquiry
       </x-button>
      </form>
     @endif
    </div>
   </div>
  </div>

  <div class="absolute bottom-0 left-0 w-full h-1/2 bg-linear-to-t from-black/20 to-transparent"></div>
 </section>
</div>