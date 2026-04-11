<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hailerz Entertainment | Premier Talent Booking' }}</title>
    
    <!-- SEO -->
    <meta name="description" content="Discover and book premier talent for your events. From top musicians to keynote speakers and comedians.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&family=Outfit:wght@500..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full flex flex-col antialiased bg-slate-50 text-slate-900">
    
    <!-- Navigation -->
    <nav class="glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-10">
                    <a href="/" class="group flex items-center">
                        <span class="text-2xl font-serif font-black tracking-tighter text-slate-950 group-hover:text-primary-600 transition-colors">
                            HAILERZ ENTERTAINMENT
                        </span>
                    </a>
                    
                    <div class="hidden md:flex items-center gap-8">
                        <a href="/" class="text-sm font-semibold text-slate-600 hover:text-slate-950 transition-colors">Home</a>
                        <a href="/talent" class="text-sm font-semibold text-slate-600 hover:text-slate-950 transition-colors">Browse Talent</a>
                        <a href="/news" class="text-sm font-semibold text-slate-600 hover:text-slate-950 transition-colors">Industry News</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="/book" class="hidden sm:inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-white bg-slate-950 rounded-full hover:bg-slate-800 transition-all shadow-lg shadow-slate-200/50">
                        Check Availability
                    </a>
                    <button type="button" class="md:hidden p-2 text-slate-600">
                        <x-heroicon-o-bars-3 class="w-6 h-6" />
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-xl font-serif font-black tracking-tighter text-slate-950 mb-6 block">
                        HAILERZ ENTERTAINMENT
                    </span>
                    <p class="text-slate-500 max-w-sm mb-6 leading-relaxed">
                        Connecting the world's most iconic brands with elite entertainment talent since 2012. 
                        Your premier partner for corporate events, weddings, and high-profile bookings.
                    </p>
                    <div class="flex gap-4">
                        <!-- Social Icons -->
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Platform</h4>
                    <ul class="space-y-4">
                        <li><a href="/talent" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Browse Roster</a></li>
                        <li><a href="/news" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Industry Insights</a></li>
                        <li><a href="/careers" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Join the Team</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-6 uppercase text-xs tracking-widest">Company</h4>
                    <ul class="space-y-4">
                        <li><a href="/about" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Our Story</a></li>
                        <li><a href="/contact" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Contact</a></li>
                        <li><a href="/legal" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-400 text-xs text-center md:text-left">
                    &copy; {{ date('Y') }} Hailerz Entertainment. All rights reserved.
                </p>
                <div class="flex items-center gap-6 text-xs text-slate-400">
                    <span>Licensed Booking Agency</span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <span>Global Coverage</span>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
