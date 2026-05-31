<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#21395c">
  <link rel="apple-touch-icon" href="{{ asset('images/logo.webp') }}">

  <title>{{ $title ?? 'Authentication | Hailerz' }}</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface-light text-text-primary antialiased flex flex-col min-h-screen transition-colors duration-300">
  <div class="flex min-h-screen w-full flex-col md:flex-row">
    <div class="flex-1 flex flex-col justify-center items-center p-8 md:p-12 max-w-full md:max-w-[50%] bg-surface-light">
      <div class="w-full max-w-[24rem]">
        
        @if (session('status'))
        <div class="p-4 rounded-lg mb-6 text-sm bg-emerald-700/10 text-emerald-700 border border-emerald-700/20">
          {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="p-4 rounded-lg mb-6 text-sm bg-brand-crimson/10 text-brand-crimson border border-brand-crimson/20">
          <ul class="m-0 pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        {{ $slot }}

      </div>
    </div>
    <div class="hidden md:block flex-1 bg-cover bg-center rounded-l-4xl shadow-[-10px_0_30px_rgba(0,0,0,0.1)] relative overflow-hidden bg-surface-muted" style="background-image: url('{{ asset($image ?? "images/auth-bg.webp") }}')">
      <div class="absolute inset-0 bg-linear-to-r from-white/10 to-black/20"></div>
    </div>
  </div>
</body>

</html>
