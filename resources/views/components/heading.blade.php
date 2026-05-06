@props([
    'level' => 'h2',
    'title' => null,
    'emphasis' => null,
    'align' => 'left',
])

@php
    $content = $title ?? $slot->toHtml();
    if ($emphasis) {
        $emphasisClasses = 'text-brand-secondary';
        $content = str_replace($emphasis, '<span class="' . $emphasisClasses . '">' . $emphasis . '</span>', $content);
    }

    $sizes = [
        'h1' => 'text-5xl md:text-8xl',
        'h2' => 'text-4xl md:text-6xl',
        'h3' => 'text-2xl md:text-4xl',
        'h4' => 'text-xl md:text-2xl',
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
    </{{ $level }}>
</div>
