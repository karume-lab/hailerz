@props([
    'label' => null,
    'name' => null,
    'icon' => null,
    'location' => false,
    'locationType' => 'full', // 'full', 'city', 'state'
])

@php
    $name = $name ?? $attributes->whereStartsWith('wire:model')->first();
    $errorClass = ($name && $errors->has($name)) ? 'border-red-500 ring-red-500/20' : 'border-subtle focus:ring-brand-secondary';
    $paddingClass = $icon ? 'pl-14 pr-6' : 'px-6';
@endphp

<div class="w-full"
     @if($location)
     x-data="{
        isLocating: false,
        locationError: '',
        locationType: '{{ $locationType }}',
        async tryIpFallback() {
            try {
                const res = await fetch('https://ipapi.co/json/');
                const data = await res.json();
                if (!data.error) {
                    let value = '';
                    if (this.locationType === 'city') {
                        value = data.city || '';
                    } else if (this.locationType === 'state') {
                        value = data.region || '';
                    } else {
                        value = (data.city && data.country_name) ? `${data.city}, ${data.country_name}` : (data.city || data.country_name || '');
                    }
                    if (value) {
                        const input = $el.querySelector('input');
                        if (input) {
                            input.value = value;
                            input.dispatchEvent(new Event('input', { bubbles: true }));
                            input.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    } else {
                        this.locationError = 'unavailable';
                    }
                } else {
                    this.locationError = 'unavailable';
                }
            } catch(e) {
                this.locationError = 'unavailable';
            } finally {
                this.isLocating = false;
            }
        },
        locateMe() {
            this.isLocating = true;
            this.locationError = '';
            if (!navigator.geolocation) {
                this.tryIpFallback();
                return;
            }
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    try {
                        const { latitude, longitude } = position.coords;
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
                        const data = await response.json();
                        
                        let value = '';
                        if (this.locationType === 'city') {
                            value = data.address.city || data.address.town || data.address.village || data.address.county || '';
                        } else if (this.locationType === 'state') {
                            value = data.address.state || data.address.region || '';
                        } else {
                            let city = data.address.city || data.address.town || data.address.village || data.address.county || '';
                            let country = data.address.country || '';
                            value = (city && country) ? `${city}, ${country}` : (city || country || '');
                        }

                        if (value) {
                            const input = $el.querySelector('input');
                            if (input) {
                                input.value = value;
                                input.dispatchEvent(new Event('input', { bubbles: true }));
                                input.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                            this.isLocating = false;
                        } else {
                            await this.tryIpFallback();
                        }
                    } catch(e) {
                        await this.tryIpFallback();
                    }
                },
                async (err) => {
                    if (err.code === 1) {
                        this.locationError = 'denied';
                        this.isLocating = false;
                    } else {
                        await this.tryIpFallback();
                    }
                },
                { timeout: 8000, maximumAge: 60000 }
            );
        }
     }"
     @endif
>
    @if($label || $location)
        <div class="flex items-center justify-between mb-3">
            @if($label)
                <label @if($name) for="{{ $name }}" @endif class="block text-[10px] font-bold text-text-muted uppercase tracking-widest">
                    {{ $label }}
                </label>
            @else
                <div></div>
            @endif

            @if($location)
                <button @click="locateMe()" type="button" aria-label="Auto-detect location"
                    class="text-[10px] font-bold text-brand-primary uppercase tracking-widest hover:underline flex items-center gap-1">
                    <x-lucide-map-pin x-show="!isLocating" class="w-3.5 h-3.5 text-brand-primary" stroke-width="2" />
                    <span x-text="isLocating ? '...' : 'Auto-Detect'"></span>
                </button>
            @endif
        </div>
    @endif

    @if($location)
        <p x-show="locationError === 'denied'" class="text-[10px] text-red-400 mb-2" x-cloak>Location access denied. Please type manually.</p>
        <p x-show="locationError === 'unavailable'" class="text-[10px] text-amber-400 mb-2" x-cloak>Could not detect location. Please type manually.</p>
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
