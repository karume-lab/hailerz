<div class="bg-surface-muted min-h-screen">
    <!-- Hero Section -->
    <section class="relative bg-surface-dark py-32 lg:py-48 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="flex items-center justify-center gap-3 mb-8">
                <span class="h-px w-12 bg-brand-primary"></span>
                <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Expert Support</span>
                <span class="h-px w-12 bg-brand-primary"></span>
            </div>
            <h1 class="text-5xl md:text-8xl font-bold text-text-inverse tracking-tight mb-8  leading-tight">
                World-Class <span class="text-brand-secondary">Production</span> Support
            </h1>
            <p class="text-xl md:text-2xl text-text-muted max-w-3xl mx-auto leading-relaxed font-light">
                Experience seamless event execution with our network of production specialists. We provide the technical
                expertise and professional support to bring your vision to life.
            </p>
        </div>

        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-brand-primary/10 rounded-full blur-[150px] opacity-20">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-secondary/10 rounded-full blur-[120px] opacity-10">
            </div>
        </div>
    </section>

    <!-- Core Solutions -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading align="center"
                subtitle="Whether you need a technical lead or a full production crew, we provide vetted professionals who ensure your event flows smoothly."
                title='Specialists for <span class="text-brand-secondary">Every Stage</span>' class="reveal" />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @php
                    $solutions = [
                        [
                            'title' => 'Technical Direction',
                            'desc' => 'Senior technical leads to oversee sound, lighting, and video integration for complex event environments.',
                            'icon' => 'monitor'
                        ],
                        [
                            'title' => 'Stage Management',
                            'desc' => 'Professional stage managers dedicated to flawless transitions, talent coordination, and schedule adherence.',
                            'icon' => 'clock'
                        ],
                        [
                            'title' => 'Hospitality & VIP Leads',
                            'desc' => 'Elite staffing for high-profile guest management, hospitality suites, and backstage artist relations.',
                            'icon' => 'users'
                        ],
                        [
                            'title' => 'Production Assistants',
                            'desc' => 'Highly trained assistants to support on-site logistics, procurement tracking, and general event operations.',
                            'icon' => 'briefcase'
                        ],
                        [
                            'title' => 'Show Callers',
                            'desc' => 'Precision-focused professionals to manage cues, timing, and synchronization across all technical departments.',
                            'icon' => 'mic'
                        ],
                        [
                            'title' => 'Audio-Visual Crew',
                            'desc' => 'Vetted AV technicians, camera operators, and lighting specialists for seamless production execution.',
                            'icon' => 'video'
                        ],
                    ];
                @endphp

                @foreach($solutions as $index => $solution)
                    <x-card padding="p-12"
                        class="reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
                        <div
                            class="w-16 h-16 bg-brand-primary/10 rounded-2xl flex items-center justify-center text-brand-primary mb-8 group-hover:scale-110 transition-transform">
                            <x-dynamic-component :component="'lucide-' . $solution['icon']" class="w-8 h-8"
                                stroke-width="2" />
                        </div>
                        <h3 class="text-2xl font-bold text-text-primary mb-4 ">{{ $solution['title'] }}</h3>
                        <p class="text-text-secondary leading-relaxed font-light">{{ $solution['desc'] }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Visual Showcase Section -->
    <section class="py-32 bg-surface-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-24 items-center">
                <div class="space-y-10 reveal">
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-brand-primary"></span>
                        <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Our
                            Standards</span>
                    </div>
                    <h2
                        class="text-4xl md:text-6xl font-bold text-text-primary  tracking-tight leading-tight">
                        Vetted Talent. <span class="text-brand-secondary italic">Seamless</span> Execution.
                    </h2>
                    <p class="text-xl text-text-secondary leading-relaxed font-light">
                        We don’t just provide staff; we provide solutions. Every specialist is carefully vetted to
                        ensure they deliver standout support and professional excellence.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        <div>
                            <h3 class="text-4xl font-bold text-text-primary mb-2 ">500+</h3>
                            <p class="text-xs font-bold text-text-muted uppercase tracking-widest">Vetted Specialists
                            </p>
                        </div>
                        <div>
                            <h3 class="text-4xl font-bold text-text-primary mb-2 ">24/7</h3>
                            <p class="text-xs font-bold text-text-muted uppercase tracking-widest">Logistics Support</p>
                        </div>
                    </div>
                </div>
                <div class="mt-16 lg:mt-0 grid grid-cols-2 gap-6">
                    <div
                        class="group relative overflow-hidden rounded-xl aspect-3/4 bg-surface-dark shadow-2xl reveal reveal-delay-100">
                        <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&q=80&w=1000"
                            loading="lazy" width="500" height="667" alt="Corporate Event Production"
                            class="w-full h-full object-cover grayscale transition-transform duration-500 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70">
                        </div>
                        <div
                            class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-transparent to-transparent">
                        </div>
                    </div>
                    <div
                        class="group relative overflow-hidden rounded-xl aspect-3/4 bg-surface-dark shadow-2xl mt-12 reveal reveal-delay-300">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&q=80&w=1000"
                            loading="lazy" width="500" height="667" alt="Professional Staffing On-site"
                            class="w-full h-full object-cover grayscale transition-transform duration-500 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70">
                        </div>
                        <div
                            class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-transparent to-transparent">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="py-32 bg-surface-dark relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-section-heading align="center"
                subtitle="We are your dedicated partner in event success, providing a white-glove approach to production staffing."
                title='The Hailerz <span class="text-brand-secondary">Advantage</span>' class="reveal" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div class="flex gap-8 reveal">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/20 flex items-center justify-center text-brand-primary shrink-0">
                        <span class="font-bold">01</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 ">Vetted Excellence</h3>
                        <p class="text-text-muted leading-relaxed font-light">We personally interview and verify the
                            experience of every specialist before they join our elite roster.</p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-100">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/20 flex items-center justify-center text-brand-primary shrink-0">
                        <span class="font-bold">02</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 ">Global Reach</h3>
                        <p class="text-text-muted leading-relaxed font-light">Our extensive network allows us to place
                            top-tier professionals quickly, anywhere in the world.</p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-200">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/20 flex items-center justify-center text-brand-primary shrink-0">
                        <span class="font-bold">03</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 ">Bespoke Matching</h3>
                        <p class="text-text-muted leading-relaxed font-light">We match specialists to your specific
                            technical requirements and the unique tone of your event.</p>
                    </div>
                </div>
                <div class="flex gap-8 reveal reveal-delay-300">
                    <div
                        class="h-12 w-12 rounded-full bg-brand-primary/20 flex items-center justify-center text-brand-primary shrink-0">
                        <span class="font-bold">04</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 ">Seamless Management</h3>
                        <p class="text-text-muted leading-relaxed font-light">From travel logistics to secure contracts,
                            we handle the details so you can focus on the performance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-40 bg-surface-muted text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 relative z-10 reveal">
            <h2 class="text-4xl md:text-7xl font-bold text-text-primary mb-8  tracking-tight leading-tight">
                Build an <span class="text-brand-secondary italic">Elite</span> Team.</h2>
            <p class="text-xl md:text-2xl text-text-secondary mb-12 font-light leading-relaxed">
                Experience the difference of working with world-class professionals. Let us help you staff your next
                unforgettable event.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <x-button variant="secondary" size="lg" href="/services" wire:navigate>
                    View All Services
                </x-button>
                <x-button variant="primary" size="lg" href="/contact" wire:navigate>
                    Request Staffing Proposal
                </x-button>
            </div>
        </div>

        <!-- Subtle Grid Background -->
        <div
            class="absolute inset-0 opacity-5 bg-[radial-gradient(var(--color-brand-primary)_1px,transparent_1px)] bg-size-[40px_40px]">
        </div>
    </section>
</div>