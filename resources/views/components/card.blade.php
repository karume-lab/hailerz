@props([
    'hover' => true,
    'padding' => 'p-10',
])

@php
    $baseClasses = 'bg-surface-light rounded-[2.5rem] border border-subtle transition-all duration-500 group';
    
    if ($hover) {
        $baseClasses .= ' shadow-sm hover:shadow-2xl';
    }
@endphp

<div {{ $attributes->merge(['class' => $baseClasses . ' ' . $padding]) }}>
    {{ $slot }}
</div>
