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

  @production
    <script>
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
          navigator.serviceWorker.register('/sw.js');
        });
      }
    </script>
  @else
    <script>
      // Auto-unregister service workers in development to prevent stale cache issues
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.getRegistrations().then(function (registrations) {
          for (let registration of registrations) {
            registration.unregister();
            console.log('Service Worker unregistered');
          }
        });
      }
    </script>
  @endproduction

  <link rel="canonical" href="{{ url()->current() }}">
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
  @if(config('services.drift.id'))
  {{-- Start of Async Drift Code --}}
  <script>
    !function() {
      var t;
      if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void
        (window.console && console.error && console.error("Drift snippet included twice.")) :
        (t.invoked = !0,
        t.methods = ["identify","config","track","reset","debug","show","ping","page","hide","off","on"],
        t.factory = function(e) {
          return function() {
            var n;
            return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
          };
        }, t.methods.forEach(function(e) {
          t[e] = t.factory(e);
        }), t.load = function(t) {
          var e, n, o, i;
          e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"),
          o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous",
          o.src = "https://js.driftt.com/include/" + i + "/" + t + ".js",
          n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
        });
    }();
    drift.SNIPPET_VERSION = '0.3.1';
    drift.load('{{ config('services.drift.id') }}');
  </script>
  {{-- End of Async Drift Code --}}
  @endif


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
        <nav class="hidden md:flex items-center space-x-10">
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
          <div class="hidden md:flex items-center space-x-4">
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
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-tiktok">
                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" />
              </svg>
            </a>
            <a href="https://www.linkedin.com/company/hailerz-global-talent/" target="_blank" rel="noopener"
              aria-label="Connect with Hailerz on LinkedIn"
              class="h-11 w-11 sm:h-12 sm:w-12 rounded-full bg-surface-muted hover:bg-brand-secondary/20 transition-all duration-300 flex items-center justify-center text-text-secondary hover:text-brand-primary border border-subtle/50">
              <x-lucide-linkedin class="w-5 h-5" stroke-width="2" />
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Talent</h3>
          <ul class="space-y-4">
            <li><a href="/talent" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">All Talent</a></li>
            <li><a href="/talent?category=speakers"
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Speakers</a></li>
            <li><a href="/talent?category=musicians"
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Musicians</a></li>
            <li><a href="/talent?category=variety-artists"
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Variety Artists</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Agency</h3>
          <ul class="space-y-4">
            <li><a href="/about" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Our Story</a></li>
            <li><a href="/services" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Services</a></li>
            <li><a href="/staffing" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Staffing &
                Staffing</a></li>
            <li><a href="/join" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Join Talent</a></li>
            <li><a href="/contact" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Contact</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Secure Talent</h3>
          <p class="text-sm text-text-secondary mb-6">Ready to elevate your next event with premium talent?</p>
          <x-button variant="primary" size="sm" class="w-full" href="/book" wire:navigate>
            Start Inquiry
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
    function setupScrollReveals() {
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      }, observerOptions);

      document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    }

    setupScrollReveals();
    document.addEventListener('livewire:navigated', setupScrollReveals);
  </script>

</body>

</html>