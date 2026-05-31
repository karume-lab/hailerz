@props([
    'hover' => true,
    'padding' => 'p-10',
    'bg' => 'light',
])

@php
    $bgClass = $bg === 'muted' ? 'bg-surface-muted' : 'bg-surface-light';
    $baseClasses = $bgClass . ' rounded-[3rem] border border-brand-primary/10 transition-all duration-500 group';
    
    if ($hover) {
        $baseClasses .= ' shadow-sm hover:shadow-md';
    }
    
    $baseClasses = str_replace('border-subtle', 'border-brand-primary/10', $baseClasses);
@endphp

<div {{ $attributes->merge(['class' => $baseClasses . ' ' . $padding]) }}>
    {{ $slot }}
</div>
