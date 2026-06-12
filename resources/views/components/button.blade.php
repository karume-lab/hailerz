@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none active:scale-95 uppercase tracking-widest whitespace-nowrap';
    
    $variants = [
        'primary' => 'bg-brand-primary text-text-inverse hover:bg-brand-primary/90 shadow-sm focus:ring-brand-primary',
        'secondary' => 'bg-transparent border border-brand-primary text-brand-primary focus:ring-brand-primary',
        'accent' => 'bg-brand-secondary text-text-inverse hover:bg-brand-secondary/90 focus:ring-brand-secondary shadow-lg shadow-brand-secondary/20',
        'ghost' => 'bg-transparent text-text-secondary hover:bg-surface-muted hover:text-text-primary focus:ring-surface-muted',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-[11px]',
        'md' => 'px-6 py-3.5 text-sm',
        'lg' => 'px-10 py-5 text-base',
    ];

    $currentVariant = (string) ($variant ?? 'primary');
    $currentSize = (string) ($size ?? 'md');
    
    // Detect loading intent - explicit wire:target takes priority,
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
                class="inline-flex items-center justify-center"
            >{{ $slot }}</span>

            {{-- Spinner: hidden by default, shown by Livewire's wire:loading during network requests --}}
            <span
                wire:loading.flex
                @if($loadingTarget) wire:target="{{ $loadingTarget }}" @endif
                class="absolute inset-0 items-center justify-center"
                style="display: none;"
            >
                <x-lucide-loader-2 class="animate-spin h-[1.2em] w-[1.2em]" stroke-width="3.5" />
            </span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif
