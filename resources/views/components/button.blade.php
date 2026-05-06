@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none active:scale-95 uppercase tracking-widest whitespace-nowrap';
    
    $variants = [
        'primary' => 'bg-brand-primary text-text-inverse hover:bg-brand-primary/90 shadow-sm focus:ring-brand-primary',
        'secondary' => 'bg-surface-muted text-text-primary hover:bg-surface-muted/80 focus:ring-surface-muted',
        'accent' => 'bg-brand-secondary text-text-inverse hover:bg-brand-secondary/90 focus:ring-brand-secondary shadow-lg shadow-brand-secondary/20',
        'outline' => 'bg-transparent border border-brand-secondary text-brand-secondary hover:bg-brand-secondary hover:text-text-inverse focus:ring-brand-secondary',
        'ghost' => 'bg-transparent text-text-secondary hover:bg-surface-muted hover:text-text-primary focus:ring-surface-muted',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-[11px]',
        'md' => 'px-6 py-3.5 text-sm',
        'lg' => 'px-10 py-5 text-base',
    ];

    $currentVariant = (string) ($variant ?? 'primary');
    $currentSize = (string) ($size ?? 'md');
    
    // Detect loading intent
    $loadingTarget = $attributes->get('wire:target');
    if (!$loadingTarget && $attributes->has('wire:click')) {
        $loadingTarget = $attributes->get('wire:click');
    }
    
    $hasLoading = $loadingTarget || $attributes->has('loading') || $attributes->get('type') === 'submit';

    $classes = $baseClasses . ' ' . ($variants[$currentVariant] ?? $variants['primary']) . ' ' . ($sizes[$currentSize] ?? $sizes['md']);
    if ($hasLoading) {
        $classes .= ' relative';
    }
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => 'button']) }}>
        @if($hasLoading)
            <span wire:loading.class="invisible" @if($loadingTarget) wire:target="{{ $loadingTarget }}" @endif>
                {{ $slot }}
            </span>
            <div wire:loading @if($loadingTarget) wire:target="{{ $loadingTarget }}" @endif class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                <x-lucide-loader-2 class="animate-spin h-[1.2em] w-[1.2em]" stroke-width="3.5" />
            </div>
        @else
            {{ $slot }}
        @endif
    </button>
@endif

