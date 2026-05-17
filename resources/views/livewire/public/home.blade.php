@push('head')
    {{-- Preload hero background image --}}
    <link rel="preload" as="image" href="{{ asset('images/home/hero-bg.webp') }}" fetchpriority="high">
@endpush

<div class="bg-surface-light">
    <!-- Hero Section -->
    <section class="relative min-h-[85vh] flex items-center justify-center pt-32 pb-20 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/home/hero-bg.webp') }}" class="w-full h-full object-cover"
                alt="Hero background - Rays of light illuminating a stage" fetchpriority="high" decoding="sync">
            <div class="absolute inset-0 bg-black/20 bg-linear-to-b from-black/40 via-transparent to-black/60"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <x-heading level="h1" title="Book Top Talent" align="center" class="text-white mb-8" />
            <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto font-medium leading-relaxed">
                Connect with creative talent and professional services for your projects and productions.
            </p>

            <!-- Search Bar -->
            <form wire:submit="searchTalent" class="relative max-w-4xl mx-auto mb-10 group">
                <div
                    class="flex flex-col md:flex-row gap-3 p-3 md:p-2 bg-white/10 backdrop-blur-xl rounded-xl md:rounded-full border border-white/20 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transition-all duration-500 hover:bg-white/15">
                    <x-input wire:model="search" placeholder="Search by name, genre, or location..." icon="search"
                        class="flex-1 bg-transparent border-none text-white placeholder-white/50 ring-0 py-4 md:py-5 text-lg md:text-xl" />
                    <x-button type="submit" variant="primary" class="active:scale-95 transform flex-1/4">
                        Find Talent
                    </x-button>
                </div>
            </form>

            <!-- Quick Links / Categories -->
            <div
                class="flex flex-wrap justify-center gap-x-6 md:gap-x-12 gap-y-6 mt-12 text-xs font-bold uppercase tracking-widest text-white/80">
                @foreach($allCategories as $cat)
                <a href="/talent?category={{ $cat->slug }}" wire:navigate
                    class="hover:text-brand-primary transition-all hover:scale-105 transform whitespace-nowrap">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <x-heading level="h2" title="Join Our Talent Pool" align="center"
                    class="text-text-primary" />
                <p class="text-lg text-text-secondary mx-auto max-w-2xl">Get Seen. Get featured.</p>

                <div
                    class="mt-12 aspect-video max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-subtle bg-surface-dark reveal reveal-delay-200">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/LLdr6BqljEw?autoplay=1&mute=1&rel=0"
                        title="Hailerz - How it Works" frameborder="0" loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </div>

            <x-heading level="h2" title="Book Talent in Three Simple Steps" align="center"
                class="text-text-primary mb-10" />
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @php
                    $steps = [
                        [
                            'title' => 'Search',
                            'desc' => 'Search our curated directory of top talent by category, genre, or location to find the perfect fit.',
                            'icon' => 'search'
                        ],
                        [
                            'title' => 'Review',
                            'desc' => 'View detailed profiles with photos, videos, and reviews to find your perfect match with confidence.',
                            'icon' => 'user-check'
                        ],
                        [
                            'title' => 'Book',
                            'desc' => 'Submit an inquiry directly from their profile and finalize your booking with our dedicated agents.',
                            'icon' => 'calendar-check'
                        ]
                    ];
                @endphp

                @foreach($steps as $index => $step)
                    <x-feature-card :index="$index" :icon="$step['icon']" :title="$step['title']" :desc="$step['desc']"
                        iconVariant="secondary" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Talent Section -->
    <section class="py-32 bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <x-heading level="h2" title="Featured Talent" align="center"
                    class="text-white mb-6" />
                <p class="text-lg text-white/60 mx-auto max-w-2xl">Discover our handpicked performers</p>
            </div>

            @if($featuredTalents->count() >= 4)
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Card 1: Tall Left Card -->
                    <div
                        class="lg:col-span-5 lg:row-span-2 group relative overflow-hidden rounded-3xl aspect-4/5 lg:aspect-auto shadow-2xl reveal">
                        <img src="{{ $featuredTalents[0]->profile_photo_url }}" alt="{{ $featuredTalents[0]->name }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            loading="lazy" decoding="async">
                        <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 sm:p-8 w-full">
                            <h3 class="text-xl sm:text-2xl font-bold text-white mb-1">{{ $featuredTalents[0]->name }}</h3>
                            <p class="text-white/70 text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                                {{ $featuredTalents[0]->category->name }}
                            </p>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <x-button href="/talent/{{ $featuredTalents[0]->slug }}" variant="outline" size="sm"
                                    class="w-full sm:w-auto" aria-label="View profile of {{ $featuredTalents[0]->name }}">
                                    View Profile
                                </x-button>
                                <x-button href="/book?talent={{ $featuredTalents[0]->id }}" variant="primary" size="sm"
                                    class="w-full sm:w-auto">
                                    Book
                                </x-button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Wrapper -->
                    <div class="lg:col-span-7 grid grid-cols-2 gap-6">
                        <!-- Card 2: Wide Top Card -->
                        <div
                            class="col-span-2 group relative overflow-hidden rounded-3xl aspect-video lg:aspect-21/9 shadow-xl reveal reveal-delay-100">
                            <img src="{{ $featuredTalents[1]->profile_photo_url }}" alt="{{ $featuredTalents[1]->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6 sm:p-8 w-full">
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-1">{{ $featuredTalents[1]->name }}
                                </h3>
                                <p class="text-white/70 text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                                    {{ $featuredTalents[1]->category->name }}
                                </p>

                                <div class="flex flex-col sm:flex-row gap-3">
                                    <x-button href="/talent/{{ $featuredTalents[1]->slug }}" variant="outline" size="sm"
                                        class="w-full sm:w-auto"
                                        aria-label="View profile of {{ $featuredTalents[1]->name }}">
                                        View Profile
                                    </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[1]->id }}" variant="primary" size="sm"
                                        class="w-full sm:w-auto">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Square Bottom Left -->
                        <div
                            class="col-span-1 group relative overflow-hidden rounded-3xl aspect-square shadow-xl reveal reveal-delay-200">
                            <img src="{{ $featuredTalents[2]->profile_photo_url }}" alt="{{ $featuredTalents[2]->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-5 sm:p-6 w-full">
                                <h3 class="text-base sm:text-lg font-bold text-white mb-1">{{ $featuredTalents[2]->name }}
                                </h3>
                                <p class="text-white/70 text-[10px] sm:text-xs font-medium mb-3 sm:mb-4">
                                    {{ $featuredTalents[2]->category->name }}
                                </p>

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <x-button href="/talent/{{ $featuredTalents[2]->slug }}" variant="outline" size="sm"
                                        class="text-[10px] sm:text-xs py-2"
                                        aria-label="View profile of {{ $featuredTalents[2]->name }}">
                                        View Profile
                                    </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[2]->id }}" variant="primary" size="sm"
                                        class="text-[10px] sm:text-xs py-2">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Square Bottom Right -->
                        <div
                            class="col-span-1 group relative overflow-hidden rounded-3xl aspect-square shadow-xl reveal reveal-delay-300">
                            <img src="{{ $featuredTalents[3]->profile_photo_url }}" alt="{{ $featuredTalents[3]->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-5 sm:p-6 w-full">
                                <h3 class="text-base sm:text-lg font-bold text-white mb-1">{{ $featuredTalents[3]->name }}
                                </h3>
                                <p class="text-white/70 text-[10px] sm:text-xs font-medium mb-3 sm:mb-4">
                                    {{ $featuredTalents[3]->category->name }}
                                </p>

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <x-button href="/talent/{{ $featuredTalents[3]->slug }}" variant="outline" size="sm"
                                        class="text-[10px] sm:text-xs py-2"
                                        aria-label="View profile of {{ $featuredTalents[3]->name }}">
                                        View Profile </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[3]->id }}" variant="primary" size="sm"
                                        class="text-[10px] sm:text-xs py-2">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredTalents as $talent)
                        <div class="group relative overflow-hidden rounded-3xl aspect-square shadow-xl">
                            <img src="{{ $talent->profile_photo_url }}" alt="{{ $talent->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-5 w-full">
                                <h3 class="text-base sm:text-lg font-bold text-white mb-1">{{ $talent->name }}</h3>
                                <p class="text-white/70 text-[10px] sm:text-xs font-medium mb-3 sm:mb-4">
                                    {{ $talent->category->name }}
                                </p>
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <x-button href="/talent/{{ $talent->slug }}" variant="outline" size="sm"
                                        class="text-[10px] sm:text-xs py-2" aria-label="View profile of {{ $talent->name }}">
                                        View Profile </x-button>
                                    <x-button href="/book?talent={{ $talent->id }}" variant="primary" size="sm"
                                        class="text-[10px] sm:text-xs py-2">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-16 text-center">
                <x-button href="/talent" variant="outline" size="lg" wire:navigate>
                    Browse All Talent
                </x-button>
            </div>
        </div>
    </section>

    <!-- Browse by Category Section -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <x-heading level="h2" title="Browse by Category" align="center"
                    class="text-text-primary mb-6" />
                <p class="text-lg text-text-secondary mx-auto max-w-2xl">Find the perfect talent for your event</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $index => $category)
                    @php
                        $representativeTalent = $category->talents->first();
                        $bgImage = $representativeTalent ? $representativeTalent->profile_photo_url : $category->default_image;
                    @endphp
                    <a href="/talent?category={{ $category->slug }}" wire:navigate
                        class="group relative aspect-square rounded-3xl overflow-hidden shadow-lg reveal {{ $index % 4 === 1 ? 'reveal-delay-100' : ($index % 4 === 2 ? 'reveal-delay-200' : ($index % 4 === 3 ? 'reveal-delay-300' : '')) }}">
                        <img src="{{ $bgImage }}" alt="{{ $category->name }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            loading="lazy" decoding="async">

                        <div class="absolute inset-0 bg-black/48 group-hover:bg-black/40 transition-colors"></div>

                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                            <h3 class="text-2xl font-bold text-white">{{ $category->name }}</h3>
                            <p class="text-brand-primary font-bold text-sm mt-1">{{ $category->talents_count }} Artists</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Booking FAQs Section -->
    <section id="faqs" class="py-32 bg-surface-dark text-text-inverse">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-heading level="h2" title="Booking FAQs" align="center"
                class="text-center mb-16 reveal" />

            <div x-data="{ active: null }" class="space-y-6">


                @foreach($faqs as $index => $faq)
                    <div @click="active = (active === {{ $index }} ? null : {{ $index }})"
                        class="border-2 border-brand-primary px-4 rounded-xl reveal cursor-pointer {{ $index % 2 === 1 ? 'reveal-delay-100' : '' }}">
                        <button class="flex justify-between items-center w-full text-left py-8 focus:outline-none group transition-all"
                            aria-label="Toggle FAQ: {{ $faq->question }}"
                            :aria-expanded="active === {{ $index }} ? 'true' : 'false'">
                            <span
                                class="text-xl md:text-2xl font-bold group-hover:text-brand-primary transition-colors">{{ $faq->question }}</span>
                            <div class="h-8 w-8 rounded-full border border-subtle/30 flex items-center justify-center group-hover:border-brand-primary transition-colors"
                                :class="{ 'bg-brand-primary border-brand-primary': active === {{ $index }} }">
                                <x-lucide-chevron-down class="w-4 h-4 transform transition-transform duration-300"
                                    x-bind:class="{ 'rotate-180': active === {{ $index }}, 'text-text-inverse': active === {{ $index }} }"
                                    stroke-width="2" />
                            </div>
                        </button>
                        <div x-show="active === {{ $index }}" x-collapse x-cloak class="overflow-hidden">
                            <p class="pb-8 text-lg leading-relaxed max-w-3xl">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact / Inquiry Section -->
    <section class="py-20 md:py-32 bg-brand-accent relative overflow-hidden">
        {{-- Background Decorative Elements --}}
        <div class="absolute top-0 right-0 w-1/3 h-full bg-linear-to-l from-text-inverse/5 to-transparent"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-secondary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-text-inverse/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
                <div class="reveal">
                    <x-heading level="h2" title="Ready to Work Together?"
                        class="text-text-inverse mb-6 md:mb-8" />
                    <p class="text-lg md:text-xl text-text-inverse/80 mb-8 md:mb-12 leading-relaxed">
                        Let's create something unforgettable. Reach out to our dedicated agents for bespoke
                        recommendations
                        tailored to your vision.
                    </p>

                    <ul class="space-y-6 md:space-y-8 mb-10 md:mb-12">
                        <li class="flex items-center gap-4 md:gap-6">
                            <div
                                class="h-12 w-12 md:h-14 md:w-14 rounded-2xl bg-text-inverse/10 flex items-center justify-center text-text-inverse shrink-0 backdrop-blur-sm border border-subtle">
                                <x-lucide-mail class="w-5 h-5 md:w-6 md:h-6" stroke-width="2" />
                            </div>
                            <div>
                                <h3 class="text-text-inverse font-bold text-sm md:text-base">Send us a message</h3>
                                <p class="text-text-inverse/60 text-xs md:text-sm">
                                    <a href="mailto:info@hailerz.com" class="hover:text-white transition-colors">info@hailerz.com</a>
                                </p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 md:gap-6">
                            <div
                                class="h-12 w-12 md:h-14 md:w-14 rounded-2xl bg-text-inverse/10 flex items-center justify-center text-text-inverse shrink-0 backdrop-blur-sm border border-subtle">
                                <x-lucide-clock class="w-5 h-5 md:w-6 md:h-6" stroke-width="2" />
                            </div>
                            <div>
                                <h3 class="text-text-inverse font-bold text-sm md:text-base">Premium Support</h3>
                                <p class="text-text-inverse/60 text-xs md:text-sm">Our agents respond promptly to every
                                    inquiry.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <x-card padding="p-6 md:p-10"
                    class="backdrop-blur-xl shadow-2xl relative overflow-hidden reveal reveal-delay-200">
                    {{-- Subtle background decoration to break the flat white --}}
                    <div
                        class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-brand-primary/5 rounded-full blur-3xl pointer-events-none">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-brand-secondary/5 rounded-full blur-3xl pointer-events-none">
                    </div>

                    @if($contactSent)
                        <div class="relative z-10 flex flex-col items-center text-center py-8 md:py-12 gap-6">
                            <div
                                class="h-16 w-16 md:h-20 md:w-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                <x-lucide-check class="w-8 h-8 md:w-10 md:h-10" stroke-width="2" />
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-text-primary">Inquiry Received</h3>
                            <p class="text-text-secondary text-sm md:text-base">An agent will review your request and
                                contact you shortly.</p>
                            <button wire:click="$set('contactSent', false)"
                                class="text-brand-primary font-bold hover:underline text-sm">Submit another inquiry</button>
                        </div>
                    @else
                                    <form wire:submit="submitContact" class="relative z-10 space-y-4 md:space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                            <x-input wire:model="first_name" name="first_name" label="First Name *"
                                                placeholder="John" />
                                            <x-input wire:model="last_name" name="last_name" label="Last Name *" placeholder="Smith" />
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                            <x-input wire:model="email" name="email" type="email" label="Email Address *"
                                                placeholder="john@example.com" />
                                            <x-input wire:model="phone" name="phone" label="Phone Number"
                                                placeholder="(555) 123-4567" />
                                        </div>

                                        <x-select wire:model="subject" name="subject" label="Subject *" placeholder="Select a subject"
                                            :options="[
                            'General Inquiry' => 'General Inquiry',
                            'Booking Request' => 'Booking Request',
                            'Talent Representation' => 'Talent Representation',
                            'Partnerships' => 'Partnerships',
                            'Other' => 'Other'
                        ]" />

                                        <x-textarea wire:model="message" name="message" label="Message *" rows="4" md:rows="5"
                                            placeholder="Tell us how we can help you..." />

                                        <div class="pt-2 md:pt-4">
                                            <x-button type="submit" class="w-full shadow-lg shadow-brand-accent/20" size="lg"
                                                variant="primary" wire:loading.attr="disabled" wire:target="submitContact">
                                                <span wire:loading.remove wire:target="submitContact">Send Message</span>
                                                <span wire:loading wire:target="submitContact" class="flex items-center justify-center">
                                                    <x-lucide-loader-2 class="animate-spin h-5 w-5 text-white" stroke-width="2" />
                                                </span>
                                            </x-button>
                                            <p class="text-center text-[10px] md:text-xs text-text-inverse/60 mt-4 font-medium">
                                                We'll respond to your inquiry within 24 hours.
                                            </p>
                                        </div>
                                    </form>
                    @endif
                </x-card>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-linear-to-t from-black/20 to-transparent"></div>
    </section>
</div>