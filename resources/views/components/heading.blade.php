@props([
    'level' => 'h2',
    'title' => null,
    'highlight' => null,
    'highlightClass' => 'text-brand-secondary',
    'align' => 'left',
])

@php
    $content = $title ?? $slot->toHtml();

    $sizes = [
        'h1' => 'text-5xl md:text-8xl font-semibold',
        'h2' => 'text-4xl md:text-6xl font-semibold',
        'h3' => 'text-2xl md:text-4xl font-semibold',
        'h4' => 'text-xl md:text-2xl font-semibold',
    ];

    $alignmentClasses = [
        'left' => 'text-left items-start',
        'center' => 'text-center items-center mx-auto',
        'right' => 'text-right items-end',
    ];

    $baseClass = $sizes[(string) ($level ?? 'h2')] ?? $sizes['h2'];
    $alignment = $alignmentClasses[(string) ($align ?? 'left')] ?? $alignmentClasses['left'];
@endphp

<div {{ $attributes->merge(['class' => "max-w-4xl flex flex-col {$alignment}"]) }}>

    <{{ $level }} class="{{ $baseClass }} tracking-tight leading-tight">
        {!! $content !!}
        @if($highlight)
            <span class="{{ $highlightClass }}">{!! $highlight !!}</span>
        @endif
    </{{ $level }}>
</div>
