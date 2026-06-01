<x-layouts.app>
    <x-slot:title>Hailerz Event & Conference Expo | Hailerz</x-slot>

    <div class="w-full bg-surface-light min-h-screen">
        <!-- Hero Section -->
        <section class="relative py-24 sm:py-32 overflow-hidden bg-linear-to-b from-brand-primary/5 to-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto flex flex-col items-center">
                    <x-heading level="h1" title="Where Learning Meets" highlight="Enterprise Innovation" align="center"
                        class="text-brand-accent dark:text-text-primary mb-6 reveal reveal-delay-100" />

                    <p class="text-lg sm:text-xl text-text-secondary mb-10 leading-relaxed reveal reveal-delay-200">
                        Join over 1,500 industry leaders, creators, and technology experts at the Hailerz Event & Conference
                        Expo. Discover cutting-edge strategies, view state-of-the-art corporate exhibitions, and expand your
                        ecosystem.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center reveal reveal-delay-300">
                        <x-button href="/events/submissions?tier=attendee" variant="primary" size="lg" wire:navigate
                            class="hover:scale-105 transition-transform duration-300">
                            Get Ticket
                        </x-button>
                        <x-button href="/events/submissions?tier=exhibitor" variant="outline" size="lg" wire:navigate
                            class="hover:scale-105 transition-transform duration-300">
                            Register Booth
                        </x-button>
                        <x-button href="/events/browse" variant="outline" size="lg" wire:navigate
                            class="hover:scale-105 transition-transform duration-300">
                            Browse Exhibitors
                        </x-button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Participation Steps Section -->
        <section class="py-24 bg-surface-muted/30 border-y border-subtle">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                    <x-heading level="h2" title="How to" highlight="Participate" align="center"
                        class="mb-4 text-brand-accent dark:text-text-primary" />
                    <p class="text-text-secondary text-base">
                        Get involved in the region's premier corporate exhibitor expo and creator conference in three simple steps.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-5xl mx-auto">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center text-center reveal reveal-delay-100">
                        <div class="w-16 h-16 bg-brand-primary rounded-full flex items-center justify-center text-2xl font-bold text-text-inverse mb-6 shadow-lg shadow-brand-primary/10">
                            01
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-text-primary">Select Pass Tier</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">
                            Choose between a free General Attendee ticket or reserve a custom Corporate Exhibitor Booth space for your brand.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex flex-col items-center text-center reveal reveal-delay-200">
                        <div class="w-16 h-16 bg-brand-primary rounded-full flex items-center justify-center text-2xl font-bold text-text-inverse mb-6 shadow-lg shadow-brand-primary/10">
                            02
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-text-primary">Configure Assets</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">
                            Complete your registration profile and upload your corporate logo/details to be featured across our display channels.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex flex-col items-center text-center reveal reveal-delay-300">
                        <div class="w-16 h-16 bg-brand-primary rounded-full flex items-center justify-center text-2xl font-bold text-text-inverse mb-6 shadow-lg shadow-brand-primary/10">
                            03
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-text-primary">Attend & Connect</h3>
                        <p class="text-text-secondary text-sm leading-relaxed">
                            Receive your PDF access ticket and payment receipt via email, then join 1,500+ participants on the expo floor.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bottom Promotional CTA -->
        <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand-accent rounded-[3rem] p-8 sm:p-16 text-center relative overflow-hidden shadow-xl reveal">
                <!-- Background Gradients -->
                <div class="absolute inset-0 bg-linear-to-r from-brand-primary/20 to-transparent pointer-events-none"></div>
                <div class="relative z-10 max-w-2xl mx-auto flex flex-col items-center">
                    <x-heading level="h2" title="Register for the" highlight="Conference Today" align="center"
                        highlightClass="text-[#65c4af]" class="text-text-inverse mb-4" />
                    <p class="text-text-inverse/85 text-base mb-10 leading-relaxed">
                        Secure your complimentary general admission ticket or reserve a prime exhibitor booth space inside
                        the expo hall. Space is strictly limited.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <x-button href="/events/submissions?tier=attendee" variant="outline" size="lg" wire:navigate
                            class="hover:scale-105 transition-transform duration-300">
                            Get Ticket
                        </x-button>
                        <x-button href="/events/submissions?tier=exhibitor" size="lg" wire:navigate
                            class="hover:scale-105 transition-transform duration-300">
                            Register Booth
                        </x-button>
                        <x-button href="/events/browse" variant="outline" size="lg" wire:navigate
                            class="hover:scale-105 transition-transform duration-300 border-white/20 text-white hover:bg-white/10">
                            Browse Exhibitors
                        </x-button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
