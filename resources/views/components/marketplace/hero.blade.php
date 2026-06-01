@props(['allCategories' => []])

<section class="relative min-h-[85vh] flex items-center justify-center pt-32 pb-20 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/home/hero-bg.webp') }}" class="w-full h-full object-cover"
            alt="Hero background - Rays of light illuminating a stage" fetchpriority="high" decoding="sync">
        <div class="absolute inset-0 bg-black/20 bg-linear-to-b from-black/40 via-transparent to-black/60"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <x-heading level="h1" title="Book Top Talent" align="center" class="text-white mb-8" />
        <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto font-medium leading-relaxed">
            Connect with creative talent and professional services for your projects and productions.
        </p>

        <!-- Search Bar -->
        <form action="/marketplace/browse" method="GET" class="relative max-w-4xl mx-auto mb-10 group" wire:navigate>
            <div
                class="flex flex-col md:flex-row gap-3 p-3 md:p-2 bg-white/10 backdrop-blur-xl rounded-xl md:rounded-full border border-white/20 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transition-all duration-500 hover:bg-white/15">
                <x-input name="search" placeholder="Search by name, genre, or location..." icon="search"
                    class="flex-1 bg-transparent border-none text-white placeholder-white/50 ring-0 py-4 md:py-5 text-lg md:text-xl" />
                <x-button type="submit" variant="primary" class="active:scale-95 transform flex-1/4">
                    Find Talent
                </x-button>
            </div>
        </form>

        <!-- Quick Links / Categories -->
        <div
            class="flex flex-wrap justify-center gap-x-6 md:gap-x-12 gap-y-6 mt-12 text-xs font-bold uppercase tracking-widest text-white/80">
            @foreach($allCategories as $cat)
            <a href="/marketplace/browse?category={{ $cat->slug }}" wire:navigate
                class="hover:text-brand-primary transition-all hover:scale-105 transform whitespace-nowrap">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>
</section>
