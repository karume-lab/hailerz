<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Hailerz is a premium talent booking agency connecting event planners with world-class performers, keynote speakers, and corporate entertainers.">
    <meta name="theme-color" content="#21395c">
    <link rel="apple-touch-icon" href="/images/logo.webp">

    <title>{{ $title ?? 'Hailerz | Premium Talent Booking Agency' }}</title>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $ogTitle ?? ($title ?? 'Hailerz | Premium Talent Booking Agency') }}">
    <meta property="og:description" content="{{ $ogDescription ?? 'A boutique talent agency specializing in securing world-class performers for corporate events, galas, and private functions.' }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/logo.webp') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $ogTitle ?? ($title ?? 'Hailerz | Premium Talent Booking Agency') }}">
    <meta name="twitter:description" content="{{ $ogDescription ?? 'A boutique talent agency specializing in securing world-class performers for corporate events, galas, and private functions.' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/logo.webp') }}">

    <!-- Self-hosted fonts loaded via @font-face + font-display:swap in app.css -->
    <link rel="manifest" href="/manifest.json">

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="/images/logo.webp" type="image/webp">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function applyTheme() {
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            window.dispatchEvent(new CustomEvent('theme-changed', { detail: { isDark } }));
        }

        applyTheme();
        document.addEventListener('livewire:navigated', applyTheme);
    </script>

    @stack('head')
    @livewireStyles
</head>

<body class="bg-surface-light text-text-primary font-sans antialiased flex flex-col min-h-screen transition-colors duration-300">

    <header
        class="sticky top-0 z-50 w-full backdrop-blur-xl bg-surface-light/90 border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2.5" aria-label="Hailerz Home">
                        <img src="/images/logo.webp" alt="" aria-hidden="true" width="40" height="41" class="h-10 w-auto object-contain rounded-lg" />
                        <span class="text-2xl font-bold tracking-tight text-brand-navy dark:text-white hidden sm:block font-serif">
                            Hailerz
                        </span>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-10">
                    <a href="/talent" wire:navigate
                        class="text-sm font-semibold {{ request()->is('talent*') ? 'text-brand-teal' : 'text-text-secondary hover:text-brand-teal' }} transition-colors uppercase tracking-wider">The Roster</a>
                    <a href="/services" wire:navigate
                        class="text-sm font-semibold {{ request()->is('services*') ? 'text-brand-teal' : 'text-text-secondary hover:text-brand-teal' }} transition-colors uppercase tracking-wider">Services</a>
                    <a href="/staffing" wire:navigate
                        class="text-sm font-semibold {{ request()->is('staffing*') ? 'text-brand-teal' : 'text-text-secondary hover:text-brand-teal' }} transition-colors uppercase tracking-wider">Staffing</a>
                    <a href="/about" wire:navigate
                        class="text-sm font-semibold {{ request()->is('about*') ? 'text-brand-teal' : 'text-text-secondary hover:text-brand-teal' }} transition-colors uppercase tracking-wider">The Agency</a>
                </nav>

                <div class="flex items-center space-x-6">
                    <!-- Theme Toggle -->
                    <x-theme-toggle />

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

    <footer class="bg-surface-light text-text-primary border-t border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
                <div class="col-span-1 md:col-span-1">
                    <a href="/" class="flex items-center gap-2.5 mb-6" aria-label="Hailerz Home">
                        <img src="/images/logo.webp" alt="" aria-hidden="true" width="32" height="33" class="h-8 w-auto object-contain rounded" />
                        <span class="text-2xl font-bold tracking-tight text-text-primary font-serif">
                            Hailerz
                        </span>
                    </a>
                    <p class="text-text-secondary leading-relaxed text-sm mb-6">
                        A boutique talent agency specializing in securing world-class performers for corporate events, galas, and private functions.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" aria-label="Follow us on LinkedIn" class="h-12 w-12 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-brand-teal/20 transition-colors flex items-center justify-center text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="#" aria-label="Follow us on Instagram" class="h-12 w-12 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-brand-teal/20 transition-colors flex items-center justify-center text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" aria-label="Follow us on Twitter" class="h-12 w-12 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-brand-teal/20 transition-colors flex items-center justify-center text-gray-600 dark:text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
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

            <div class="mt-20 pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:row justify-between items-center gap-6">
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