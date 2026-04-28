<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hailerz | Premium Talent Booking Agency</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-muted text-text-primary font-sans antialiased min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full px-6 py-12 bg-white rounded-3xl shadow-2xl border border-brand-navy/5 text-center">
        <img src="/images/logo.webp" alt="Hailerz Logo" class="h-20 w-auto object-contain mx-auto mb-10 rounded-2xl" />
        
        <h1 class="text-4xl font-bold text-brand-navy mb-6 font-serif tracking-tight">Securing the Act.</h1>
        <p class="text-text-secondary text-lg mb-12 leading-relaxed">
            Welcome to Hailerz. We are a premium talent booking agency dedicated to world-class event production and executive entertainment.
        </p>

        <div class="flex flex-col gap-4">
            <x-button variant="primary" size="lg" href="/talent">
                Explore the Roster
            </x-button>
            <div class="flex items-center justify-center gap-6 mt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-brand-navy uppercase tracking-widest hover:text-brand-teal transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-brand-navy uppercase tracking-widest hover:text-brand-teal transition-colors">Client Login</a>
                    <a href="{{ route('register') }}" class="text-sm font-bold text-brand-navy uppercase tracking-widest hover:text-brand-teal transition-colors">Register</a>
                @endauth
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-brand-navy/5">
            <p class="text-xs font-bold text-text-muted uppercase tracking-widest">&copy; {{ date('Y') }} Hailerz Agency</p>
        </div>
    </div>
</body>
</html>
