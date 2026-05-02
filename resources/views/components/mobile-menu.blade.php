@props([
    'links' => [
        ['label' => 'Talent', 'href' => '/talent'],
        ['label' => 'Services', 'href' => '/services'],
        ['label' => 'Staffing', 'href' => '/staffing'],
        ['label' => 'The Agency', 'href' => '/about'],
        ['label' => 'Resources', 'href' => '/resources'],
    ]
])

<div x-data="{ open: false }" class="md:hidden">
    <!-- Hamburger Button -->
    <button @click="open = !open" 
        class="relative z-50 p-2 text-text-primary hover:text-brand-primary transition-colors focus:outline-none"
        aria-label="Toggle Mobile Menu">
        <div class="w-6 h-5 relative flex items-center justify-center">
            <span :class="open ? 'rotate-45' : '-translate-y-2'" 
                class="absolute w-full h-0.5 bg-current transition-all duration-300 rounded-full"></span>
            <span :class="open ? 'opacity-0' : 'opacity-100'" 
                class="absolute w-full h-0.5 bg-current transition-all duration-300 rounded-full"></span>
            <span :class="open ? '-rotate-45' : 'translate-y-2'" 
                class="absolute w-full h-0.5 bg-current transition-all duration-300 rounded-full"></span>
        </div>
    </button>

    <!-- Mobile Menu Overlay -->
    <template x-teleport="body">
        <div x-show="open" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-[-100%]"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-[-100%]"
            class="fixed inset-0 z-40 bg-surface-light/98 backdrop-blur-2xl flex flex-col pt-32 px-8 overflow-hidden"
            @keydown.window.escape="open = false">
            
            <nav class="flex flex-col space-y-8">
                @foreach($links as $link)
                    <a href="{{ $link['href'] }}" 
                        wire:navigate
                        @click="open = false"
                        class="text-4xl font-bold tracking-tight text-text-primary hover:text-brand-primary transition-all duration-300 font-serif {{ request()->is(ltrim($link['href'], '/') . '*') ? 'text-brand-primary' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto pb-12 space-y-8">
                <div class="h-px bg-subtle w-full"></div>
                <div class="flex flex-col gap-6">
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-bold text-text-muted uppercase tracking-widest">Theme</span>
                            <x-theme-toggle />
                        </div>
                        <div class="flex flex-col gap-1 items-end">
                            <span class="text-[10px] font-bold text-text-muted uppercase tracking-widest">Connect</span>
                            <div class="flex gap-4">
                                <a href="#" aria-label="Connect on LinkedIn" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                </a>
                                <a href="#" aria-label="Follow on Instagram" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
