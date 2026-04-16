<div class="bg-canvas min-h-screen">
    <!-- Hero Section -->
    <section class="relative bg-surface py-24 lg:py-32 overflow-hidden border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold text-text-main tracking-tight mb-6">Our Services</h1>
            <p class="text-xl md:text-2xl text-text-muted max-w-3xl mx-auto leading-relaxed">
                Comprehensive talent booking and event entertainment solutions tailored to your needs.
            </p>
        </div>
        <!-- Abstract gradient background for premium feel -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[600px] h-[600px] bg-primary/20 rounded-full blur-[120px] opacity-30"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[100px] opacity-20"></div>
    </section>

    <!-- Talent Categories -->
    <section class="py-24 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold text-text-main mb-4">Talent Categories</h2>
                <p class="text-text-muted text-lg">World-class performers across every category and genre</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Musicians -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Musicians</h3>
                    <p class="text-text-muted mb-6 text-sm">Solo instrumentalists and vocalists across all genres - from classical pianists to contemporary guitarists.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Jazz', 'Classical', 'Pop', 'Rock', 'Country', 'R&B'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Weddings, Corporate Dinners, Private Parties</p>
                    </div>
                </div>

                <!-- Variety Artists -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Variety Artists</h3>
                    <p class="text-text-muted mb-6 text-sm">Full ensembles and variety acts that bring energy and diversity to any event.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Rock', 'Jazz', 'Cover Bands', 'Indie', 'Blues', 'Folk'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Weddings, Festivals, Corporate Events</p>
                    </div>
                </div>

                <!-- DJs -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">DJs</h3>
                    <p class="text-text-muted mb-6 text-sm">Professional DJs who read the room and keep the energy high with curated playlists.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['EDM', 'Hip Hop', 'House', 'Top 40', 'Latin', 'Throwback'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Clubs, Parties, Weddings, Corporate Events</p>
                    </div>
                </div>

                <!-- Speakers -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Speakers</h3>
                    <p class="text-text-muted mb-6 text-sm">Keynote speakers and industry experts who inspire and educate audiences.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Business', 'Tech', 'Motivation', 'Entertainment', 'Education'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Conferences, Corporate Events, Fundraisers</p>
                    </div>
                </div>

                <!-- Dancers -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Dancers</h3>
                    <p class="text-text-muted mb-6 text-sm">Professional dancers specializing in contemporary, traditional, and Afrobeat performances.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Contemporary', 'Afrobeat', 'Traditional', 'Hip Hop', 'Ballet'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Weddings, Cultural Events, Corporate Shows</p>
                    </div>
                </div>

                <!-- Artists -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Artists</h3>
                    <p class="text-text-muted mb-6 text-sm">Live painters and visual artists who create stunning artwork during your event.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Live Painting', 'Portrait Art', 'Abstract', 'Graffiti', 'Digital Art'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Corporate Events, Exhibitions, Private Parties</p>
                    </div>
                </div>

                <!-- Poets -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Poets</h3>
                    <p class="text-text-muted mb-6 text-sm">Spoken word artists and poets who captivate audiences with powerful storytelling.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Spoken Word', 'Poetry', 'Storytelling', 'Slam Poetry'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Cultural Events, Conferences, Intimate Gatherings</p>
                    </div>
                </div>

                <!-- Content Creators -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Content Creators</h3>
                    <p class="text-text-muted mb-6 text-sm">Influencers and creators who bring modern digital engagement to your brand.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Social Media', 'Lifestyle', 'Fashion', 'Tech', 'Food'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Brand Launches, Product Events, Marketing Campaigns</p>
                    </div>
                </div>

                <!-- Comedians -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">Comedians</h3>
                    <p class="text-text-muted mb-6 text-sm">Stand-up comedians and performers who bring laughter to any occasion.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Stand-up', 'Improv', 'Sketch', 'Clean Comedy', 'Roast'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Corporate Events, Private Parties, Fundraisers</p>
                    </div>
                </div>

                <!-- MCs -->
                <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-4">MCs</h3>
                    <p class="text-text-muted mb-6 text-sm">Professional event hosts who keep your event flowing smoothly and engaging.</p>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Event Hosting', 'Emcee', 'Announcer', 'Moderator'] as $genre)
                            <span class="px-3 py-1 bg-canvas border border-border text-[10px] font-bold uppercase tracking-wider text-text-muted rounded-full">{{ $genre }}</span>
                            @endforeach
                        </div>
                        <p class="text-xs font-semibold text-primary">Weddings, Conferences, Galas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events We Serve -->
    <section class="py-24 bg-surface border-y border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-text-main mb-4">Events We Serve</h2>
                <p class="text-text-muted">Specialized talent for every occasion</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach([
                    ['Weddings', 'Create magical moments with ceremony musicians, reception bands, and DJs who understand your vision.'],
                    ['Corporate Events', 'Professional entertainment for galas, conferences, product launches, and team building events.'],
                    ['Private Parties', 'Elevate birthdays, anniversaries, and celebrations with the perfect musical backdrop.'],
                    ['Festivals', 'Headline acts and supporting performers for music festivals and outdoor events.'],
                    ['Fundraisers & Galas', 'Sophisticated entertainment that enhances your fundraising efforts and donor experience.'],
                    ['Conferences', 'Keynote speakers and entertainment that engage and inspire attendees.'],
                ] as $event)
                <div class="flex gap-6">
                    <div class="shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-text-main mb-2">{{ $event[0] }}</h4>
                        <p class="text-text-muted leading-relaxed text-sm">{{ $event[1] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Full-Service Support -->
    <section class="py-24 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2">
                    <h2 class="text-4xl font-bold text-text-main mb-6">Full-Service Support</h2>
                    <p class="text-lg text-text-muted mb-10 leading-relaxed">We handle everything so you can focus on your event. From the first inquiry to the final applause, our team is with you.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach([
                            ['Booking Coordination', 'We manage all communication, scheduling, and logistics.'],
                            ['Contract Management', 'Professional contracts that protect both parties.'],
                            ['Technical Support', 'Guidance on sound systems and staging requirements.'],
                            ['Insurance & Liability', 'All our talent carries professional liability insurance.'],
                            ['Day-of Coordination', 'On-site support available for smooth execution.'],
                            ['Quality Assurance', 'Post-event follow-up to ensure total satisfaction.'],
                        ] as $support)
                        <div class="p-4 bg-surface rounded-2xl border border-border">
                            <h5 class="font-bold text-text-main mb-1 text-sm">{{ $support[0] }}</h5>
                            <p class="text-xs text-text-muted leading-relaxed">{{ $support[1] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=1000" class="rounded-[2.5rem] shadow-2xl relative z-10 grayscale opacity-80" alt="Event Support">
                        <div class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-60 mix-blend-color z-20 rounded-[2.5rem]"></div>
                        <div class="absolute -top-6 -right-6 w-full h-full bg-primary/20 rounded-[2.5rem] z-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-24 bg-surface border-y border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-text-main mb-4">How It Works</h2>
                <p class="text-text-muted">Simple, transparent process from inquiry to performance</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-16 gap-x-12">
                @foreach([
                    ['01', 'Submit Your Request', 'Tell us about your event - date, location, type, budget, and preferences. Browse our directory or let us recommend talent.'],
                    ['02', 'Review Recommendations', 'Within 24 hours, receive personalized talent recommendations with profiles, videos, reviews, and availability.'],
                    ['03', 'Book Your Talent', "Choose your performer and we'll handle contracts, deposits, and all coordination details."],
                    ['04', 'Event Preparation', 'We coordinate technical requirements, timing, and special requests leading up to your event.'],
                    ['05', 'Showtime', 'Your talent arrives prepared and delivers an exceptional performance. Optional on-site support available.'],
                    ['06', 'Follow-Up', 'We check in post-event to ensure everything exceeded expectations and gather feedback.'],
                ] as $step)
                <div class="relative group">
                    <div class="text-6xl font-black text-primary/10 absolute -top-8 -left-4 group-hover:text-primary/20 transition-colors">{{ $step[0] }}</div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-bold text-text-main mb-3">{{ $step[1] }}</h4>
                        <p class="text-text-muted text-sm leading-relaxed">{{ $step[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="py-24 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-text-main mb-4">Transparent Pricing</h2>
                <p class="text-text-muted">Clear value for your investment</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div class="space-y-8">
                    <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm">
                        <h4 class="text-xl font-bold text-text-main mb-4 flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            No Booking Fees for Clients
                        </h4>
                        <p class="text-text-muted text-sm leading-relaxed">Our service is completely free for event planners. You pay the talent directly for their performance - no hidden fees or commissions added.</p>
                    </div>
                    <div class="bg-surface p-8 rounded-3xl border border-border shadow-sm">
                        <h4 class="text-xl font-bold text-text-main mb-4 flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Clear Pricing Information
                        </h4>
                        <p class="text-text-muted text-sm leading-relaxed">Every talent profile includes transparent pricing ranges. Final rates are negotiable based on event details, duration, and travel requirements.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach([
                        ['Solo Musicians', 'KSh3K - KSh8K'],
                        ['DJs', 'KSh5K - KSh12K'],
                        ['Variety Artists', 'KSh8K - KSh23K'],
                        ['Speakers', 'KSh15K - KSh75K+'],
                    ] as $price)
                    <div class="bg-dark p-8 rounded-3xl text-center text-white flex flex-col justify-center border border-white/10">
                        <span class="text-sm font-medium text-gray-400 mb-2">{{ $price[0] }}</span>
                        <span class="text-3xl font-bold text-white tracking-tight">{{ $price[1] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-24 bg-dark relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto">Let's find the perfect talent for your event. Browse our directory or submit a booking inquiry today.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/talent" wire:navigate class="px-8 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary-dark transition shadow-xl shadow-primary/20">
                    Browse Directory
                </a>
                <a href="/book" wire:navigate class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-2xl transition backdrop-blur-sm border border-white/10">
                    Submit Booking Inquiry
                </a>
            </div>
        </div>
        <div class="absolute top-0 left-0 w-full h-full opacity-5">
            <div class="absolute top-1/2 left-1/4 w-[500px] h-[500px] bg-primary rounded-full blur-[100px]"></div>
            <div class="absolute bottom-1/2 right-1/4 w-[400px] h-[400px] bg-indigo-500 rounded-full blur-[80px]"></div>
        </div>
    </section>
</div>


