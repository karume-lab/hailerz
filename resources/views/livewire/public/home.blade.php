<div class="bg-canvas">
    <!-- Hero Section -->
    <section class="relative bg-surface pt-24 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                <!-- Left Content -->
                <div class="mb-16 lg:mb-0">
                    <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-text-main mb-8 leading-tight">
                        Connect with your<br />
                        Favourite Celebrities
                    </h1>
                    <p class="mt-4 max-w-xl text-lg text-text-muted mb-10 leading-relaxed">
                        The easiest way to get personalized video greetings, shoutouts, and pleasantries from top
                        entertainers and public figures.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-10">
                        <a href="/talent" wire:navigate
                            class="px-8 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all flex items-center gap-3 group">
                            <svg class="w-5 h-5 text-secondary group-hover:scale-110 transition-transform" fill="none"
                                stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse Talent
                        </a>
                        <a href="/join" wire:navigate
                            class="px-8 py-4 bg-white dark:bg-dark-muted text-primary border-2 border-primary/20 font-bold rounded-xl hover:border-primary transition-all flex items-center gap-3">
                            Join the Roster
                        </a>
                    </div>
                </div>

                <!-- Right Video Cards -->
                <div class="relative flex justify-center lg:justify-end gap-6 h-[500px]">
                    <!-- Video Card 1 -->
                    <div
                        class="w-56 h-[460px] rounded-[32px] border-2 border-primary/20 relative overflow-hidden group">
                        <img src="{{ asset('images/home/hero-card-1.webp') }}" alt="Talent Preview"
                            class="absolute inset-0 w-full h-full object-cover grayscale">
                        <div
                            class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color">
                        </div>
                    </div>
                    <!-- Video Card 2 (Offset) -->
                    <div
                        class="w-56 h-[460px] rounded-[32px] border-2 border-primary/20 relative overflow-hidden group mt-12">
                        <img src="{{ asset('images/home/hero-card-2.webp') }}" alt="Talent Preview"
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
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-primary">Access top talents</h2>
        </div>
    </section>

    <!-- Categories Quick Browse -->
    <section class="py-20 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-text-main">Explore by Category</h2>
                <p class="mt-4 text-lg text-text-muted">Find exactly the right personality for your special video
                    shoutout.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category Card -->
                <a href="/talent?category=musicians"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/home/musicians.webp') }}" alt="Live Musicians"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">Live Bands</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=speakers"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/home/speakers.webp') }}" alt="Keynote Speakers"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">Keynote Speakers</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=djs"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/home/djs.webp') }}" alt="DJs & Electronics"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">DJs & Electronics</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=specialty"
                    class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="{{ asset('images/home/specialty.webp') }}" alt="Specialty Acts"
                        class="absolute inset-0 w-full h-full object-cover grayscale group-hover:scale-110 transition-transform duration-700">
                    <div
                        class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color">
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-dark/90 via-dark/10 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <h3 class="text-2xl font-bold text-white relative z-10">Specialty</h3>
                    </div>
                </a>
            </div>

            <div class="mt-24 text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-text-main">Browse by Event</h2>
                <p class="mt-4 text-lg text-text-muted">Tailored talent for every occasion.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @php
                    $events = [
                        ['name' => 'Weddings', 'icon' => 'M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'],
                        ['name' => 'Corporate Galas', 'icon' => 'M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z'],
                        ['name' => 'Birthdays', 'icon' => 'M12 2l1.5 5 5 .5-3.5 3.5 1 5-4-2.5-4 2.5 1-5-3.5-3.5 5-.5L12 2z'],
                        ['name' => 'Festivals', 'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z'],
                        ['name' => 'Private Parties', 'icon' => 'M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'],
                        ['name' => 'Religious Events', 'icon' => 'M19 13h-6V7h-2v6H5v2h6v6h2v-6h6z']
                    ];
                @endphp

                @foreach($events as $event)
                    <a href="/talent?event={{ strtolower(str_replace(' ', '_', $event['name'])) }}"
                        class="flex flex-col items-center justify-center p-6 bg-surface border border-border rounded-2xl hover:border-primary hover:shadow-md transition-all group">
                        <div
                            class="h-12 w-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $event['icon'] }}"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-text-main text-center">{{ $event['name'] }}</span>
                    </a>
                @endforeach
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
    <section id="how-it-works" class="py-20 bg-surface border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-text-main">Seamless Video Pleasantries</h2>
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
                    <h3 class="text-lg font-bold text-text-main">Favourite Celebrities</h3>
                    <p class="mt-2 text-sm text-text-muted">Access our exclusive roster of digital natives, influencers,
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
                    <h3 class="text-lg font-bold text-text-main">Easy Booking</h3>
                    <p class="mt-2 text-sm text-text-muted">Pick a celebrity, record your gesture details, and get a
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
                    <h3 class="text-lg font-bold text-text-main">Smart Sharing</h3>
                    <p class="mt-2 text-sm text-text-muted">Share your custom videos seamlessly across social platforms
                        and spread the love.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-start">

                <!-- Left: Info -->
                <div class="mb-12 lg:mb-0">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-text-main mb-6">Get in Touch</h2>
                    <p class="text-lg text-text-muted leading-relaxed mb-8">
                        Whether you're planning a corporate event, a private celebration, or need advice on the perfect talent — our team is here to help. Drop us a message and we'll get back to you within 24 hours.
                    </p>

                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="h-11 w-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-text-main">Email Us</p>
                                <a href="mailto:info@hailerz.com" class="text-primary hover:underline text-sm">info@hailerz.com</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="h-11 w-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-text-main">Response Time</p>
                                <p class="text-text-muted text-sm">We aim to reply within 24 hours on business days.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="h-11 w-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-text-main">Our Base</p>
                                <p class="text-text-muted text-sm">Nairobi, Kenya — serving clients globally.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Right: Form -->
                <div class="bg-surface border border-border rounded-3xl p-8 shadow-sm">
                    @if($contactSent)
                        <div class="flex flex-col items-center text-center py-10 gap-4">
                            <div class="h-16 w-16 rounded-full bg-green-500/10 text-green-400 flex items-center justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-text-main">Message Sent!</h3>
                            <p class="text-text-muted">Thank you for reaching out. We'll be in touch shortly.</p>
                            <button wire:click="$set('contactSent', false)" class="mt-4 text-sm font-semibold text-primary hover:underline">Send another message</button>
                        </div>
                    @else
                        <form wire:submit="submitContact" class="space-y-5">
                            <div>
                                <label for="home-contact-name" class="block text-sm font-semibold text-text-main mb-1.5">Your Name</label>
                                <input wire:model="contactName" id="home-contact-name" type="text" placeholder="Jane Muthoni"
                                    class="w-full rounded-xl px-4 py-3 bg-canvas border border-border text-text-main placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-sm">
                                @error('contactName') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="home-contact-email" class="block text-sm font-semibold text-text-main mb-1.5">Email Address</label>
                                <input wire:model="contactEmail" id="home-contact-email" type="email" placeholder="jane@example.com"
                                    class="w-full rounded-xl px-4 py-3 bg-canvas border border-border text-text-main placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-sm">
                                @error('contactEmail') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="home-contact-message" class="block text-sm font-semibold text-text-main mb-1.5">Message</label>
                                <textarea wire:model="contactMessage" id="home-contact-message" rows="5" placeholder="Tell us about your event or inquiry..."
                                    class="w-full rounded-xl px-4 py-3 bg-canvas border border-border text-text-main placeholder-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-sm resize-none"></textarea>
                                @error('contactMessage') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit"
                                class="w-full py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 group">
                                <span>Send Message</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                                </svg>
                                <div wire:loading wire:target="submitContact" class="ml-1">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                    </svg>
                                </div>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>