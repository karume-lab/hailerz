<div class="bg-canvas min-h-screen">
    <!-- Hero Section: Full-width background image with centered content -->
    <div class="relative bg-gray-950 min-h-[70vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Background Image with Overlay -->
            <img src="{{ asset('images/about/about-hero.webp') }}"
                alt="Concert Crowd" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-linear-to-t from-gray-950 via-gray-950/60 to-transparent"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-7xl font-extrabold text-white tracking-tight mb-8 drop-shadow-lg">
                Making Every Event <span class="text-primary italic">Unforgettable</span>
            </h1>
            <p
                class="mt-4 max-w-3xl text-xl md:text-2xl text-gray-300 mx-auto leading-relaxed drop-shadow-md font-light">
                We connect event planners with world-class talent to create extraordinary experiences that audiences
                remember forever.
            </p>
        </div>
    </div>

    <!-- Our Story Section: Single centered column -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <span class="text-primary text-sm font-bold uppercase tracking-widest mb-6 block">Our Story</span>
        <h2 class="text-4xl md:text-5xl font-extrabold text-text-main tracking-tight mb-12">Building a Legacy</h2>
        <div class="space-y-8 text-xl text-text-muted leading-relaxed font-light">
            <p>
                Hailerz exists for one reason - to make discovering and booking incredible talent effortless. Born
                from the real struggles event planners face when trying to find reliable, high‑quality performers,
                Hailerz was created to bridge that gap with a platform built on trust, creativity, and community.
            </p>
            <p>
                Today, we proudly represent a growing network of over 100 talented creatives across multiple
                categories and genres. From intimate gatherings to large corporate events and festivals, we've
                helped bring unforgettable performances to life.
            </p>
            <p>
                Hailerz has become the go-to space for planners who value excellence. Every talent on our platform
                goes through a careful vetting process to ensure they deliver standout performances. And with our
                team handling the logistics, you're free to focus on what matters most - creating meaningful,
                memorable experiences.
            </p>
        </div>
    </div>

    <!-- Our Values Section: Centered 4-card grid -->
    <div class="bg-surface py-24 lg:py-32 border-y border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-primary text-sm font-bold uppercase tracking-widest mb-4 block">Our Values</span>
                <h2 class="text-4xl font-extrabold text-text-main tracking-tight mb-6 leading-tight">These core principles
                    guide everything we do</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Excellence -->
                <div
                    class="bg-canvas/50 p-10 rounded-3xl shadow-sm border border-border text-center group hover:shadow-lg transition-all duration-300">
                    <h3 class="text-2xl font-bold text-text-main mb-4 uppercase tracking-wider">Excellence</h3>
                    <p class="text-text-muted leading-relaxed font-light">We curate only the finest talent and deliver
                        exceptional service on every booking.</p>
                </div>

                <!-- Passion -->
                <div
                    class="bg-canvas/50 p-10 rounded-3xl shadow-sm border border-border text-center group hover:shadow-lg transition-all duration-300">
                    <h3 class="text-2xl font-bold text-text-main mb-4 uppercase tracking-wider">Passion</h3>
                    <p class="text-text-muted leading-relaxed font-light">We love what we do and it shows in our
                        dedication to creating unforgettable events.</p>
                </div>

                <!-- Partnership -->
                <div
                    class="bg-canvas/50 p-10 rounded-3xl shadow-sm border border-border text-center group hover:shadow-lg transition-all duration-300">
                    <h3 class="text-2xl font-bold text-text-main mb-4 uppercase tracking-wider">Partnership</h3>
                    <p class="text-text-muted leading-relaxed font-light">We build lasting relationships with both clients
                        and talent based on trust and respect.</p>
                </div>

                <!-- Integrity -->
                <div
                    class="bg-canvas/50 p-10 rounded-3xl shadow-sm border border-border text-center group hover:shadow-lg transition-all duration-300">
                    <h3 class="text-2xl font-bold text-text-main mb-4 uppercase tracking-wider">Integrity</h3>
                    <p class="text-text-muted leading-relaxed font-light">We operate with transparency, honesty, and
                        professionalism in every interaction.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- What Sets Us Apart Section: Left-aligned icons and 2-column grid -->
    <div class="py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-20">
                <span class="text-primary text-sm font-bold uppercase tracking-widest mb-4 block">The Advantage</span>
                <h2 class="text-4xl font-extrabold text-text-main tracking-tight mb-4">What Sets Us Apart</h2>
                <p class="text-xl text-text-muted font-light">Why event planners choose Hailerz</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-12">
                <!-- Feature 1 -->
                <div class="flex gap-6">
                    <div
                        class="shrink-0 h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mt-1">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-text-main mb-2">Rigorous Vetting Process</h4>
                        <p class="text-text-muted leading-relaxed font-light">Every artist undergoes a comprehensive
                            evaluation including performance reviews, technical assessments, and professionalism checks
                            before joining our roster.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="flex gap-6">
                    <div
                        class="shrink-0 h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mt-1">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-text-main mb-2">Full-Service Support</h4>
                        <p class="text-text-muted leading-relaxed font-light">From initial inquiry to post-event
                            follow-up, our dedicated team handles contracts, logistics, technical requirements, and
                            coordination.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="flex gap-6">
                    <div
                        class="shrink-0 h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mt-1">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-text-main mb-2">Transparent Pricing</h4>
                        <p class="text-text-muted leading-relaxed font-light">No hidden fees or surprises. You pay the
                            artist directly - our service is completely free for clients.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="flex gap-6">
                    <div
                        class="shrink-0 h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mt-1">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-text-main mb-2">Nationwide Network</h4>
                        <p class="text-text-muted leading-relaxed font-light">Access top talent across the country with
                            our extensive network of performers in major cities and regional markets.</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="flex gap-6">
                    <div
                        class="shrink-0 h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mt-1">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-text-main mb-2">Quick Response Time</h4>
                        <p class="text-text-muted leading-relaxed font-light">Our team responds to inquiries within 24
                            hours with personalized recommendations tailored to your event.</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="flex gap-6">
                    <div
                        class="shrink-0 h-10 w-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mt-1">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-extrabold text-text-main mb-2">Proven Track Record</h4>
                        <p class="text-text-muted leading-relaxed font-light">Thousands of successful events and a 98%
                            client satisfaction rate speak to our commitment to excellence.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Meet Our Team Section: 3-column rounded rectangular cards with text overlay -->
    <div class="bg-surface py-24 lg:py-32 border-t border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-primary text-sm font-bold uppercase tracking-widest mb-4 block">Our Team</span>
                <h2 class="text-4xl font-extrabold text-text-main tracking-tight mb-4 leading-tight">Meet the Professionals
                    Behind Your Success</h2>
                <p class="text-lg text-text-muted font-light">Dedicated to excellence in talent management and event
                    planning</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Team Member 1 -->
                <div
                    class="relative group h-[500px] rounded-md overflow-hidden shadow-2xl transition-transform duration-500 hover:-translate-y-2">
                    <img src="{{ asset('images/about/founder.webp') }}" alt="David Somoye"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 bg-linear-to-t from-dark/95 via-dark/70 to-transparent p-10 pt-20">
                        <h3 class="text-3xl font-bold text-white mb-1">David Somoye</h3>
                        <p class="text-primary font-bold text-sm uppercase tracking-widest mb-6">CFO / Founder</p>
                        <ul class="space-y-2">
                            <li class="flex items-start text-sm text-gray-300 gap-2">
                                <svg class="h-5 w-5 text-primary shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                10+ years in event planning
                            </li>
                            <li class="flex items-start text-sm text-gray-300 gap-2">
                                <svg class="h-5 w-5 text-primary shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Entertainment booking specialist
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div
                    class="relative group h-[500px] rounded-md overflow-hidden shadow-2xl transition-transform duration-500 hover:-translate-y-2">
                    <img src="{{ asset('images/about/head-of-talent-relation.webp') }}" alt="Lolitasville"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 bg-linear-to-t from-dark/95 via-dark/70 to-transparent p-10 pt-20">
                        <h3 class="text-3xl font-bold text-white mb-1">Lolitasville</h3>
                        <p class="text-primary font-bold text-sm uppercase tracking-widest mb-6">Talent Management</p>
                        <ul class="space-y-2">
                            <li class="flex items-start text-sm text-gray-300 gap-2">
                                <svg class="h-5 w-5 text-primary shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Former broadcaster
                            </li>
                            <li class="flex items-start text-sm text-gray-300 gap-2">
                                <svg class="h-5 w-5 text-primary shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Deep industry connections
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div
                    class="relative group h-[500px] rounded-md overflow-hidden shadow-2xl transition-transform duration-500 hover:-translate-y-2">
                    <img src="{{ asset('images/about/client-success-director.webp') }}" alt="Anne James"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-x-0 bottom-0 bg-linear-to-t from-dark/95 via-dark/70 to-transparent p-10 pt-20">
                        <h3 class="text-3xl font-bold text-white mb-1">Anne James</h3>
                        <p class="text-primary font-bold text-sm uppercase tracking-widest mb-6">Community Manager</p>
                        <ul class="space-y-2">
                            <li class="flex items-start text-sm text-gray-300 gap-2">
                                <svg class="h-5 w-5 text-primary shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Event execution specialist
                            </li>
                            <li class="flex items-start text-sm text-gray-300 gap-2">
                                <svg class="h-5 w-5 text-primary shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Dedicated client success
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom CTA: Banner with music note icon and specific button styles -->
    <div class="relative py-32 overflow-hidden bg-dark">
        <div
            class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-fixed">
        </div>
        <div class="absolute inset-0 bg-linear-to-b from-dark/80 via-dark to-dark/80"></div>

        <div class="relative max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-6xl font-extrabold text-white mb-8 tracking-tight">Ready to Work Together?</h2>
            <p class="text-xl md:text-2xl text-gray-200 mb-12 font-light leading-relaxed">
                Let's create an unforgettable event. Browse our talent directory or submit a booking inquiry today.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="/talent" wire:navigate
                    class="px-12 py-5 border-2 border-primary text-primary font-bold rounded-md hover:bg-primary hover:text-white transition-all duration-300 shadow-lg shadow-primary/10">
                    Browse Talent
                </a>
                <a href="/book" wire:navigate
                    class="px-12 py-5 bg-primary text-white font-bold rounded-md hover:bg-primary-dark transition-all duration-300 shadow-xl shadow-primary/20 scale-100 hover:scale-105">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</div>