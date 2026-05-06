@props([
    'label' => null,
    'name' => null,
    'icon' => null,
])

@php
    $errorClass = $errors->has($name) ? 'border-red-500 ring-red-500/20' : 'border-subtle focus:ring-brand-secondary';
    $paddingClass = $icon ? 'pl-14 pr-6' : 'px-6';
@endphp

<div class="w-full">
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">
            {{ $label }}
        </label>
    @endif

    <div class="relative group/input">
        @if($icon)
            <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none text-text-muted group-focus-within/input:text-brand-secondary transition-colors">
                <x-dynamic-component :component="'lucide-' . $icon" class="h-5 w-5" stroke-width="2" />
            </div>
        @endif

        <input 
            @if($name) id="{{ $name }}" name="{{ $name }}" @endif
            {{ $attributes->merge([
                'class' => "block w-full py-4 {$paddingClass} bg-surface-muted border border-transparent placeholder-text-muted rounded-full focus:ring-2 focus:ring-inset outline-none text-text-primary font-medium transition-all " . $errorClass
            ])->class(['text-sm' => !Str::contains($attributes->get('class'), 'text-')]) }}
        />
    </div>

    @if($name)
        @error($name)
            <span class="text-red-500 text-[11px] font-bold mt-2 block tracking-tight">{{ $message }}</span>
        @enderror
    @endif
</div>
