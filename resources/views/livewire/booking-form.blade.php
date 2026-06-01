<?php

use App\Models\Inquiry;
use Livewire\Component;

// @phpstan-ignore-next-line
new class extends Component {
    public int $step = 1;
    public string $client_name = '';
    public string $event_date = '';
    public bool $is_success = false;

    protected array $rules = [
        'client_name' => 'required|min:3', 
        'event_date' => 'required|date|after:today'
    ];

    public function updated($propertyName) {
        if ($this->getErrorBag()->has($propertyName)) {
            $this->validateOnly($propertyName);
        }
    }

    public function nextStep() {
        $this->validate();
        $this->step = 2;
    }

    public function submit() {
        Inquiry::create([
            'client_name' => $this->client_name,
            'event_date' => $this->event_date,
            'status' => 'lead',
            'type' => 'general'
        ]);
        $this->is_success = true;
    }
};
?>

<div class="max-w-2xl mx-auto p-12 bg-surface-light rounded-[2.5rem] shadow-sm border border-brand-primary/5 mt-10"
     x-data="{
        storageKey: 'hailerz_booking_form',
        init() {
            @if($is_success)
                localStorage.removeItem(this.storageKey);
                return;
            @endif

            const saved = localStorage.getItem(this.storageKey);
            if (saved) {
                try {
                    const parsed = JSON.parse(saved);
                    const age = Date.now() - parsed.timestamp;
                    if (age > 86400000) {
                        localStorage.removeItem(this.storageKey);
                    } else {
                        const data = parsed.data || {};
                        this.$nextTick(() => {
                            Object.keys(data).forEach(key => {
                                @this.set(key, data[key]);
                            });
                        });
                    }
                } catch (e) {
                    localStorage.removeItem(this.storageKey);
                }
            }

            $el.addEventListener('input', () => this.saveData());
            $el.addEventListener('change', () => this.saveData());
        },
        saveData() {
            let data = {};
            $el.querySelectorAll('[wire\\:model],[wire\\:model\\.blur],[wire\\:model\\.live],[wire\\:model\\.defer],[wire\\:model\\.live\\.debounce\\.300ms],[wire\\:model\\.live\\.debounce\\.500ms]').forEach(el => {
                const model = el.getAttributeNames().find(a => a.startsWith('wire:model')) ? el.getAttribute(el.getAttributeNames().find(a => a.startsWith('wire:model'))) : null;
                if (model) {
                    if (el.type === 'checkbox') {
                        data[model] = el.checked;
                    } else {
                        data[model] = el.value;
                    }
                }
            });
            localStorage.setItem(this.storageKey, JSON.stringify({
                timestamp: Date.now(),
                data: data
            }));
        }
     }"
>
    @if($is_success)
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-brand-secondary/10 text-brand-secondary rounded-full flex items-center justify-center mx-auto mb-8">
                <x-lucide-check class="w-10 h-10" stroke-width="2" />
            </div>
            <x-heading level="h2" title="We've Got It!" class="text-text-primary mb-4" />
            <p class="text-text-secondary leading-relaxed font-light mb-8">Thanks for reaching out! Our team has received your request and we'll get back to you shortly to chat about the details.</p>
            <x-button variant="primary" href="/marketplace/browse">Back to Talent</x-button>
        </div>
    @else
        <div class="flex items-center gap-3 mb-4">
            <span class="h-px w-8 bg-brand-primary"></span>
            <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Booking Progress: Step {{ $step }} of 2</span>
        </div>
        <h2 class="text-3xl font-bold text-text-primary  mb-10 tracking-tight">Tell Us About Your Event</h2>
        
        @if($step === 1)
            <div class="space-y-8">
                <div>
                    <label class="block text-xs font-bold text-text-primary uppercase tracking-widest mb-3">Your Name or Company</label>
                    <input type="text" wire:model.live.debounce.300ms="client_name" placeholder="Who should we address?" class="w-full bg-surface-muted border border-brand-primary/10 rounded-xl px-5 py-4 text-text-primary focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none transition-all placeholder:text-text-muted">
                    @error('client_name') <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-primary uppercase tracking-widest mb-3">When is the big day?</label>
                    <input type="date" wire:model.live.debounce.300ms="event_date" class="w-full bg-surface-muted border border-brand-primary/10 rounded-xl px-5 py-4 text-text-primary focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none transition-all">
                    @error('event_date') <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="pt-4">
                    <x-button variant="primary" size="lg" class="w-full" wire:click="nextStep">
                        Continue to Review
                    </x-button>
                </div>
            </div>
        @elseif($step === 2)
            <div class="space-y-10">
                <div class="bg-surface-muted p-8 rounded-2xl border border-brand-primary/5">
                    <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-6">Review Your Details</p>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center pb-4 border-b border-brand-primary/5">
                            <span class="text-sm font-bold text-text-primary/60 uppercase">Name</span>
                            <span class="text-sm font-bold text-text-primary">{{ $client_name }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-brand-primary/5">
                            <span class="text-sm font-bold text-text-primary/60 uppercase">Event Date</span>
                            <span class="text-sm font-bold text-text-primary">{{ \Carbon\Carbon::parse($event_date)->format('F d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-6">
                    <x-button variant="secondary" class="flex-1" wire:click="$set('step', 1)">
                        Edit Details
                    </x-button>
                    <x-button variant="primary" class="flex-1" wire:click="submit" wire:loading.attr="disabled">
                        Send Booking Request
                    </x-button>
                </div>
            </div>
        @endif
    @endif
</div>
