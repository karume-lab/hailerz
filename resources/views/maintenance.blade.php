<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance | Hailerz</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface-dark text-text-inverse flex items-center justify-center min-h-screen px-6 antialiased font-sans overflow-hidden">
    <!-- Bouncing Logo Container -->
    <div class="fixed inset-0 pointer-events-none z-50">
        <div id="bouncing-logo" class="absolute h-24 w-auto flex items-center justify-center">
            <img src="{{ asset('images/logo.webp') }}" alt="Hailerz Logo" class="h-full w-auto rounded-2xl shadow-2xl border border-subtle">
        </div>
    </div>

    <div class="max-w-md w-full text-center relative z-10">
        <h1 class="text-4xl font-bold mb-4 tracking-tight text-brand-secondary">Under Maintenance</h1>
        <p class="text-text-inverse/70 text-lg leading-relaxed mb-8">
            We're currently performing some scheduled maintenance to improve our digital roster experience. We'll be back shortly!
        </p>
        <div class="text-text-inverse/50 text-sm font-semibold tracking-widest uppercase">
            &copy; {{ date('Y') }} Hailerz Agency.
        </div>
    </div>

    <style>
        #bouncing-logo {
            animation: bounce-x 13s linear infinite alternate, 
                       bounce-y 7s linear infinite alternate;
        }

        @keyframes bounce-x {
            from { left: 0; }
            to { left: calc(100% - 180px); } /* Approximate width of logo */
        }

        @keyframes bounce-y {
            from { top: 0; }
            to { top: calc(100% - 96px); } /* Height h-24 (96px) */
        }
    </style>
</body>

</html>