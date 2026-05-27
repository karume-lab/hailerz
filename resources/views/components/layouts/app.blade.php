<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Premium talent booking agency connecting you with top musicians, variety artists, DJs, and performers for unforgettable events.">
  <meta name="theme-color" content="#21395c">
  <link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">

  <title>{{ $title ?? 'Hailerz | Premium Talent Booking Agency' }}</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $ogTitle ?? ($title ?? 'Hailerz | Premium Talent Booking Agency') }}">
  <meta property="og:description"
    content="{{ $ogDescription ?? 'A boutique talent agency specializing in securing premium performers for corporate events, galas, and private functions.' }}">
  <meta property="og:image" content="{{ $ogImage ?? asset('images/logo.webp') }}">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="{{ url()->current() }}">
  <meta name="twitter:title" content="{{ $ogTitle ?? ($title ?? 'Hailerz | Premium Talent Booking Agency') }}">
  <meta name="twitter:description"
    content="{{ $ogDescription ?? 'A boutique talent agency specializing in securing premium performers for corporate events, galas, and private functions.' }}">
  <meta name="twitter:image" content="{{ $ogImage ?? asset('images/logo.webp') }}">

  <link rel="manifest" href="{{ asset('manifest.json') }}">

  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <!-- Asynchronous Google Fonts Loader -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" media="print" onload="this.media='all'">
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
  </noscript>

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

  @if(config('services.ir.token'))
  <meta name='ir-site-verification-token' value='{{ config('services.ir.token') }}'>
  @endif
</head>

<body class="bg-surface-light text-text-primary antialiased flex flex-col min-h-screen transition-colors duration-300">

  <header
    class="sticky top-0 z-50 w-full backdrop-blur-xl bg-surface-light/90 border-b border-subtle transition-colors duration-300">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="shrink-0 flex items-center">
          <a href="/" class="flex items-center gap-2.5" aria-label="Hailerz Home">
            <img src="{{ asset('images/logo.webp') }}" alt="" aria-hidden="true" width="32" height="33"
              class="h-8 w-auto object-contain rounded" />
            <span
              class="text-xl sm:text-2xl font-semibold tracking-tight text-brand-primary transition-colors">
              Hailerz
            </span>
          </a>
        </div>
        <nav class="hidden lg:flex items-center space-x-10">
          <a href="/talent" wire:navigate
            class="{{ request()->is('talent*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors">
            Browse Talent</a>
          <a href="/services" wire:navigate
            class="{{ request()->is('services*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors">Services</a>
          <a href="/about" wire:navigate
            class="{{ request()->is('about*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors">About</a>
          <a href="/resources" wire:navigate
            class="{{ request()->is('resources*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors">Resources</a>
          <a href="/staffing" wire:navigate
            class="{{ request()->is('staffing*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors">Staffing</a>
          <a href="/contact" wire:navigate
            class="{{ request()->is('contact*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors">Contact</a>
        </nav>

        <div class="flex items-center space-x-4 sm:space-x-4">
          <div class="hidden lg:flex items-center space-x-4">
            <x-theme-toggle />
            <a href="/join" wire:navigate
              class="{{ request()->is('join*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors text-sm font-medium">Submissions</a>
          </div>

          <x-button variant="primary" size="sm" href="/book" wire:navigate
            class="border-none shadow-sm px-4 sm:px-6 py-2 sm:py-2.5 rounded-full hover:scale-105 transition-transform text-[10px] sm:text-sm">
            Book Now
          </x-button>
          
          <x-mobile-menu />
        </div>
      </div>
    </div>
  </header>

  <main class="grow">
    {{ $slot }}
  </main>

  <footer class="bg-surface-light text-text-primary border-t border-subtle ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
        <div class="col-span-1 md:col-span-1">
          <a href="/" class="flex items-center gap-2.5 mb-6" aria-label="Hailerz Home">
            <img src="{{ asset('images/logo.webp') }}" alt="" aria-hidden="true" width="32" height="33"
              class="h-8 w-auto object-contain rounded" />
            <span class="text-2xl font-bold tracking-tight text-brand-primary ">
              Hailerz
            </span>
          </a>
          <p class="text-text-secondary leading-relaxed text-sm mb-6">
            Premium talent booking for unforgettable events.
          </p>
          <div class="grid grid-cols-3 gap-3 sm:gap-4 w-fit mt-4">
            <a href="https://www.facebook.com/hailerzdotcom/" target="_blank" rel="noopener"
              aria-label="Connect with Hailerz on Facebook"
              class="h-11 w-11 sm:h-12 sm:w-12 rounded-full bg-surface-muted hover:bg-brand-secondary/20 transition-all duration-300 flex items-center justify-center text-text-secondary hover:text-brand-primary border border-subtle/50">
              <x-lucide-facebook class="w-5 h-5" stroke-width="2" />
            </a>
            <a href="https://www.instagram.com/hailerzdotcom/" target="_blank" rel="noopener"
              aria-label="Follow Hailerz on Instagram"
              class="h-11 w-11 sm:h-12 sm:w-12 rounded-full bg-surface-muted hover:bg-brand-secondary/20 transition-all duration-300 flex items-center justify-center text-text-secondary hover:text-brand-primary border border-subtle/50">
              <x-lucide-instagram class="w-5 h-5" stroke-width="2" />
            </a>
            <a href="https://x.com/hailerzdotcom" target="_blank" rel="noopener" aria-label="Follow Hailerz on X"
              class="h-11 w-11 sm:h-12 sm:w-12 rounded-full bg-surface-muted hover:bg-brand-secondary/20 transition-all duration-300 flex items-center justify-center text-text-secondary hover:text-brand-primary border border-subtle/50">
              <x-lucide-twitter class="w-5 h-5" stroke-width="2" />
            </a>
            <a href="https://www.youtube.com/@hailerzdotcom" target="_blank" rel="noopener"
              aria-label="Subscribe to Hailerz on YouTube"
              class="h-11 w-11 sm:h-12 sm:w-12 rounded-full bg-surface-muted hover:bg-brand-secondary/20 transition-all duration-300 flex items-center justify-center text-text-secondary hover:text-brand-primary border border-subtle/50">
              <x-lucide-youtube class="w-5 h-5" stroke-width="2" />
            </a>
            <a href="https://www.tiktok.com/@hailerzdotcom" target="_blank" rel="noopener"
              aria-label="Follow Hailerz on TikTok"
              class="h-11 w-11 sm:h-12 sm:w-12 rounded-full bg-surface-muted hover:bg-brand-secondary/20 transition-all duration-300 flex items-center justify-center text-text-secondary hover:text-brand-primary border border-subtle/50">
              <x-lucide-tiktok class="w-5 h-5" stroke-width="2" />
            </a>
            <a href="https://www.linkedin.com/company/hailerz-global-talent/" target="_blank" rel="noopener"
              aria-label="Connect with Hailerz on LinkedIn"
              class="h-11 w-11 sm:h-12 sm:w-12 rounded-full bg-surface-muted hover:bg-brand-secondary/20 transition-all duration-300 flex items-center justify-center text-text-secondary hover:text-brand-primary border border-subtle/50">
              <x-lucide-linkedin class="w-5 h-5" stroke-width="2" />
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Discover</h3>
          <ul class="space-y-4">
            <li><a href="/talent" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Browse Talent</a></li>
            @foreach($allCategories->take(4) as $cat)
            <li><a href="/talent?category={{ $cat->slug }}"
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">{{ $cat->name }}</a></li>
            @endforeach
          </ul>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Company</h3>
          <ul class="space-y-4">
            <li><a href="/about" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">About</a></li>
            <li><a href="/services" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Services</a></li>
            <li><a href="/resources" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Resources</a></li>
            <li><a href="/staffing" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Staffing</a></li>
            <li><a href="/join" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Join the Roster</a></li>
            <li><a href="/contact" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Contact</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Inquiries</h3>
          <p class="text-sm text-text-secondary mb-6">Ready to elevate your next event with premium talent?</p>
          <x-button variant="primary" size="sm" class="w-full" href="/book" wire:navigate>
            Book Now
          </x-button>
        </div>
      </div>

      <div class="mt-20 pt-8 border-t border-subtle flex flex-col md:row justify-between items-center gap-6">
        <p class="text-xs text-text-muted">
          &copy; {{ date('Y') }} Hailerz Premium Talent Booking. All rights reserved.
        </p>
        <div class="flex gap-8">
          <a href="/legal/privacy" wire:navigate
            class="text-xs text-text-muted hover:text-brand-primary transition-colors">Privacy</a>
          <a href="/legal/terms" wire:navigate
            class="text-xs text-text-muted hover:text-brand-primary transition-colors">Terms</a>
          <a href="/legal/booking-agreement" wire:navigate
            class="text-xs text-text-muted hover:text-brand-primary transition-colors">Booking Agreement</a>
        </div>
      </div>
    </div>
  </footer>

  @livewireScripts
  <script>
    let scrollObserver = null;

    function setupScrollReveals() {
      if (!scrollObserver) {
        const observerOptions = {
          threshold: 0.1,
          rootMargin: '0px 0px -50px 0px'
        };

        scrollObserver = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('revealed');
              scrollObserver.unobserve(entry.target);
            }
          });
        }, observerOptions);
      }

      document.querySelectorAll('.reveal:not(.revealed)').forEach(el => {
        scrollObserver.observe(el);
      });
    }

    setupScrollReveals();
    document.addEventListener('livewire:navigated', () => {
      setupScrollReveals();
      if (window.lenis) {
        window.lenis.resize();
      }
    });

    document.addEventListener('livewire:initialized', () => {
      Livewire.hook('morph.updated', () => {
        setupScrollReveals();
      });
    });
  </script>
  <x-built-by />
  
  @unless(Route::is('contracts.*'))
    @include('partials.tawk')
  @endunless
</body>

</html>