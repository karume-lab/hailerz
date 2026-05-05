@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none active:scale-95 uppercase tracking-widest text-[10px]';
    
    $variants = [
        'primary' => 'bg-brand-primary text-text-inverse hover:bg-brand-primary/90 shadow-sm focus:ring-brand-primary',
        'secondary' => 'bg-brand-secondary text-text-inverse hover:bg-brand-secondary/90 shadow-sm focus:ring-brand-secondary',
        'accent' => 'bg-brand-accent text-brand-primary font-bold hover:brightness-110 shadow-sm focus:ring-brand-accent',
        'outline' => 'bg-transparent border border-brand-secondary text-brand-secondary hover:bg-brand-secondary hover:text-text-inverse focus:ring-brand-secondary',
        'ghost' => 'bg-transparent text-text-secondary hover:bg-surface-muted hover:text-text-primary focus:ring-surface-muted',
    ];

    $sizes = [
        'sm' => 'px-4 py-2',
        'md' => 'px-6 py-3.5',
        'lg' => 'px-10 py-5',
    ];

    $currentVariant = (string) ($variant ?? 'primary');
    $currentSize = (string) ($size ?? 'md');
    $classes = $baseClasses . ' ' . ($variants[$currentVariant] ?? $variants['primary']) . ' ' . ($sizes[$currentSize] ?? $sizes['md']);
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
