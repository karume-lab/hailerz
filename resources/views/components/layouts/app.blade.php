<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Hailerz connects fans with their favourite celebrities, and vice-versa. The video-sharing technology enables seamless exchange of pleasantries and wishes.">

    <title>{{ $title ?? 'Hailerz | Connect with your favourite celebrities' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

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

        // Initial application
        applyTheme();

        // Re-apply on Livewire navigation
        document.addEventListener('livewire:navigated', applyTheme);
    </script>
    @livewireStyles
</head>

<body class="bg-canvas text-text-main font-sans antialiased flex flex-col min-h-screen transition-colors duration-300">

    <header
        class="sticky top-0 z-50 w-full backdrop-blur-xl bg-dark/80 border-b border-white/10 transition-colors duration-300">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2.5">
                        <img src="{{ asset('images/logo.webp') }}" alt="Hailerz Logo" class="h-10 w-auto">
                        <span class="text-2xl font-bold tracking-tight text-white hidden sm:block">
                            Hailerz
                        </span>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-10">
                    <a href="/talent" wire:navigate
                        class="text-base font-medium {{ request()->is('talent*') ? 'text-primary' : 'text-gray-300 hover:text-primary' }} transition-colors">Browse
                        Talent</a>
                    <a href="/services" wire:navigate
                        class="text-base font-medium {{ request()->is('services*') ? 'text-primary' : 'text-gray-300 hover:text-primary' }} transition-colors">Services</a>
                    <a href="/about" wire:navigate
                        class="text-base font-medium {{ request()->is('about*') ? 'text-primary' : 'text-gray-300 hover:text-primary' }} transition-colors">About</a>
                    <a href="/news" wire:navigate
                        class="text-base font-medium {{ request()->is('news*') ? 'text-primary' : 'text-gray-300 hover:text-primary' }} transition-colors">Resources</a>
                </nav>
                <form action="/talent" method="GET" class="hidden lg:flex items-center flex-1 max-w-sm mx-8">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" placeholder="Find talent..."
                            class="block w-full pl-10 pr-3 py-2 bg-white/5 border border-white/10 rounded-full text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-all">
                    </div>
                </form>

                <div class="flex items-center space-x-6">
                    <a href="/join" wire:navigate
                        class="hidden xl:block text-sm font-semibold text-gray-300 hover:text-primary transition-colors">
                        Join
                    </a>

                    <!-- Theme Toggle -->
                    <button x-data="{ 
                            darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
                            toggleTheme() {
                                this.darkMode = !this.darkMode;
                                localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                                document.documentElement.classList.toggle('dark', this.darkMode);
                            }
                        }" @click="toggleTheme()"
                        class="p-2 rounded-lg bg-white/5 text-gray-400 hover:text-primary transition-all duration-300 focus:outline-none border border-white/5"
                        title="Toggle dark mode">
                        <svg x-show="!darkMode" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                        <svg x-show="darkMode" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </button>

                    <a href="/book" wire:navigate
                        class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-md text-white bg-primary hover:bg-primary-dark shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="grow">
        {{ $slot }}
    </main>

    <footer class="bg-dark border-t border-dark-muted text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="/" class="flex items-center gap-2.5 mb-4">
                        <img src="{{ asset('images/logo.webp') }}" alt="Hailerz Logo" class="h-8 w-auto">
                        <span class="text-2xl font-bold tracking-tight text-white">
                            Hailerz
                        </span>
                    </a>
                    <p class="mt-4 text-sm text-gray-300 leading-relaxed">
                        Premium talent booking for unforgettable events. We connect visionary planners with world-class
                        performers.
                    </p>
                    <div class="mt-6">
                        <a href="mailto:info@hailerz.com"
                            class="text-sm text-primary font-semibold hover:text-white transition-colors">info@hailerz.com</a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Talent</h3>
                    <ul class="space-y-3">
                        <li><a href="/talent" wire:navigate
                                class="text-sm text-gray-300 hover:text-white transition-colors">Browse All Talent</a>
                        </li>
                        <li><a href="/talent?category=musicians"
                                class="text-sm text-gray-300 hover:text-white transition-colors">Musicians</a></li>
                        <li><a href="/talent?category=performers"
                                class="text-sm text-gray-300 hover:text-white transition-colors">Variety Artists</a>
                        </li>
                        <li><a href="/talent?category=djs"
                                class="text-sm text-gray-300 hover:text-white transition-colors">DJs</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="/about" wire:navigate
                                class="text-sm text-gray-300 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="/services" wire:navigate
                                class="text-sm text-gray-300 hover:text-white transition-colors">Services</a></li>
                        <li><a href="/join" wire:navigate
                                class="text-sm text-gray-300 hover:text-white transition-colors">Join Our Roster</a>
                        </li>
                        <li><a href="/faqs" wire:navigate
                                class="text-sm text-gray-300 hover:text-white transition-colors">FAQs</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Get Started</h3>
                    <p class="text-sm text-gray-300 mb-4 leading-relaxed">Ready to book top talent for your next event?
                    </p>
                    <a href="/book" wire:navigate
                        class="inline-flex items-center justify-center w-full px-6 py-3 border border-transparent text-sm font-semibold rounded-md text-white bg-primary hover:bg-primary-dark transition shadow-lg">
                        Book Now
                    </a>
                </div>
            </div>

            <div
                class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-sm text-gray-500">
                    &copy; 2026 Hailerz. All rights reserved.
                </div>
                <div class="flex gap-8 text-sm text-gray-500">
                    <a href="/legal/privacy" wire:navigate class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="/legal/terms" wire:navigate class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>