@props([
    'subtitle' => null,
    'title' => null,
    'align' => 'left',
])

@php
    $alignmentClasses = [
        'left' => 'text-left items-start',
        'center' => 'text-center items-center mx-auto',
        'right' => 'text-right items-end',
    ];
    $currentAlign = (string) ($align ?? 'left');
    $alignment = $alignmentClasses[$currentAlign] ?? $alignmentClasses['left'];
@endphp

<div {{ $attributes->merge(['class' => "max-w-3xl flex flex-col {$alignment} mb-12"]) }}>
    @if($subtitle)
        <div class="flex items-center gap-3 mb-6">
            <span class="h-px w-8 bg-brand-primary"></span>
            <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">{{ $subtitle }}</span>
            @if($align === 'center')
                <span class="h-px w-8 bg-brand-primary"></span>
            @endif
        </div>
    @endif

    <h2 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight  leading-tight">
        {!! $title !!}
    </h2>
</div>
