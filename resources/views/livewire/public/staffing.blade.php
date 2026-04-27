<div class="bg-surface-muted min-h-screen">
    <!-- Hero Section -->
    <section class="relative bg-surface-dark py-32 lg:py-48 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="flex items-center justify-center gap-3 mb-8">
                <span class="h-px w-12 bg-brand-teal"></span>
                <span class="text-xs font-bold text-brand-teal uppercase tracking-widest">Talent Augmentation</span>
                <span class="h-px w-12 bg-brand-teal"></span>
            </div>
            <h1 class="text-5xl md:text-8xl font-bold text-text-inverse tracking-tight mb-8 font-serif leading-tight">
                Elite <span class="text-brand-teal">Event</span> Staffing Solutions
            </h1>
            <p class="text-xl md:text-2xl text-text-secondary max-w-3xl mx-auto leading-relaxed font-light">
                Scale your production team with vetted specialists. We provide the technical expertise and professional support required for world-class event execution.
            </p>
        </div>
        
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-brand-teal/10 rounded-full blur-[150px] opacity-20"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-brand-mint/10 rounded-full blur-[120px] opacity-10"></div>
        </div>
    </section>

    <!-- Core Solutions -->
    <section class="py-32 bg-surface-muted">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-24">
                <h2 class="text-3xl md:text-5xl font-bold text-brand-navy mb-6 font-serif tracking-tight">On-Demand Expertise</h2>
                <p class="text-text-secondary text-lg">Whether you need specialized technical leads or a full production crew, our augmentation services scale to your event's DNA.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @php
                    $solutions = [
                        [
                            'title' => 'Technical Direction',
                            'desc' => 'Senior technical leads to oversee sound, lighting, and video integration for complex event environments.',
                            'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                        ],
                        [
                            'title' => 'Stage Management',
                            'desc' => 'Professional stage managers dedicated to flawless transitions, talent coordination, and schedule adherence.',
                            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                        ],
                        [
                            'title' => 'Hospitality & VIP Leads',
                            'desc' => 'Elite staffing for high-profile guest management, hospitality suites, and backstage artist relations.',
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857'
                        ],
                        [
                            'title' => 'Production Assistants',
                            'desc' => 'Highly trained assistants to support on-site logistics, procurement tracking, and general event operations.',
                            'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                        ],
                        [
                            'title' => 'Show Callers',
                            'desc' => 'Precision-focused professionals to manage cues, timing, and synchronization across all technical departments.',
                            'icon' => 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z'
                        ],
                        [
                            'title' => 'Audio-Visual Crew',
                            'desc' => 'Vetted AV technicians, camera operators, and lighting specialists for seamless production execution.',
                            'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'
                        ],
                    ];
                @endphp

                @foreach($solutions as $solution)
                <div class="bg-surface-light p-12 rounded-[2.5rem] border border-brand-navy/5 shadow-sm hover:shadow-2xl transition-all duration-500 group">
                    <div class="w-16 h-16 bg-brand-teal/10 rounded-2xl flex items-center justify-center text-brand-teal mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $solution['icon'] }}"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-navy mb-4 font-serif">{{ $solution['title'] }}</h3>
                    <p class="text-text-secondary leading-relaxed font-light">{{ $solution['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Visual Showcase Section -->
    <section class="py-32 bg-surface-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-24 items-center">
                <div class="space-y-10">
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-brand-teal"></span>
                        <span class="text-xs font-bold text-brand-teal uppercase tracking-widest">Global Standards</span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-bold text-brand-navy font-serif tracking-tight leading-tight">
                        Qualified Professionals. <span class="text-brand-teal italic">Precision</span> Execution.
                    </h2>
                    <p class="text-xl text-text-secondary leading-relaxed font-light">
                        We don't just provide staff; we provide peace of mind. Every member of our augmentation roster undergoes a rigorous vetting process to ensure they meet the Hailerz standard for professional excellence and discretion.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        <div>
                            <h3 class="text-4xl font-bold text-brand-navy mb-2 font-serif">500+</h3>
                            <p class="text-xs font-bold text-text-muted uppercase tracking-widest">Vetted Specialists</p>
                        </div>
                        <div>
                            <h3 class="text-4xl font-bold text-brand-navy mb-2 font-serif">24/7</h3>
                            <p class="text-xs font-bold text-text-muted uppercase tracking-widest">Logistics Support</p>
                        </div>
                    </div>
                </div>
                <div class="mt-16 lg:mt-0 grid grid-cols-2 gap-6">
                    <div class="group relative overflow-hidden rounded-xl aspect-3/4 bg-surface-dark shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&q=80&w=1000" loading="lazy" width="500" height="667" alt="Corporate Event Production" class="w-full h-full object-cover grayscale transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-70"></div>
                        <div class="absolute inset-0 bg-linear-to-t from-brand-navy/90 via-transparent to-transparent"></div>
                    </div>
                    <div class="group relative overflow-hidden rounded-xl aspect-3/4 bg-surface-dark shadow-2xl mt-12">
                        <img src="https://images.unsplash.com/photo-1540575861501-7ad05823c23d?auto=format&fit=crop&q=80&w=1000" loading="lazy" width="500" height="667" alt="Professional Staffing On-site" class="w-full h-full object-cover grayscale transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-70"></div>
                        <div class="absolute inset-0 bg-linear-to-t from-brand-navy/90 via-transparent to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="py-32 bg-surface-dark relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-24">
                <h2 class="text-3xl md:text-5xl font-bold text-text-inverse mb-6 font-serif tracking-tight">The Hailerz Advantage</h2>
                <p class="text-text-secondary text-lg">A commitment to professional staffing that transcends typical labor solutions.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div class="flex gap-8">
                    <div class="h-12 w-12 rounded-full bg-brand-teal/20 flex items-center justify-center text-brand-teal shrink-0">
                        <span class="font-bold">01</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 font-serif">Rigorous Vetting</h3>
                        <p class="text-text-secondary leading-relaxed font-light">Every staff member is interviewed, their credentials verified, and their track record for corporate event delivery audited.</p>
                    </div>
                </div>
                <div class="flex gap-8">
                    <div class="h-12 w-12 rounded-full bg-brand-teal/20 flex items-center justify-center text-brand-teal shrink-0">
                        <span class="font-bold">02</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 font-serif">Rapid Mobilization</h3>
                        <p class="text-text-secondary leading-relaxed font-light">Our extensive network allows us to mobilize professional talent augmentation teams even on short notice across international territories.</p>
                    </div>
                </div>
                <div class="flex gap-8">
                    <div class="h-12 w-12 rounded-full bg-brand-teal/20 flex items-center justify-center text-brand-teal shrink-0">
                        <span class="font-bold">03</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 font-serif">Bespoke Matching</h3>
                        <p class="text-text-secondary leading-relaxed font-light">We don't just fill seats; we match professionals to your specific event culture, technical requirements, and client expectations.</p>
                    </div>
                </div>
                <div class="flex gap-8">
                    <div class="h-12 w-12 rounded-full bg-brand-teal/20 flex items-center justify-center text-brand-teal shrink-0">
                        <span class="font-bold">04</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-text-inverse mb-4 font-serif">End-to-End Logistics</h3>
                        <p class="text-text-secondary leading-relaxed font-light">From travel and accommodation to payroll and compliance, Hailerz manages the full administrative lifecycle of your augmented team.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-40 bg-surface-muted text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <h2 class="text-4xl md:text-7xl font-bold text-brand-navy mb-8 font-serif tracking-tight leading-tight">Scale Your <span class="text-brand-teal italic">Ambition</span>.</h2>
            <p class="text-xl md:text-2xl text-text-secondary mb-12 font-light leading-relaxed">
                Experience the difference that professional event staffing can make. Let us augment your team for your next world-class production.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <x-button variant="primary" size="lg" href="/contact" wire:navigate>
                    Request Staffing Proposal
                </x-button>
                <x-button variant="secondary" size="lg" href="/services" wire:navigate>
                    View All Services
                </x-button>
            </div>
        </div>
        
        <!-- Subtle Grid Background -->
        <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#0A1D37_1px,transparent_1px)] bg-size-[40px_40px]"></div>
    </section>
</div>
