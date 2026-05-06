@props([
    'level' => 'h2',
    'title' => null,
    'emphasis' => null,
    'italic' => false,
    'subtitle' => null,
    'align' => 'left',
])

@php
    $content = $title ?? $slot->toHtml();
    if ($emphasis) {
        $emphasisClasses = 'italic';
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
    @if($subtitle)
        <div class="flex items-center gap-3 mb-6">
            <span class="h-px w-12 bg-brand-primary"></span>
            <span class="text-xs text-brand-primary uppercase tracking-widest">{{ $subtitle }}</span>
            @if((string) $align === 'center')
                <span class="h-px w-12 bg-brand-primary"></span>
            @endif
        </div>
    @endif

    <{{ $level }} class="{{ $baseClass }} tracking-tight leading-tight">
        {!! $content !!}
    </{{ $level }}>
</div>
