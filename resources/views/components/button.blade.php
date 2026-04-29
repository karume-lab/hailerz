@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold transition-all duration-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
    
    $variants = [
        'primary' => 'bg-brand-teal text-text-inverse hover:bg-brand-teal/90 shadow-lg shadow-brand-teal/20 focus:ring-brand-teal',
        'secondary' => 'bg-surface-muted text-brand-navy border border-brand-navy/10 hover:border-brand-navy hover:bg-surface-light focus:ring-brand-navy',
        'outline' => 'bg-transparent border-2 border-brand-teal text-brand-teal hover:bg-brand-teal hover:text-text-inverse focus:ring-brand-teal',
        'ghost' => 'bg-transparent text-text-secondary hover:bg-surface-muted hover:text-text-primary focus:ring-surface-muted',
        'navy' => 'bg-brand-navy text-text-inverse hover:bg-brand-navy/90 focus:ring-brand-navy',
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
