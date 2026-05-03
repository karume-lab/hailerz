@push('head')
    {{-- Preload above-fold hero images (highest priority) --}}
    <link rel="preload" as="image" href="{{ asset('images/home/hero-card-1.webp') }}" type="image/webp"
        fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('images/home/hero-card-2.webp') }}" type="image/webp"
        fetchpriority="high">
@endpush

<div class="bg-surface-light">
    <!-- Hero Section -->
    <section class="relative bg-surface-dark pt-32 pb-40 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <!-- Left Content -->
                <div class="mb-16 lg:mb-0">
                    <h1
                        class="text-5xl md:text-7xl font-bold tracking-tight text-text-inverse mb-8 leading-[1.1] font-serif">
                        Book Top <span class="text-brand-secondary">Talent</span> for Your Event.
                    </h1>
                    <p class="mt-4 max-w-xl text-lg md:text-xl text-text-muted mb-12 leading-relaxed">
                        Premium talent booking agency connecting you with top musicians, variety artists, DJs, and performers for unforgettable events.
                    </p>
                    <div class="flex flex-wrap gap-6">
                        <x-button variant="secondary" size="lg" href="/join" wire:navigate>
                            Join Our Roster
                        </x-button>
                        <x-button variant="primary" size="lg" href="/talent" wire:navigate>
                            Find Talent
                        </x-button>
                    </div>
                </div>

                <!-- Right Content: Talent Showcase -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-6 pt-12">
                            <div
                                class="group relative overflow-hidden rounded-2xl aspect-3/4 bg-surface-dark border border-subtle">
                                <img src="{{ asset('images/home/hero-card-1.webp') }}" loading="eager"
                                    fetchpriority="high" decoding="async" width="664" height="887"
                                    class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110"
                                    alt="Live Performance Showcase - Artist performing on stage" />
                                <div
                                    class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color">
                                </div>
                                <div
                                    class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-transparent to-transparent">
                                </div>
                                <div class="absolute bottom-6 left-6">
                                    <p class="text-text-inverse font-bold text-lg">Premium Artists</p>
                                    <p class="text-text-inverse/80 text-sm">Bespoke Events</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div
                                class="group relative overflow-hidden rounded-2xl aspect-3/4 bg-surface-dark border border-subtle">
                                <img src="{{ asset('images/home/hero-card-2.webp') }}" loading="eager"
                                    fetchpriority="high" decoding="async" width="664" height="887"
                                    class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110"
                                    alt="Keynote Speaker Showcase - Professional speaker at an event" />
                                <div
                                    class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color">
                                </div>
                                <div
                                    class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-transparent to-transparent">
                                </div>
                                <div class="absolute bottom-6 left-6">
                                    <p class="text-text-inverse font-bold text-lg">Curated Talent</p>
                                    <p class="text-text-inverse/80 text-sm">Private Celebrations</p>
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

    <!-- How It Works -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">Book Talent in <span class="text-brand-secondary">Three Simple Steps</span></h2>
                <p class="text-lg text-text-secondary">We've made discovering and booking world-class performers effortless.</p>

                <div
                    class="mt-12 aspect-video max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-subtle bg-surface-dark">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/LLdr6BqljEw" title="Hailerz - How it Works"
                        frameborder="0" loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @php
                    $steps = [
                        [
                            'title' => 'Search',
                            'desc' => 'Search our curated directory of top talent by category, genre, or location to find the perfect fit.',
                            'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'
                        ],
                        [
                            'title' => 'Review',
                            'desc' => 'View detailed profiles with photos, videos, and reviews to find your perfect match with confidence.',
                            'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
                        ],
                        [
                            'title' => 'Book',
                            'desc' => 'Submit an inquiry directly from their profile and finalize your booking with our dedicated agents.',
                            'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
                        ]
                    ];
                @endphp

                @foreach($steps as $step)
                    <div
                        class="bg-surface-light p-10 rounded-3xl border border-subtle shadow-sm hover:shadow-xl transition-all duration-500 group text-center">
                        <div
                            class="h-16 w-16 mx-auto rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-text-primary mb-4">{{ $step['title'] }}</h3>
                        <p class="text-text-secondary leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories / Talent -->
    <section class="py-32 bg-surface-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 font-serif">Explore Our <span class="text-brand-secondary">Premier Roster</span></h2>
                    <p class="text-lg text-text-secondary">Discover top-tier musicians, DJs, and speakers. Each artist 
                        is meticulously vetted to guarantee an unforgettable performance.</p>
                </div>
                <x-button variant="secondary" href="/talent" wire:navigate>
                    View Full Talent
                </x-button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $categories = [
                        ['name' => 'Musicians', 'slug' => 'musicians', 'img' => 'musicians.webp'],
                        ['name' => 'Speakers', 'slug' => 'speakers', 'img' => 'speakers.webp'],
                        ['name' => 'DJs', 'slug' => 'djs', 'img' => 'djs.webp'],
                        ['name' => 'Comedians', 'slug' => 'comedians', 'img' => 'comedians.webp'],
                    ];
                @endphp

                @foreach($categories as $cat)
                    <a href="/talent?category={{ $cat['slug'] }}"
                        class="group block relative h-[450px] rounded-3xl overflow-hidden shadow-lg">
                        <img src="{{ asset('images/home/' . $cat['img']) }}" loading="lazy" decoding="async" width="640"
                            height="720"
                            class="absolute inset-0 w-full h-full object-cover grayscale transition-transform duration-1000 group-hover:scale-110"
                            alt="Browse {{ $cat['name'] }} category" />
                        <div
                            class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-90">
                        </div>
                        <div
                            class="absolute inset-0 bg-linear-to-t from-brand-primary via-brand-primary/40 to-transparent">
                        </div>
                        <div class="absolute bottom-10 left-10">
                            <h3 class="text-3xl font-bold text-text-inverse mb-2">{{ $cat['name'] }}</h3>
                            <div
                                class="flex items-center gap-2 text-text-inverse font-semibold uppercase tracking-widest text-xs">
                                <span>Browse Category</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Booking FAQs Section -->
    <section class="py-32 bg-surface-dark text-text-inverse">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-center mb-16 font-serif">Booking <span class="text-brand-secondary">FAQs</span></h2>
            
            <div x-data="{ active: 0 }" class="space-y-4">
                @php
                    $faqs = [
                        [
                            'q' => 'When should I start the booking process?',
                            'a' => 'For the best availability, we recommend reaching out 3-6 months in advance, especially for high-profile talent and peak dates. However, we can often accommodate last-minute requests depending on the roster.'
                        ],
                        [
                            'q' => 'What happens after I submit a request?',
                            'a' => 'Our agents will review your vision and provide a curated list of recommendations with pricing and availability within 24 hours. You\'ll have the opportunity to review media kits and profiles before securing your booking.'
                        ],
                        [
                            'q' => 'Are there hidden booking fees?',
                            'a' => 'Transparency is our priority. Our booking service is free for clients; you only pay the agreed performance fee for the talent you choose. We handle all logistics and contracts as part of our premium service.'
                        ],
                        [
                            'q' => 'Can I browse multiple categories?',
                            'a' => 'Of course. We encourage you to explore our entire directory to find the perfect combination of entertainment for your event.'
                        ]
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                    <div class="border-b border-subtle/20">
                        <button 
                            @click="active = (active === {{ $index }} ? null : {{ $index }})"
                            class="flex justify-between items-center w-full text-left py-8 focus:outline-none group transition-all"
                            aria-label="Toggle FAQ: {{ $faq['q'] }}"
                            :aria-expanded="active === {{ $index }} ? 'true' : 'false'"
                        >
                            <span class="text-xl md:text-2xl font-bold group-hover:text-brand-secondary transition-colors">{{ $faq['q'] }}</span>
                            <div 
                                class="h-8 w-8 rounded-full border border-subtle/30 flex items-center justify-center group-hover:border-brand-secondary transition-colors"
                                :class="{ 'bg-brand-secondary border-brand-secondary': active === {{ $index }} }"
                            >
                                <svg 
                                    class="w-4 h-4 transform transition-transform duration-300" 
                                    :class="{ 'rotate-180': active === {{ $index }}, 'text-text-inverse': active === {{ $index }} }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div 
                            x-show="active === {{ $index }}" 
                            x-collapse
                            x-cloak
                            class="overflow-hidden"
                        >
                            <p class="pb-8 text-lg text-text-muted leading-relaxed max-w-3xl">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact / Inquiry Section -->
    <section class="py-32 bg-brand-primary relative overflow-hidden">
        {{-- Background Decorative Elements --}}
        <div class="absolute top-0 right-0 w-1/3 h-full bg-linear-to-l from-text-inverse/5 to-transparent"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-secondary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-text-inverse/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-2 lg:gap-24 items-center">
                <div>
                    <h2 class="text-3xl md:text-6xl font-bold text-text-inverse mb-8 font-serif leading-tight">Ready to <span class="text-brand-secondary">Work Together?</span></h2>
                    <p class="text-xl text-text-inverse/80 mb-12 leading-relaxed">
                        Let’s create something unforgettable. Reach out to our dedicated agents for bespoke recommendations 
                        tailored to your vision.
                    </p>

                    <ul class="space-y-8 mb-12">
                        <li class="flex items-center gap-6">
                            <div
                                class="h-14 w-14 rounded-2xl bg-text-inverse/10 flex items-center justify-center text-text-inverse shrink-0 backdrop-blur-sm border border-subtle">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-text-inverse font-bold">Send us a message</h3>
                                <p class="text-text-inverse/60 text-sm">bookings@hailerz.com</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-6">
                            <div
                                class="h-14 w-14 rounded-2xl bg-text-inverse/10 flex items-center justify-center text-text-inverse shrink-0 backdrop-blur-sm border border-subtle">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-text-inverse font-bold">Premium Support</h3>
                                <p class="text-text-inverse/60 text-sm">Our agents respond promptly to every inquiry.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div
                    class="bg-surface-light/95 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-subtle relative overflow-hidden">
                    {{-- Subtle background decoration to break the flat white --}}
                    <div
                        class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-brand-primary/5 rounded-full blur-3xl pointer-events-none">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-brand-secondary/5 rounded-full blur-3xl pointer-events-none">
                    </div>

                    @if($contactSent)
                        <div class="relative z-10 flex flex-col items-center text-center py-12 gap-6">
                            <div
                                class="h-20 w-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-text-primary">Inquiry Received</h3>
                            <p class="text-text-secondary">An agent will review your request and
                                contact you shortly.</p>
                            <button wire:click="$set('contactSent', false)"
                                class="text-brand-primary font-bold hover:underline">Submit another inquiry</button>
                        </div>
                    @else
                        <form wire:submit="submitContact" class="relative z-10 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="contactName"
                                        class="block text-xs font-bold text-text-secondary uppercase tracking-widest mb-2">Name</label>
                                    <input id="contactName" wire:model="contactName" type="text" placeholder="Full Name"
                                        class="w-full px-5 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:bg-surface-light focus:border-transparent outline-none transition-all text-text-primary placeholder-text-muted shadow-sm" />
                                    @error('contactName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="contactEmail"
                                        class="block text-xs font-bold text-text-secondary uppercase tracking-widest mb-2">Email</label>
                                    <input id="contactEmail" wire:model="contactEmail" type="email"
                                        autocomplete="email"
                                        placeholder="Email Address"
                                        class="w-full px-5 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:bg-surface-light focus:border-transparent outline-none transition-all text-text-primary placeholder-text-muted shadow-sm" />
                                    @error('contactEmail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="contactMessage"
                                    class="block text-xs font-bold text-text-secondary uppercase tracking-widest mb-2">Message</label>
                                <textarea id="contactMessage" wire:model="contactMessage" rows="5"
                                    placeholder="Tell us about your event vision and the type of talent you're looking for..."
                                    class="w-full px-5 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:bg-surface-light focus:border-transparent outline-none transition-all resize-none text-text-primary placeholder-text-muted shadow-sm"></textarea>
                                @error('contactMessage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <x-button type="submit" class="w-full shadow-lg shadow-brand-primary/20" size="lg" variant="secondary" wire:loading.attr="disabled" wire:target="submitContact">
                                <span wire:loading.remove wire:target="submitContact">Send Message</span>
                                <span wire:loading wire:target="submitContact" class="flex items-center justify-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </x-button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-linear-to-t from-black/20 to-transparent"></div>
    </section>
</div>