<div class="bg-canvas">
    <!-- Hero Section -->
    <section class="relative bg-white pt-24 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                <!-- Left Content -->
                <div class="mb-16 lg:mb-0">
                    <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-dark mb-8 leading-tight">
                        Connect with your<br />
                        Favourite Celebrities
                    </h1>
                    <p class="mt-4 max-w-xl text-lg text-gray-500 mb-10 leading-relaxed">
                        The easiest way to get personalized video greetings, shoutouts, and pleasantries from top
                        entertainers and public figures.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#how-it-works"
                            class="px-8 py-3.5 border border-gray-300 text-base font-semibold rounded-md text-dark bg-white hover:bg-gray-50 transition-all focus:outline-none flex items-center gap-2">
                            How it works
                        </a>
                        <a href="/talent" wire:navigate
                            class="px-8 py-3.5 border border-transparent text-base font-semibold rounded-md text-white bg-primary hover:bg-primary-dark shadow-sm transition-all focus:outline-none flex items-center gap-2">
                            Discover Talent <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Video Cards -->
                <div class="relative flex justify-center lg:justify-end gap-6 h-[500px]">
                    <!-- Video Card 1 -->
                    <div
                        class="w-56 h-[460px] rounded-[32px] border-2 border-primary/20 relative overflow-hidden group">
                        <img src="{{ asset('images/assets/hero-card-1.webp') }}" alt="Talent Preview"
                            class="absolute inset-0 w-full h-full object-cover grayscale">
                        <div
                            class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color">
                        </div>
                    </div>
                    <!-- Video Card 2 (Offset) -->
                    <div
                        class="w-56 h-[460px] rounded-[32px] border-2 border-primary/20 relative overflow-hidden group mt-12">
                        <img src="{{ asset('images/assets/hero-card-2.webp') }}" alt="Talent Preview"
                            class="absolute inset-0 w-full h-full object-cover grayscale">
                        <div
                            class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Headline Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-primary">Access top African talents</h2>
        </div>
    </section>

    <!-- Trusted By / Social Proof -->
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm font-semibold uppercase text-gray-500 tracking-wide mb-8">Trusted by Top Event
                Producers & Brands</p>
            <div
                class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <svg class="h-8 text-gray-900" viewBox="0 0 100 30" fill="currentColor">
                    <path
                        d="M10,25 h15 v-20 h-15 z M35,25 h15 v-20 h-15 z M60,25 h15 v-20 h-15 z M85,25 h15 v-20 h-20" />
                </svg>
                <svg class="h-8 text-gray-900" viewBox="0 0 100 30" fill="currentColor">
                    <circle cx="15" cy="15" r="10" />
                    <rect x="35" y="5" width="20" height="20" />
                    <polygon points="75,5 95,5 85,25" />
                </svg>
                <svg class="h-8 text-gray-900" viewBox="0 0 100 30" fill="currentColor">
                    <path d="M5,15 Q25,5 45,15 T85,15" />
                </svg>
                <svg class="h-8 text-gray-900 hidden sm:block" viewBox="0 0 100 30" fill="currentColor">
                    <rect x="10" y="5" width="80" height="20" rx="10" />
                </svg>
            </div>
        </div>
    </section>

    <!-- Categories Quick Browse -->
    <section class="py-20 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-dark-muted">Explore by Category</h2>
                <p class="mt-4 text-lg text-gray-600">Find exactly the right personality for your special video
                    shoutout.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category Card -->
                <a href="/talent?category=musicians"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/assets/musicians.webp') }}" alt="Live Musicians"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-80 mix-blend-color">
                    </div>
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-40 mix-blend-multiply">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">Live Bands</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=speakers"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/assets/speakers.webp') }}" alt="Keynote Speakers"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-80 mix-blend-color">
                    </div>
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-40 mix-blend-multiply">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">Keynote Speakers</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=djs"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/assets/djs.webp') }}" alt="DJs & Electronics"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-80 mix-blend-color">
                    </div>
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-40 mix-blend-multiply">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">DJs & Electronics</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=specialty"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/assets/specialty.webp') }}" alt="Specialty Acts"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-80 mix-blend-color">
                    </div>
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary to-primary opacity-40 mix-blend-multiply">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">Specialty</h3>
                    </div>
                </a>
            </div>

            <div class="mt-12 text-center">
                <a href="/talent" wire:navigate
                    class="inline-flex items-center text-primary font-bold hover:text-primary-dark transition">
                    View Entire Roster <svg class="w-5 h-5 ml-2 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="how-it-works" class="py-20 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Seamless Video Pleasantries</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div class="flex flex-col items-center p-4">
                    <div
                        class="h-12 w-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Favourite Celebrities</h3>
                    <p class="mt-2 text-sm text-gray-500">Access our exclusive roster of digital natives, influencers,
                        and world-class entertainers.</p>
                </div>
                <div class="flex flex-col items-center p-4">
                    <div
                        class="h-12 w-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Easy Booking</h3>
                    <p class="mt-2 text-sm text-gray-500">Pick a celebrity, record your gesture details, and get a
                        magical video to share.</p>
                </div>
                <div class="flex flex-col items-center p-4">
                    <div
                        class="h-12 w-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Smart Sharing</h3>
                    <p class="mt-2 text-sm text-gray-500">Share your custom videos seamlessly across social platforms
                        and spread the love.</p>
                </div>
            </div>
        </div>
    </section>
</div>