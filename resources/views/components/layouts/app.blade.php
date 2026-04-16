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
    @livewireStyles
</head>

<body class="bg-canvas text-dark-muted font-sans antialiased flex flex-col min-h-screen">

    <header
        class="sticky top-0 z-50 w-full backdrop-blur-lg bg-white/70 border-b border-gray-200/50 support-backdrop-blur:bg-white/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2.5">
                        <img src="{{ asset('images/logo.webp') }}" alt="Hailerz Logo" class="h-10 w-auto">
                        <span class="text-2xl font-bold tracking-tight text-dark hidden sm:block">
                            Hailerz
                        </span>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-10">
                    <a href="/talent" wire:navigate
                        class="text-base font-medium {{ request()->is('talent*') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition-colors">Browse Talent</a>
                    <a href="/services" wire:navigate
                        class="text-base font-medium {{ request()->is('services*') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition-colors">Services</a>
                    <a href="/about" wire:navigate
                        class="text-base font-medium {{ request()->is('about*') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition-colors">About</a>
                    <a href="/news" wire:navigate
                        class="text-base font-medium {{ request()->is('news*') ? 'text-primary' : 'text-gray-700 hover:text-primary' }} transition-colors">Resources</a>
                </nav>
                <div class="flex items-center space-x-6">
                    <a href="/join" wire:navigate
                       class="hidden lg:block text-sm font-semibold text-gray-600 hover:text-primary transition-colors">
                        Join Roster
                    </a>
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
                    <p class="mt-4 text-sm text-gray-400 leading-relaxed">
                        Premium talent booking for unforgettable events. We connect visionary planners with world-class performers.
                    </p>
                    <div class="mt-6">
                        <a href="mailto:info@hailerz.com" class="text-sm text-primary font-semibold hover:text-white transition-colors">info@hailerz.com</a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Talent</h3>
                    <ul class="space-y-3">
                        <li><a href="/talent" wire:navigate class="text-sm text-gray-400 hover:text-white transition-colors">Browse All Talent</a></li>
                        <li><a href="/talent?category=musicians" class="text-sm text-gray-400 hover:text-white transition-colors">Musicians</a></li>
                        <li><a href="/talent?category=performers" class="text-sm text-gray-400 hover:text-white transition-colors">Variety Artists</a></li>
                        <li><a href="/talent?category=djs" class="text-sm text-gray-400 hover:text-white transition-colors">DJs</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="/about" wire:navigate class="text-sm text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="/services" wire:navigate class="text-sm text-gray-400 hover:text-white transition-colors">Services</a></li>
                        <li><a href="/join" wire:navigate class="text-sm text-gray-400 hover:text-white transition-colors">Join Our Roster</a></li>
                        <li><a href="/news" wire:navigate class="text-sm text-gray-400 hover:text-white transition-colors">Resources</a></li>
                        <li><a href="/contact" wire:navigate class="text-sm text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Get Started</h3>
                    <p class="text-sm text-gray-400 mb-4 leading-relaxed">Ready to book top talent for your next event?</p>
                    <a href="/book" wire:navigate class="inline-flex items-center justify-center w-full px-6 py-3 border border-transparent text-sm font-semibold rounded-md text-white bg-primary hover:bg-primary-dark transition shadow-lg">
                        Request Booking
                    </a>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 text-sm text-center text-gray-500">
                &copy; {{ date('Y') }} Hailerz Agency. All rights reserved.
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>