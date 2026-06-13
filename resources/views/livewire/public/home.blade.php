@push('head')
    {{-- Preload hero background image --}}
    <link rel="preload" as="image" href="{{ asset('images/home/hero-bg.webp') }}" fetchpriority="high">
@endpush

<div class="bg-surface-light">
    <x-marketplace.hero :allCategories="$allCategories" />

    <!-- How It Works -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <x-heading level="h2" title="Join Our" highlight="Talent Pool" align="center"
                    class="text-text-primary" />
                <p class="text-lg text-text-secondary mx-auto max-w-2xl">Get Seen. Get featured.</p>

                <div x-data="{ play: false }"
                    class="mt-12 aspect-video max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-subtle bg-surface-dark reveal reveal-delay-200 relative group cursor-pointer">

                    <template x-if="play">
                        <iframe class="w-full h-full"
                            src="https://www.youtube.com/embed/LLdr6BqljEw?autoplay=1&mute=1&rel=0"
                            title="Hailerz - How it Works" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </template>

                    <template x-if="!play">
                        <div @click="play = true"
                            class="absolute inset-0 w-full h-full flex items-center justify-center">
                            <!-- Background Poster Image (YouTube MaxRes Default Thumbnail) -->
                            <img src="https://i.ytimg.com/vi/LLdr6BqljEw/maxresdefault.jpg"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="Hailerz - How it Works video preview" loading="lazy" decoding="async">

                            <!-- Overlay gradient -->
                            <div
                                class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors duration-300">
                            </div>

                            <!-- Centered premium play button with pulse effect -->
                            <div class="absolute flex items-center justify-center">
                                <div
                                    class="absolute w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-brand-primary/30 animate-ping pointer-events-none">
                                </div>
                                <div class="relative z-10 w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-brand-primary/95 text-white flex items-center justify-center shadow-[0_10px_40px_rgba(27,129,155,0.5)] transition-all duration-300 group-hover:scale-110 group-hover:bg-brand-primary active:scale-95"
                                    role="button" aria-label="Play video">
                                    <x-lucide-play
                                        class="w-8 h-8 sm:w-10 sm:h-10 translate-x-0.5 text-white fill-current" />
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Creation Subscription Ecosystem -->
    <section class="py-32 bg-surface-light relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 reveal">
                <x-heading level="h2" title="Creator" highlight="Ecosystem" align="center"
                    highlightClass="text-brand-secondary" class="text-text-primary mb-6" />
                <p class="text-lg text-text-secondary mx-auto max-w-3xl">
                    Elevate your platform presence with our content engineering subscriptions. From automated basics to
                    full-scale custom deliverables.
                </p>
            </div>

            <!-- 3 Tier Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
                <!-- Tier 1: Starter Content Basic -->
                <x-card padding="p-8 md:p-10" bg="muted" class="flex flex-col h-full reveal reveal-delay-100">
                    <h3 class="text-2xl font-bold text-text-primary mb-3">Starter Content Basic</h3>
                    <p class="text-text-secondary text-sm mb-6">Automated, generic generated content built directly from
                        your profile tags, skill preferences, and regional settings to keep your channels continuously
                        active.</p>

                    <div class="mt-auto flex flex-col">
                        <div class="mb-8">
                            <span
                                class="text-4xl font-extrabold text-text-primary">{{ \App\Helpers\CurrencyHelper::format(19) }}</span>
                            <span class="text-text-muted text-sm">/month</span>
                        </div>

                        <div class="bg-surface-light rounded-2xl p-4 border border-subtle">
                            <div class="flex items-center gap-3">
                                <x-lucide-ticket class="w-6 h-6 text-text-muted" />
                                <div class="text-left">
                                    <span class="block text-sm font-bold text-text-primary">0 Premium Content
                                        Requests</span>
                                    <span class="block text-xs text-text-muted">Base content only</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>

                <!-- Tier 2: Professional Creator (Highlight) -->
                <x-card padding="p-8 md:p-10" bg="muted"
                    class="flex flex-col h-full reveal reveal-delay-200 border-2 border-brand-primary/50 shadow-lg relative overflow-visible">
                    <div class="absolute -top-4 inset-x-0 flex justify-center">
                        <span
                            class="bg-brand-primary text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider shadow-md">Most
                            Popular</span>
                    </div>

                    <h3 class="text-2xl font-bold text-text-primary mb-3 mt-2">Professional Creator</h3>
                    <p class="text-text-secondary text-sm mb-6">Managed custom creative deliverables curated to your
                        specific platform brand guidelines. Includes active access to our priority processing desk.</p>

                    <div class="mt-auto flex flex-col">
                        <div class="mb-8">
                            <span
                                class="text-4xl font-extrabold text-brand-primary">{{ \App\Helpers\CurrencyHelper::format(89) }}</span>
                            <span class="text-text-muted text-sm">/month</span>
                        </div>

                        <div class="bg-brand-primary/5 rounded-2xl p-4 border border-brand-primary/20">
                            <div class="flex items-center gap-3">
                                <x-lucide-ticket class="w-6 h-6 text-brand-primary" />
                                <div class="text-left">
                                    <span class="block text-sm font-bold text-brand-primary">5 Premium Content
                                        Requests</span>
                                    <span class="block text-xs text-text-muted">Per month included</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>

                <!-- Tier 3: Enterprise Scale -->
                <x-card padding="p-8 md:p-10" bg="muted" class="flex flex-col h-full reveal reveal-delay-300">
                    <h3 class="text-2xl font-bold text-text-primary mb-3">Enterprise Scale</h3>
                    <p class="text-text-secondary text-sm mb-6">High-density, multi-channel asset compilation. Dedicated
                        rapid turnaround execution for heavy content schedules.</p>

                    <div class="mt-auto flex flex-col">
                        <div class="mb-8">
                            <span
                                class="text-4xl font-extrabold text-text-primary">{{ \App\Helpers\CurrencyHelper::format(249) }}</span>
                            <span class="text-text-muted text-sm">/month</span>
                        </div>

                        <div class="bg-surface-light rounded-2xl p-4 border border-subtle">
                            <div class="flex items-center gap-3">
                                <x-lucide-ticket class="w-6 h-6 text-brand-secondary" />
                                <div class="text-left">
                                    <span class="block text-sm font-bold text-text-primary">15 Premium Content
                                        Requests</span>
                                    <span class="block text-xs text-text-muted">Per month included</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

            <!-- One-Off Content Request Add-on -->
            <x-card padding="p-8 sm:p-10" bg="muted" class="max-w-4xl mx-auto border-subtle reveal reveal-delay-400">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-1 text-center md:text-left">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-brand-primary/10 text-brand-primary mb-4 md:mb-0 md:mr-6 md:float-left">
                            <x-lucide-ticket class="w-6 h-6" />
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-text-primary mb-2">Need a One-Off Content Request?</h4>
                            <p class="text-text-secondary text-sm">Not ready for a subscription? Purchase a single,
                                on-demand premium content service request anytime.</p>
                        </div>
                    </div>
                    <span
                        class="text-2xl font-bold text-text-primary mb-3">{{ \App\Helpers\CurrencyHelper::format(25) }}
                        <span class="text-sm font-normal text-text-muted">/request</span></span>
                </div>
            </x-card>

        </div>
    </section>

    <!-- Booking Steps -->
    <x-marketplace.booking-steps />

    <!-- Featured Talent Section -->
    <section class="py-32 bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <x-heading level="h2" title="Featured" highlight="Talent" align="center" highlightClass="text-[#65c4af]"
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
                                <x-button href="/talent-hub/talent/{{ $featuredTalents[0]->slug }}" variant="secondary"
                                    size="sm" class="w-full sm:w-auto"
                                    aria-label="View profile of {{ $featuredTalents[0]->name }}">
                                    View Profile
                                </x-button>
                                <x-button href="/book?talent={{ $featuredTalents[0]->id }}" variant="primary" size="sm"
                                    class="w-full sm:w-auto" aria-label="Book {{ $featuredTalents[0]->name }}">
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
                                    <x-button href="/talent-hub/talent/{{ $featuredTalents[1]->slug }}" variant="secondary"
                                        size="sm" class="w-full sm:w-auto"
                                        aria-label="View profile of {{ $featuredTalents[1]->name }}">
                                        View Profile
                                    </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[1]->id }}" variant="primary" size="sm"
                                        class="w-full sm:w-auto" aria-label="Book {{ $featuredTalents[1]->name }}">
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
                                    <x-button href="/talent-hub/talent/{{ $featuredTalents[2]->slug }}" variant="secondary"
                                        size="sm" class="text-[10px] sm:text-xs py-2"
                                        aria-label="View profile of {{ $featuredTalents[2]->name }}">
                                        View Profile
                                    </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[2]->id }}" variant="primary" size="sm"
                                        class="text-[10px] sm:text-xs py-2"
                                        aria-label="Book {{ $featuredTalents[2]->name }}">
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
                                    <x-button href="/talent-hub/talent/{{ $featuredTalents[3]->slug }}" variant="secondary"
                                        size="sm" class="text-[10px] sm:text-xs py-2"
                                        aria-label="View profile of {{ $featuredTalents[3]->name }}">
                                        View Profile </x-button>
                                    <x-button href="/book?talent={{ $featuredTalents[3]->id }}" variant="primary" size="sm"
                                        class="text-[10px] sm:text-xs py-2"
                                        aria-label="Book {{ $featuredTalents[3]->name }}">
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
                                    <x-button href="/talent-hub/talent/{{ $talent->slug }}" variant="secondary" size="sm"
                                        class="text-[10px] sm:text-xs py-2" aria-label="View profile of {{ $talent->name }}">
                                        View Profile </x-button>
                                    <x-button href="/book?talent={{ $talent->id }}" variant="primary" size="sm"
                                        class="text-[10px] sm:text-xs py-2" aria-label="Book {{ $talent->name }}">
                                        Book
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-16 text-center">
                <x-button href="/talent-hub/browse" variant="secondary" size="lg" wire:navigate>
                    Browse All Talent
                </x-button>
            </div>
        </div>
    </section>

    <!-- Browse by Category Section -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 reveal">
                <x-heading level="h2" title="Browse by" highlight="Category" align="center"
                    class="text-text-primary mb-6" />
                <p class="text-lg text-text-secondary mx-auto max-w-2xl">Find the perfect talent for your event</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $index => $category)
                    @php
                        $representativeTalent = $category->talents->first();
                        $bgImage = $representativeTalent ? $representativeTalent->profile_photo_url : $category->default_image;
                    @endphp
                    <a href="/talent-hub/browse?category={{ $category->slug }}" wire:navigate
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
            <x-heading level="h2" title="Booking" highlight="FAQs" align="center" highlightClass="text-[#65c4af]"
                class="text-center mb-16 reveal" />

            <div x-data="{ active: null }" class="space-y-6">


                @foreach($faqs as $index => $faq)
                    <div @click="active = (active === {{ $index }} ? null : {{ $index }})"
                        class="border-2 border-brand-primary px-4 rounded-xl reveal cursor-pointer {{ $index % 2 === 1 ? 'reveal-delay-100' : '' }}">
                        <button
                            class="flex justify-between items-center w-full text-left py-8 focus:outline-none group transition-all"
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
                    <x-heading level="h2" title="Ready to Work" highlight="Together?" highlightClass="text-[#65c4af]"
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
                                    <a href="mailto:info@hailerz.com"
                                        class="hover:text-white transition-colors">info@hailerz.com</a>
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
                                                We'll respond to your inquiry within {{ config('hailerz.response_time') }}.
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