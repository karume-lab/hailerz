@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold transition-all duration-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
    
    $variants = [
        'primary' => 'bg-brand-primary text-text-inverse hover:brightness-110 shadow-lg shadow-brand-primary/20 focus:ring-brand-primary',
        'secondary' => 'bg-transparent border-2 border-brand-secondary text-brand-secondary hover:bg-brand-secondary hover:text-text-inverse focus:ring-brand-secondary',
        'outline' => 'bg-transparent border-2 border-brand-primary text-brand-primary hover:bg-brand-primary hover:text-text-inverse focus:ring-brand-primary',
        'ghost' => 'bg-transparent text-text-secondary hover:bg-surface-muted hover:text-text-primary focus:ring-surface-muted',
        'navy' => 'bg-brand-primary text-text-inverse hover:brightness-110 focus:ring-brand-primary',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
    ];

    $classes = $baseClasses . ' ' . ($variants[(string)$variant] ?? $variants['primary']) . ' ' . ($sizes[(string)$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => 'button']) }}>
        {{ $slot }}
    </button>
@endif
