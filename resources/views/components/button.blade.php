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
    
    // Detect loading intent — explicit wire:target takes priority,
    // then fall back to wire:click value, then type=submit (no target needed).
    $loadingTarget = $attributes->get('wire:target');
    if (!$loadingTarget && $attributes->has('wire:click')) {
        $loadingTarget = $attributes->get('wire:click');
    }
    
    $hasLoading = $loadingTarget || $attributes->has('loading') || $attributes->get('type') === 'submit';

    $classes = $baseClasses . ' ' . ($variants[$currentVariant] ?? $variants['primary']) . ' ' . ($sizes[$currentSize] ?? $sizes['md']);
    if ($hasLoading) {
        $classes .= ' relative overflow-hidden';
    }
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => 'button']) }}>
        @if($hasLoading)
            {{-- Text label: becomes invisible while loading but keeps button size stable --}}
            <span
                wire:loading.class="invisible"
                @if($loadingTarget) wire:target="{{ $loadingTarget }}" @endif
            >{{ $slot }}</span>

            {{-- Spinner: hidden by default (style), shown by Livewire's wire:loading during network requests --}}
            <span
                wire:loading
                @if($loadingTarget) wire:target="{{ $loadingTarget }}" @endif
                style="display:none"
                class="absolute inset-0 flex items-center justify-center"
            >
                <svg class="animate-spin h-[1.2em] w-[1.2em]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3.5"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif
