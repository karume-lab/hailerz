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
                alt="Hero background - Rays of light illuminating a stage">
            <div class="absolute inset-0 bg-black/70 bg-linear-to-b from-black/40 via-transparent to-black/60"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-8xl font-bold tracking-tight text-white mb-8 leading-tight ">
                <span class="text-brand-secondary">Book</span> Top Talent
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto font-medium leading-relaxed">
                Connect with premier musicians, bands, and performers for unforgettable events
            </p>

            <!-- Search Bar -->
            <form wire:submit="searchTalent" class="relative max-w-4xl mx-auto mb-10 group">
                <div
                    class="flex flex-col md:flex-row gap-3 p-2 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transition-all duration-500 hover:bg-white/15">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                            <x-lucide-search class="h-6 w-6 text-white/50 group-hover:text-white/80 transition-colors"
                                stroke-width="2.5" />
                        </div>
                        <input type="text" wire:model="search" placeholder="Search by name, genre, or location..."
                            class="w-full pl-14 pr-6 py-5 bg-transparent text-white placeholder-white/50 border-none focus:ring-0 focus:ring-offset-0 focus-visible:ring-0 text-xl font-medium outline-none">
                    </div>
                    <x-button type="submit" variant="primary" size="lg" class="px-10 py-5 active:scale-95 transform">
                        Find Talent
                    </x-button>
                </div>
            </form>

            <!-- Quick Links / Categories -->
            <div
                class="flex flex-wrap justify-center gap-x-8 gap-y-4 text-xs font-bold uppercase tracking-widest text-white">
                <a href="/talent?category=musicians" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Musicians</a>
                <a href="/talent?category=djs" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">DJs</a>
                <a href="/talent?category=speakers" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Speakers</a>
                <a href="/talent?category=dancers" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Dancers</a>
                <a href="/talent?category=artists" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Artists</a>
                <a href="/talent?category=poets" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Poets</a>
                <a href="/talent?category=content-creators" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Content Creators</a>
                <a href="/talent?category=comedians" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Comedians</a>
                <a href="/talent?category=mcs" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">MCs</a>
                <a href="/talent?category=variety-artists" wire:navigate
                    class="hover:text-brand-secondary transition-all hover:scale-105 transform">Variety Artists</a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 reveal">
                <h2 class="text-3xl md:text-5xl font-bold text-text-primary mb-6 ">Book Talent in <span
                        class="text-brand-secondary">Three Simple Steps</span></h2>
                <p class="text-lg text-text-secondary">Watch how Hailerz connects you with world-class talent.</p>

                <div
                    class="mt-12 aspect-video max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-subtle bg-surface-dark reveal reveal-delay-200">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/LLdr6BqljEw"
                        title="Hailerz - How it Works" frameborder="0" loading="lazy"
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
                    <x-card padding="p-10" hover
                        class="text-center reveal {{ $index === 1 ? 'reveal-delay-100' : ($index === 2 ? 'reveal-delay-200' : '') }}">
                        <div
                            class="h-16 w-16 mx-auto rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                            <x-dynamic-component :component="'lucide-' . $step['icon']" class="w-8 h-8" stroke-width="2" />
                        </div>
                        <h3 class="text-2xl font-bold text-text-primary mb-4">{{ $step['title'] }}</h3>
                        <p class="text-text-secondary leading-relaxed">{{ $step['desc'] }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Talent Section -->
    <section class="py-32 bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 reveal">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Featured Talent</h2>
                <p class="text-lg text-white/60">Discover our handpicked performers</p>
            </div>

            @if($featuredTalents->count() >= 4)
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Card 1: Tall Left Card -->
                    <div
                        class="lg:col-span-5 lg:row-span-2 group relative overflow-hidden rounded-3xl aspect-4/5 lg:aspect-auto shadow-2xl reveal">
                        <img src="{{ $featuredTalents[0]->profile_photo_url }}" alt="{{ $featuredTalents[0]->name }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 w-full">
                            <h3 class="text-2xl font-bold text-white mb-1">{{ $featuredTalents[0]->name }}</h3>
                            <p class="text-white/70 text-sm font-medium mb-6">{{ $featuredTalents[0]->category->name }}</p>

                            <div class="flex gap-3">
                                <x-button href="/talent/{{ $featuredTalents[0]->slug }}" variant="secondary" size="sm"
                                    class="rounded-lg">
                                    View Profile
                                </x-button>
                                <x-button href="/book?talent={{ $featuredTalents[0]->id }}" variant="primary" size="sm"
                                    class="rounded-lg">
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
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-8 w-full">
                                <h3 class="text-xl font-bold text-white mb-1">{{ $featuredTalents[1]->name }}</h3>
                                <p class="text-white/70 text-sm font-medium mb-4">{{ $featuredTalents[1]->category->name }}
                                </p>

                                <div class="flex gap-3">
                                    <x-button href="/talent/{{ $featuredTalents[1]->slug }}" variant="secondary" size="sm"
                                        class="rounded-lg">
                                        View Profile
                                    </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[1]->id }}" variant="primary" size="sm"
                                        class="rounded-lg">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Square Bottom Left -->
                        <div
                            class="col-span-1 group relative overflow-hidden rounded-3xl aspect-square shadow-xl reveal reveal-delay-200">
                            <img src="{{ $featuredTalents[2]->profile_photo_url }}" alt="{{ $featuredTalents[2]->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6 w-full">
                                <h3 class="text-lg font-bold text-white mb-1">{{ $featuredTalents[2]->name }}</h3>
                                <p class="text-white/70 text-xs font-medium mb-4">{{ $featuredTalents[2]->category->name }}
                                </p>

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <x-button href="/talent/{{ $featuredTalents[2]->slug }}" variant="secondary" size="sm"
                                        class="rounded-lg px-3!">
                                        View Profile
                                    </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[2]->id }}" variant="primary" size="sm"
                                        class="rounded-lg px-3!">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Square Bottom Right -->
                        <div
                            class="col-span-1 group relative overflow-hidden rounded-3xl aspect-square shadow-xl reveal reveal-delay-300">
                            <img src="{{ $featuredTalents[3]->profile_photo_url }}" alt="{{ $featuredTalents[3]->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6 w-full">
                                <h3 class="text-lg font-bold text-white mb-1">{{ $featuredTalents[3]->name }}</h3>
                                <p class="text-white/70 text-xs font-medium mb-4">{{ $featuredTalents[3]->category->name }}
                                </p>

                                <div class="flex flex-col sm:flex-row gap-2">
                                    <x-button href="/talent/{{ $featuredTalents[3]->slug }}" variant="secondary" size="sm"
                                        class="rounded-lg px-3!">
                                        View Profile </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[3]->id }}" variant="primary" size="sm"
                                        class="rounded-lg px-3!">
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
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6 w-full">
                                <h3 class="text-lg font-bold text-white mb-1">{{ $talent->name }}</h3>
                                <p class="text-white/70 text-xs font-medium mb-4">{{ $talent->category->name }}</p>
                                <div class="flex gap-2">
                                    <x-button href="/talent/{{ $talent->slug }}" variant="secondary" size="sm"
                                        class="rounded-lg">
                                        View Profile </x-button>
                                    <x-button href="/book?talent={{ $talent->id }}" variant="primary" size="sm"
                                        class="rounded-lg">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-16 text-center">
                <a href="/talent" wire:navigate
                    class="inline-block px-8 py-3 border border-brand-secondary text-brand-secondary hover:bg-brand-secondary hover:text-white transition-all rounded-lg font-bold">
                    Browse All Talent
                </a>
            </div>
        </div>
    </section>

    <!-- Browse by Category Section -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 reveal">
                <h2 class="text-4xl md:text-5xl font-bold text-text-primary mb-6">Browse by Category</h2>
                <p class="text-lg text-text-secondary">Find the perfect talent for your event</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $index => $category)
                    @php
                        $representativeTalent = $category->talents->first();
                        $bgImage = $representativeTalent ? $representativeTalent->profile_photo_url : $category->default_image;
                    @endphp
                    <a href="/talent?category={{ $category->slug }}" wire:navigate
                        class="group relative aspect-square rounded-3xl overflow-hidden shadow-lg reveal {{ $index % 4 === 1 ? 'reveal-delay-100' : ($index % 4 === 2 ? 'reveal-delay-200' : ($index % 4 === 3 ? 'reveal-delay-300' : '')) }}">
                        {{-- Use a representative talent image or default mapping --}}
                        <img src="{{ $bgImage }}" alt="{{ $category->name }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors"></div>

                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                            <h3 class="text-2xl font-bold text-white">{{ $category->name }}</h3>
                            <p class="text-white/80 text-sm mt-1">{{ $category->talents_count }} Artists</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Booking FAQs Section -->
    <section class="py-32 bg-surface-dark text-text-inverse">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-center mb-16  reveal">Booking <span
                    class="text-brand-secondary">FAQs</span></h2>

            <div x-data="{ active: 0 }" class="space-y-4">


                @foreach($faqs as $index => $faq)
                    <div class="border-b border-subtle/20 reveal {{ $index % 2 === 1 ? 'reveal-delay-100' : '' }}">
                        <button @click="active = (active === {{ $index }} ? null : {{ $index }})"
                            class="flex justify-between items-center w-full text-left py-8 focus:outline-none group transition-all"
                            aria-label="Toggle FAQ: {{ $faq->question }}"
                            :aria-expanded="active === {{ $index }} ? 'true' : 'false'">
                            <span
                                class="text-xl md:text-2xl font-bold group-hover:text-brand-secondary transition-colors">{{ $faq->question }}</span>
                            <div class="h-8 w-8 rounded-full border border-subtle/30 flex items-center justify-center group-hover:border-brand-secondary transition-colors"
                                :class="{ 'bg-brand-secondary border-brand-secondary': active === {{ $index }} }">
                                <x-lucide-chevron-down class="w-4 h-4 transform transition-transform duration-300"
                                    x-bind:class="{ 'rotate-180': active === {{ $index }}, 'text-text-inverse': active === {{ $index }} }"
                                    stroke-width="2" />
                            </div>
                        </button>
                        <div x-show="active === {{ $index }}" x-collapse x-cloak class="overflow-hidden">
                            <p class="pb-8 text-lg text-text-muted leading-relaxed max-w-3xl">{{ $faq->answer }}</p>
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
                <div class="reveal">
                    <h2 class="text-3xl md:text-6xl font-bold text-text-inverse mb-8  leading-tight">Ready to
                        <span class="text-brand-secondary">Work Together?</span>
                    </h2>
                    <p class="text-xl text-text-inverse/80 mb-12 leading-relaxed">
                        Let’s create something unforgettable. Reach out to our dedicated agents for bespoke
                        recommendations
                        tailored to your vision.
                    </p>

                    <ul class="space-y-8 mb-12">
                        <li class="flex items-center gap-6">
                            <div
                                class="h-14 w-14 rounded-2xl bg-text-inverse/10 flex items-center justify-center text-text-inverse shrink-0 backdrop-blur-sm border border-subtle">
                                <x-lucide-mail class="w-6 h-6" stroke-width="2" />
                            </div>
                            <div>
                                <h3 class="text-text-inverse font-bold">Send us a message</h3>
                                <p class="text-text-inverse/60 text-sm">bookings@hailerz.com</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-6">
                            <div
                                class="h-14 w-14 rounded-2xl bg-text-inverse/10 flex items-center justify-center text-text-inverse shrink-0 backdrop-blur-sm border border-subtle">
                                <x-lucide-clock class="w-6 h-6" stroke-width="2" />
                            </div>
                            <div>
                                <h3 class="text-text-inverse font-bold">Premium Support</h3>
                                <p class="text-text-inverse/60 text-sm">Our agents respond promptly to every inquiry.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <x-card padding="p-10"
                    class="backdrop-blur-xl shadow-2xl relative overflow-hidden reveal reveal-delay-200">
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
                                <x-lucide-check class="w-10 h-10" stroke-width="2" />
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
                                <x-input wire:model="contactName" name="contactName" label="Name" placeholder="Full Name" />
                                <x-input wire:model="contactEmail" name="contactEmail" type="email" label="Email"
                                    placeholder="Email Address" />
                            </div>
                            <x-textarea wire:model="contactMessage" name="contactMessage" label="Message" rows="5"
                                placeholder="Tell us about your event vision and the type of talent you're looking for..." />
                            <x-button type="submit" class="w-full shadow-lg shadow-brand-primary/20" size="lg"
                                variant="secondary" wire:loading.attr="disabled" wire:target="submitContact">
                                <span wire:loading.remove wire:target="submitContact">Send Message</span>
                                <span wire:loading wire:target="submitContact" class="flex items-center justify-center">
                                    <x-lucide-loader-2 class="animate-spin h-5 w-5 text-white" stroke-width="2" />
                                </span>
                            </x-button>
                        </form>
                    @endif
                </x-card>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full h-1/2 bg-linear-to-t from-black/20 to-transparent"></div>
    </section>
</div>