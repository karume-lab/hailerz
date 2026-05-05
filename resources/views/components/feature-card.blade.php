@props([
    'icon' => null,
    'number' => null,
    'title',
    'desc',
    'index' => 0,
    'padding' => 'p-12',
    'iconVariant' => 'primary',
])

@php
    $delay = ($index % 3 === 1) ? 'reveal-delay-100' : (($index % 3 === 2) ? 'reveal-delay-200' : '');
    
    if ($iconVariant === 'secondary') {
        $iconClasses = 'bg-brand-secondary/10 text-brand-secondary';
    } elseif ($iconVariant === 'accent') {
        $iconClasses = 'bg-brand-accent/10 text-brand-accent';
    } elseif ($iconVariant === 'filled') {
        $iconClasses = 'bg-brand-primary text-text-inverse shadow-lg';
    } else {
        $iconClasses = 'bg-brand-primary/10 text-brand-primary';
    }
@endphp

<x-card :padding="$padding" {{ $attributes->merge(['class' => 'reveal ' . $delay]) }}>
    @if($icon || $number)
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform {{ $iconClasses }}">
            @if($icon)
                <x-dynamic-component :component="'lucide-' . $icon" class="w-8 h-8" stroke-width="2" />
            @else
                <span class="text-2xl font-bold">{{ $number }}</span>
            @endif
        </div>
    @endif
    <h3 class="text-2xl font-bold text-text-primary mb-4">{{ $title }}</h3>
    <p class="text-text-secondary leading-relaxed font-light">{{ $desc }}</p>
    {{ $slot }}
</x-card>
