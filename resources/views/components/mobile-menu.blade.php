@props([
    'links' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Talent', 'href' => '/talent'],
        ['label' => 'Services', 'href' => '/services'],
        ['label' => 'Staffing', 'href' => '/staffing'],
        ['label' => 'About', 'href' => '/about'],
        ['label' => 'Contact', 'href' => '/contact'],
        ['label' => 'Submissions', 'href' => '/join'],
    ]
])

<div x-data="{ open: false }" class="lg:hidden">
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
                        class="text-xl {{ request()->is(ltrim($link['href'], '/') . '*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors uppercase tracking-widest">
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
                            <div class="flex flex-wrap justify-end gap-4">
                                <a href="https://www.facebook.com/hailerzdotcom/" target="_blank" rel="noopener" aria-label="Connect on Facebook" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <x-lucide-facebook class="w-6 h-6" stroke-width="2" />
                                </a>
                                <a href="https://www.instagram.com/hailerzdotcom/" target="_blank" rel="noopener" aria-label="Follow on Instagram" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <x-lucide-instagram class="w-6 h-6" stroke-width="2" />
                                </a>
                                <a href="https://x.com/hailerzdotcom" target="_blank" rel="noopener" aria-label="Follow on X" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <x-lucide-twitter class="w-6 h-6" stroke-width="2" />
                                </a>
                                <a href="https://www.youtube.com/@hailerzdotcom" target="_blank" rel="noopener" aria-label="Subscribe on YouTube" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <x-lucide-youtube class="w-6 h-6" stroke-width="2" />
                                </a>
                                <a href="https://www.tiktok.com/@hailerzdotcom" target="_blank" rel="noopener" aria-label="Follow on TikTok" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <x-lucide-tiktok class="w-6 h-6" stroke-width="2" />
                                </a>
                                <a href="https://www.linkedin.com/company/hailerz-global-talent/" target="_blank" rel="noopener" aria-label="Connect on LinkedIn" class="text-text-secondary hover:text-brand-primary transition-colors">
                                    <x-lucide-linkedin class="w-6 h-6" stroke-width="2" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
