@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'placeholder' => null,
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $errorClass = ($name && $errors->has($name)) ? 'border-red-500 ring-red-500/20' : 'border-subtle focus:ring-brand-secondary';
@endphp

<div class="w-full">
    @if($label)
        <label @if($name) for="{{ $name }}" @endif class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <select 
            @if($name) id="{{ $name }}" name="{{ $name }}" @endif
            {{ $attributes->merge([
                'class' => "block w-full px-6 py-4 bg-surface-muted border rounded-full focus:ring-2 focus:ring-inset outline-none text-text-primary text-sm font-medium transition-all appearance-none " . $errorClass
            ]) }}
        >
            @if($placeholder)
                <option value="" disabled selected>{{ $placeholder }}</option>
            @endif
            
            @foreach($options as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
            
            {{ $slot }}
        </select>
        
        <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
            <x-lucide-chevron-down class="h-4 w-4 text-text-muted" stroke-width="2.5" />
        </div>
    </div>

    @if($name)
        @error($name)
            <span class="text-red-500 text-[11px] font-bold mt-2 block tracking-tight">{{ $message }}</span>
        @enderror
    @endif
</div>
