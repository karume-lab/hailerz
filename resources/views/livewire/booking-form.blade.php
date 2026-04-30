<?php

use App\Models\Inquiry;
use Livewire\Component;

new class extends Component {
    public int $step = 1;
    public string $client_name = '';
    public string $event_date = '';
    public bool $is_success = false;

    public function nextStep() {
        $this->validate([
            'client_name' => 'required|min:3', 
            'event_date' => 'required|date|after:today'
        ]);
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

<div class="max-w-2xl mx-auto p-12 bg-surface-light rounded-[2.5rem] shadow-2xl border border-brand-primary/5 mt-10">
    @if($is_success)
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-brand-secondary/10 text-brand-secondary rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-text-primary font-serif mb-4 tracking-tight">Inquiry Submitted</h2>
            <p class="text-text-secondary leading-relaxed font-light mb-8">Our procurement agents have received your specifications and will contact you shortly to discuss the engagement.</p>
            <x-button variant="secondary" href="/talent">Back to Roster</x-button>
        </div>
    @else
        <div class="flex items-center gap-3 mb-4">
            <span class="h-px w-8 bg-brand-primary"></span>
            <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Procurement Step {{ $step }} of 2</span>
        </div>
        <h2 class="text-3xl font-bold text-text-primary font-serif mb-10 tracking-tight">Booking Inquiry</h2>
        
        @if($step === 1)
            <div class="space-y-8">
                <div>
                    <label class="block text-xs font-bold text-text-primary uppercase tracking-widest mb-3">Client Identity / Organization</label>
                    <input type="text" wire:model="client_name" placeholder="Legal entity or lead planner" class="w-full bg-surface-muted border border-brand-primary/10 rounded-xl px-5 py-4 text-text-primary focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none transition-all placeholder:text-text-muted">
                    @error('client_name') <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-text-primary uppercase tracking-widest mb-3">Proposed Event Date</label>
                    <input type="date" wire:model="event_date" class="w-full bg-surface-muted border border-brand-primary/10 rounded-xl px-5 py-4 text-text-primary focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none transition-all">
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
                    <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-6">Review Specifications</p>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center pb-4 border-b border-brand-primary/5">
                            <span class="text-sm font-bold text-text-primary/60 uppercase">Engagement Name</span>
                            <span class="text-sm font-bold text-text-primary">{{ $client_name }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-brand-primary/5">
                            <span class="text-sm font-bold text-text-primary/60 uppercase">Execution Date</span>
                            <span class="text-sm font-bold text-text-primary">{{ \Carbon\Carbon::parse($event_date)->format('F d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-6">
                    <x-button variant="secondary" size="lg" class="flex-1" wire:click="$set('step', 1)">
                        Modify Details
                    </x-button>
                    <x-button variant="primary" size="lg" class="flex-1" wire:click="submit">
                        Secure Submission
                    </x-button>
                </div>
            </div>
        @endif
    @endif
</div>
