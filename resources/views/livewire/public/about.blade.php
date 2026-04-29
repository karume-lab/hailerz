<div class="bg-surface-muted min-h-screen">
    <!-- Hero Section -->
    <div class="relative bg-surface-dark min-h-[70vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('images/about/about-hero.webp') }}"
                alt="Premium Event" loading="eager" width="1280" height="720" class="w-full h-full object-cover grayscale opacity-40">
            <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-70"></div>
            <div class="absolute inset-0 bg-linear-to-t from-brand-navy via-brand-navy/40 to-transparent"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center gap-3 mb-8">
                <span class="h-px w-12 bg-brand-teal"></span>
                <span class="text-xs font-bold text-brand-teal uppercase tracking-widest">About the Agency</span>
                <span class="h-px w-12 bg-brand-teal"></span>
            </div>
            <h1 class="text-5xl md:text-8xl font-bold text-text-inverse tracking-tight mb-8 font-serif leading-tight">
                Elevating the <span class="text-brand-teal">Standard</span> of Event Entertainment.
            </h1>
            <p class="mt-4 max-w-3xl text-xl md:text-2xl text-gray-300 mx-auto leading-relaxed font-light">
                Hailerz is a boutique talent agency dedicated to securing world-class performers for visionary event planners and global brands.
            </p>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="flex items-center gap-3 mb-6">
            <span class="h-px w-8 bg-brand-teal"></span>
            <span class="text-xs font-bold text-brand-teal uppercase tracking-widest">Our Legacy</span>
        </div>
        <h2 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight mb-12 font-serif">The Pursuit of Excellence</h2>
        <div class="space-y-10 text-xl text-text-secondary leading-relaxed font-light">
            <p>
                Hailerz was founded on a singular premise: that premium events deserve premium talent. We recognized the disconnect between visionary event planners and the world-class performers they sought to secure. Our agency was established to bridge that gap with professional procurement, rigorous vetting, and seamless execution.
            </p>
            <p>
                Today, we represent a curated roster of elite performers, keynote speakers, and specialty acts. We don't just book talent; we partner with clients to ensure every act aligns perfectly with the event's DNA, from corporate galas to private island retreats.
            </p>
            <p>
                Our reputation is built on trust, transparency, and a relentless focus on production quality. We manage the complexities of contracting and logistics so you can focus on the guest experience.
            </p>
        </div>
    </div>

    <!-- Our Values -->
    <div class="bg-surface-light py-32 border-y border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-bold text-text-primary tracking-tight mb-6 font-serif">Agency Principles</h2>
                <p class="text-lg text-text-secondary">Our core values define the Hailerz experience for both talent and clients.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $values = [
                        ['title' => 'Excellence', 'desc' => 'We curate only the finest talent, ensuring every act meets our rigorous standards for professional performance.'],
                        ['title' => 'Discretion', 'desc' => 'We operate with the highest level of confidentiality and professionalism for our high-profile clients.'],
                        ['title' => 'Partnership', 'desc' => 'We build lasting relationships with planners, acting as an extension of your production team.'],
                        ['title' => 'Integrity', 'desc' => 'Transparent negotiations and secure contracting are the bedrock of our agency operations.'],
                    ];
                @endphp

                @foreach($values as $value)
                    <div class="bg-surface-muted p-10 rounded-3xl border border-gray-200 dark:border-gray-800 group hover:bg-brand-navy transition-all duration-500 hover:shadow-2xl">
                        <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif group-hover:text-white transition-colors">{{ $value['title'] }}</h3>
                        <p class="text-text-secondary leading-relaxed font-light group-hover:text-white/70 transition-colors">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="bg-surface-muted py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-bold text-text-primary tracking-tight mb-6 font-serif">The Agents</h2>
                <p class="text-lg text-text-secondary">Meet the specialists dedicated to your event's success.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @php
                    $team = [
                        ['name' => 'David Somoye', 'role' => 'Founder / Senior Agent', 'img' => 'founder.webp', 'bio' => '10+ years in premium talent procurement.'],
                        ['name' => 'Lolitasville', 'role' => 'Director of Talent', 'img' => 'head-of-talent-relation.webp', 'bio' => 'Expert in industry relations and artist vetting.'],
                        ['name' => 'Anne James', 'role' => 'Client Success', 'img' => 'client-success-director.webp', 'bio' => 'Specialist in on-site coordination and logistics.'],
                    ];
                @endphp

                @foreach($team as $member)
                    <div class="group relative overflow-hidden rounded-[2.5rem] aspect-3/4 bg-surface-dark border border-white/5 shadow-xl">
                        <img src="{{ asset('images/about/' . $member['img']) }}" loading="lazy" width="400" height="533" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110" alt="{{ $member['name'] }}" />
                        <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-70"></div>
                        <div class="absolute inset-0 bg-linear-to-t from-brand-navy/90 via-brand-navy/20 to-transparent"></div>
                        <div class="absolute bottom-10 left-10 right-10">
                            <h3 class="text-3xl font-bold text-white mb-2 font-serif">{{ $member['name'] }}</h3>
                            <p class="text-brand-mint text-xs font-bold uppercase tracking-widest mb-4">{{ $member['role'] }}</p>
                            <p class="text-white/60 text-sm leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ $member['bio'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Bottom CTA -->
    <div class="relative py-40 overflow-hidden bg-brand-navy">
        <div class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center grayscale"></div>
        <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-40"></div>
        
        <div class="relative max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-7xl font-bold text-text-inverse mb-8 tracking-tight font-serif">Secure the Act.</h2>
            <p class="text-xl md:text-2xl text-gray-300 mb-12 font-light leading-relaxed">
                Partner with Hailerz to elevate your next event with world-class talent and professional management.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <x-button variant="primary" size="lg" href="/talent" wire:navigate>
                    Explore the Roster
                </x-button>
                <x-button variant="secondary" size="lg" href="/book" wire:navigate class="bg-white/5 border-white/10 text-white hover:bg-white/10">
                    Start Booking Inquiry
                </x-button>
            </div>
        </div>
    </div>
</div>