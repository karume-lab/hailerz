<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Hailerz is a premium talent booking agency connecting event planners with world-class performers, keynote speakers, and corporate entertainers.">

    <title>{{ $title ?? 'Hailerz | Premium Talent Booking Agency' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:600,700&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function applyTheme() {
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
        applyTheme();
        document.addEventListener('livewire:navigated', applyTheme);
    </script>
    @livewireStyles
</head>

<body class="bg-surface-light text-text-primary font-sans antialiased flex flex-col min-h-screen transition-colors duration-300">

    <header
        class="sticky top-0 z-50 w-full backdrop-blur-xl bg-surface-dark/90 border-b border-white/5 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2.5">
                        <div class="h-10 w-10 bg-brand-teal rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">H</span>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-text-inverse hidden sm:block font-serif">
                            Hailerz
                        </span>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-10">
                    <a href="/talent" wire:navigate
                        class="text-sm font-semibold {{ request()->is('talent*') ? 'text-brand-teal' : 'text-text-muted hover:text-brand-teal' }} transition-colors uppercase tracking-wider">The Roster</a>
                    <a href="/services" wire:navigate
                        class="text-sm font-semibold {{ request()->is('services*') ? 'text-brand-teal' : 'text-text-muted hover:text-brand-teal' }} transition-colors uppercase tracking-wider">Services</a>
                    <a href="/staffing" wire:navigate
                        class="text-sm font-semibold {{ request()->is('staffing*') ? 'text-brand-teal' : 'text-text-muted hover:text-brand-teal' }} transition-colors uppercase tracking-wider">Staffing</a>
                    <a href="/about" wire:navigate
                        class="text-sm font-semibold {{ request()->is('about*') ? 'text-brand-teal' : 'text-text-muted hover:text-brand-teal' }} transition-colors uppercase tracking-wider">The Agency</a>
                </nav>

                <div class="flex items-center space-x-6">
                    <!-- Theme Toggle -->
                    <button x-data="{ 
                            darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
                            toggleTheme() {
                                this.darkMode = !this.darkMode;
                                localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                                document.documentElement.classList.toggle('dark', this.darkMode);
                            }
                        }" @click="toggleTheme()"
                        class="p-2 rounded-lg bg-white/5 text-text-muted hover:text-brand-teal transition-all duration-300 focus:outline-none border border-white/5"
                        title="Toggle dark mode">
                        <svg x-show="!darkMode" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>

                    <x-button variant="primary" size="sm" href="/book" wire:navigate>
                        Booking Inquiry
                    </x-button>
                </div>
            </div>
        </div>
    </header>

    <main class="grow">
        {{ $slot }}
    </main>

    <footer class="bg-surface-dark text-text-inverse border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
                <div class="col-span-1 md:col-span-1">
                    <a href="/" class="flex items-center gap-2.5 mb-6">
                        <div class="h-8 w-8 bg-brand-teal rounded flex items-center justify-center">
                            <span class="text-white font-bold text-lg">H</span>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-text-inverse font-serif">
                            Hailerz
                        </span>
                    </a>
                    <p class="text-text-secondary leading-relaxed text-sm mb-6">
                        A boutique talent agency specializing in securing world-class performers for corporate events, galas, and private functions.
                    </p>
                    <div class="flex gap-4">
                        <!-- Social placeholders -->
                        <div class="h-8 w-8 rounded bg-white/5 hover:bg-brand-teal/20 transition-colors"></div>
                        <div class="h-8 w-8 rounded bg-white/5 hover:bg-brand-teal/20 transition-colors"></div>
                        <div class="h-8 w-8 rounded bg-white/5 hover:bg-brand-teal/20 transition-colors"></div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-brand-teal uppercase tracking-widest mb-6">The Roster</h3>
                    <ul class="space-y-4">
                        <li><a href="/talent" wire:navigate class="text-sm text-text-secondary hover:text-brand-teal transition-colors">All Talent</a></li>
                        <li><a href="/talent?category=keynote" class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Keynote Speakers</a></li>
                        <li><a href="/talent?category=musicians" class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Live Musicians</a></li>
                        <li><a href="/talent?category=performers" class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Corporate Performers</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-brand-teal uppercase tracking-widest mb-6">Agency</h3>
                    <ul class="space-y-4">
                        <li><a href="/about" wire:navigate class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Our Story</a></li>
                        <li><a href="/services" wire:navigate class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Services</a></li>
                        <li><a href="/staffing" wire:navigate class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Staffing & Augmentation</a></li>
                        <li><a href="/join" wire:navigate class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Join the Roster</a></li>
                        <li><a href="/contact" wire:navigate class="text-sm text-text-secondary hover:text-brand-teal transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold text-brand-teal uppercase tracking-widest mb-6">Secure the Act</h3>
                    <p class="text-sm text-text-secondary mb-6">Ready to elevate your next event with premium talent?</p>
                    <x-button variant="navy" size="sm" class="w-full border border-white/10" href="/book" wire:navigate>
                        Start Inquiry
                    </x-button>
                </div>
            </div>

            <div class="mt-20 pt-8 border-t border-white/5 flex flex-col md:row justify-between items-center gap-6">
                <p class="text-xs text-text-muted">
                    &copy; {{ date('Y') }} Hailerz Premium Talent Booking. All rights reserved.
                </p>
                <div class="flex gap-8">
                    <a href="/legal/privacy" wire:navigate class="text-xs text-text-muted hover:text-brand-teal transition-colors">Privacy</a>
                    <a href="/legal/terms" wire:navigate class="text-xs text-text-muted hover:text-brand-teal transition-colors">Terms</a>
                    <a href="/legal/booking-agreement" wire:navigate class="text-xs text-text-muted hover:text-brand-teal transition-colors">Booking Agreement</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>