@props([
    'label' => null,
    'name' => null,
    'maxlength' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $errorClass = ($name && $errors->has($name)) ? 'border-red-500 ring-red-500/20' : 'border-subtle focus:ring-brand-secondary';
@endphp

<div class="w-full"
     @if($maxlength)
     x-data="{
        count: 0,
        max: {{ $maxlength }},
        init() {
            this.count = this.$refs.textarea.value.length;
        },
        updateCount() {
            this.count = this.$refs.textarea.value.length;
        }
     }"
     @endif
>
    @if($label || $maxlength)
        <div class="flex items-center justify-between mb-3">
            @if($label)
                <label @if($name) for="{{ $name }}" @endif class="block text-[10px] font-bold text-text-muted uppercase tracking-widest">
                    {{ $label }}
                </label>
            @else
                <div></div>
            @endif

            @if($maxlength)
                <span class="text-[10px] font-bold text-text-muted tracking-widest uppercase">
                    <span x-text="count"></span> / <span x-text="max"></span>
                </span>
            @endif
        </div>
    @endif

    <textarea 
        @if($name) id="{{ $name }}" name="{{ $name }}" @endif
        @if($maxlength) 
            x-ref="textarea" 
            @input="updateCount()" 
            maxlength="{{ $maxlength }}" 
        @endif
        {{ $attributes->merge([
            'class' => "block w-full px-8 py-6 bg-surface-muted border placeholder-text-muted rounded-[2rem] focus:ring-2 focus:ring-inset outline-none text-text-primary text-sm font-medium transition-all resize-none " . $errorClass
        ]) }}
    >{{ $slot }}</textarea>

    @if($name)
        @error($name)
            <span class="text-red-500 text-[11px] font-bold mt-2 block tracking-tight">{{ $message }}</span>
        @enderror
    @endif
</div>
