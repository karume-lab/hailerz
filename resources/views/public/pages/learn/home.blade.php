<x-layouts.app>
    <x-slot:title>Hailerz Challenges | Hailerz</x-slot>
    
    <div class="bg-surface-light">
        <section class="relative min-h-[85vh] flex items-center justify-center pt-32 pb-20 overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/home/hero-bg.webp') }}" class="w-full h-full object-cover"
                    alt="Hero background - Rays of light illuminating a stage" fetchpriority="high" decoding="sync">
                <div class="absolute inset-0 bg-black/20 bg-linear-to-b from-black/40 via-transparent to-black/60"></div>
            </div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <x-heading level="h1" title="Hailerz Challenges" align="center" class="text-white mb-8" />
                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto font-medium leading-relaxed">
                    Elevate your craft, unlock technical masterclasses, and compete in global sprints.
                </p>

                <!-- Call to Action -->
                <div class="flex justify-center gap-4 mt-12">k
                    <x-button href="/challenges/browse" size="lg" class="active:scale-95 transform">
                        Browse Active Challenges
                    </x-button>
                </div>
            </div>
        </section>

        <section class="py-32 bg-surface-muted">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <x-heading level="h2" title="Join a Sprint in" highlight="Three Simple Steps" align="center"
                    class="text-text-primary mb-10" />
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <x-feature-card index="0" icon="search" title="Find a Challenge" desc="Browse our curated list of technical sprints, creative challenges, and workshops to find the perfect fit for your skills." iconVariant="secondary" />
                    <x-feature-card index="1" icon="user-check" title="Participate" desc="Follow the guidelines, complete the requirements, and submit your project directly through the platform." iconVariant="secondary" />
                    <x-feature-card index="2" icon="calendar-check" title="Win & Learn" desc="Earn rewards, gain peer recognition, and elevate your craft through active ecosystem participation." iconVariant="secondary" />
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
