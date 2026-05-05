<div class="bg-surface-muted min-h-screen">
    <!-- Hero Section -->
    <section class="relative bg-surface-dark py-32 lg:py-48 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="flex items-center justify-center gap-3 mb-8">
                <span class="h-px w-12 bg-brand-primary"></span>
                <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Premium Event
                    Personnel</span>
                <span class="h-px w-12 bg-brand-primary"></span>
            </div>
            <x-heading level="h1" title="Hire Elite Event Personnel" emphasis="Elite Event" align="center"
                class="text-text-inverse mb-8" />
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed font-light">
                Secure the polished, professional personnel required to execute flawless events. From VIP hosts to
                dedicated artist liaisons, we provide the expert staffing your vision deserves.
            </p>
        </div>

        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-brand-primary/10 rounded-full blur-[150px] opacity-20 pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-secondary/10 rounded-full blur-[120px] opacity-10 pointer-events-none">
            </div>
        </div>
    </section>

    <!-- Core Solutions -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-heading align="center"
                subtitle="From the red carpet to the green room, we supply the industry's most articulate and capable event professionals."
                title="Specialized Roles for Flawless Events" emphasis="Flawless Events" class="reveal" />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @php
                    $solutions = [
                        [
                            'title' => 'VIP Hosts & Hospitality',
                            'desc' => 'White-glove service personnel dedicated to high-net-worth guest management, premium table service, and exclusive hospitality suites.',
                            'icon' => 'glass-water'
                        ],
                        [
                            'title' => 'Artist Liaisons',
                            'desc' => 'Experienced talent handlers to manage performers, riders, green rooms, and schedules, so your core team doesn\'t have to.',
                            'icon' => 'star'
                        ],
                        [
                            'title' => 'Stage & Floor Managers',
                            'desc' => 'Expert coordinators who dictate the run-of-show with precision, ensuring seamless transitions between entertainment acts.',
                            'icon' => 'clipboard-list'
                        ],
                        [
                            'title' => 'Brand Ambassadors',
                            'desc' => 'Charismatic, impeccably groomed promotional models and ambassadors to represent your brand at corporate activations and launches.',
                            'icon' => 'sparkles'
                        ],
                        [
                            'title' => 'Masters of Ceremonies',
                            'desc' => 'Professional, engaging hosts who command the room, guide the audience\'s attention, and keep the event\'s energy high.',
                            'icon' => 'mic-2'
                        ],
                        [
                            'title' => 'Event Coordinators',
                            'desc' => 'On-site logistical experts who act as your right hand, managing front-of-house operations and rapid problem-solving.',
                            'icon' => 'users'
                        ],
                    ];
                @endphp

                @foreach($solutions as $index => $solution)
                    <x-feature-card :index="$index" :icon="$solution['icon']" :title="$solution['title']"
                        :desc="$solution['desc']" iconVariant="secondary" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Visual Showcase Section -->
    <section class="py-32 bg-surface-light border-y border-subtle">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-24 items-center">
                <div class="space-y-10 reveal">
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-brand-primary"></span>
                        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Our
                            Standards</span>
                    </div>
                    <x-heading level="h2" title="White-Glove Service. Impeccable Delivery." emphasis="Impeccable"
                        :italic="true" class="text-text-primary mb-8" />
                    <p class="text-xl text-text-secondary leading-relaxed font-light">
                        We don't just fill roles. We provide polished professionals who deeply understand the nuances of
                        high-end entertainment and luxury hospitality. When you book staff through Hailerz, you are
                        securing an extension of your own brand's excellence.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        <div>
                            <h3 class="text-4xl font-bold text-text-primary mb-2 font-serif">100%</h3>
                            <p class="text-xs font-bold text-text-muted uppercase tracking-widest">Vetted Professionals
                            </p>
                        </div>
                        <div>
                            <h3 class="text-4xl font-bold text-text-primary mb-2 font-serif">24/7</h3>
                            <p class="text-xs font-bold text-text-muted uppercase tracking-widest">Agency Support</p>
                        </div>
                    </div>
                </div>
                <div class="mt-16 lg:mt-0 grid grid-cols-2 gap-6">
                    <div
                        class="group relative overflow-hidden rounded-2xl aspect-3/4 bg-surface-dark shadow-sm hover:shadow-xl transition-shadow duration-500 reveal reveal-delay-100">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=1000"
                            loading="lazy" width="500" height="667" alt="Luxury Event Hospitality"
                            class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-linear-to-tr from-brand-primary/60 to-brand-secondary/20 mix-blend-multiply opacity-80">
                        </div>
                    </div>
                    <div
                        class="group relative overflow-hidden rounded-2xl aspect-3/4 bg-surface-dark shadow-sm hover:shadow-xl transition-shadow duration-500 mt-12 reveal reveal-delay-300">
                        <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?auto=format&fit=crop&q=80&w=1000"
                            loading="lazy" width="500" height="667" alt="Event Coordination"
                            class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-linear-to-tr from-brand-primary/60 to-brand-secondary/20 mix-blend-multiply opacity-80">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="py-32 bg-surface-dark relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-heading align="center"
                subtitle="We are your dedicated hospitality partner, providing a meticulous approach to staffing your most important occasions."
                title="The Hailerz Advantage" emphasis="Advantage" class="reveal text-white" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mt-16">
                <div class="flex gap-8 reveal border-b border-white/10 pb-8 md:border-none md:pb-0">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-secondary/10 text-brand-secondary flex items-center justify-center shrink-0">
                        <span class="font-bold">01</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-4 font-serif">Premium Presentation</h3>
                        <p class="text-white/70 leading-relaxed font-light">Our personnel are impeccably groomed, highly
                            articulate, and rigorously trained in luxury hospitality and brand representation standards.
                        </p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-100 border-b border-white/10 pb-8 md:border-none md:pb-0">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-secondary/10 text-brand-secondary flex items-center justify-center shrink-0">
                        <span class="font-bold">02</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-4 font-serif">Entertainment Expertise</h3>
                        <p class="text-white/70 leading-relaxed font-light">As a talent agency, we uniquely understand
                            the rhythm of live events. Our staff expertly bridges the gap between performers, planners,
                            and guests.</p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-200 border-b border-white/10 pb-8 md:border-none md:pb-0">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-secondary/10 text-brand-secondary flex items-center justify-center shrink-0">
                        <span class="font-bold">03</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-4 font-serif">Bespoke Matching</h3>
                        <p class="text-white/70 leading-relaxed font-light">We don't just fill quotas. We carefully
                            align our staff's personalities, skills, and backgrounds with your event's specific tone and
                            audience demographic.</p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-300">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-secondary/10 text-brand-secondary flex items-center justify-center shrink-0">
                        <span class="font-bold">04</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-4 font-serif">Flawless Management</h3>
                        <p class="text-white/70 leading-relaxed font-light">From detailed briefings and wardrobe checks
                            to on-site coordination and payroll, we handle all personnel logistics seamlessly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-40 bg-brand-accent text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 relative z-10 reveal">
            <x-heading level="h2" title="Assemble Your Event Team." emphasis="Event Team" :italic="true"
                class="text-text-inverse mb-8" />
            <p class="text-xl md:text-2xl text-text-inverse/80 mb-12 font-light leading-relaxed">
                From the stage to the floor, ensure every touchpoint of your event is handled by industry experts.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <x-button variant="outline" size="lg" href="/services" wire:navigate>
                    Explore Talent Roster
                </x-button>
                <x-button variant="primary" size="lg" href="/contact" wire:navigate>
                    Request Event Staff
                </x-button>
            </div>
        </div>

        <!-- Subtle Grid Background -->
        <div
            class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(var(--color-brand-primary)_1px,transparent_1px)] bg-size-[40px_40px]">
        </div>
    </section>
</div>