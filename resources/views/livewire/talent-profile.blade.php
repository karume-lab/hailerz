<?php

use App\Models\Talent;
use Livewire\Component;

new class extends Component {
    public Talent $talent;

    public function mount($slug) {
        $this->talent = Talent::where('slug', $slug)->firstOrFail();
    }
};
?>

<div class="bg-surface-muted min-h-screen py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-surface-light rounded-[3rem] shadow-2xl overflow-hidden border border-brand-primary/5 flex flex-col md:flex-row">
            
            <!-- Talent Asset -->
            <div class="w-full md:w-2/5">
                <div class="group relative overflow-hidden h-full min-h-[500px] bg-surface-dark">
                    @if($this->talent->hasMedia('primary_image'))
                        <img src="{{ $this->talent->getFirstMediaUrl('primary_image') }}" loading="lazy" class="w-full h-full object-cover grayscale transition-transform duration-1000 scale-105" alt="{{ $this->talent->name }}" />
                    @else
                         <div class="w-full h-full flex items-center justify-center bg-brand-primary">
                            <span class="text-9xl font-bold text-white/10 font-serif">{{ substr($this->talent->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70"></div>
                    <div class="absolute inset-0 bg-linear-to-t from-brand-primary/90 via-brand-primary/20 to-transparent"></div>
                </div>
            </div>

            <!-- Talent Details -->
            <div class="w-full md:w-3/5 p-12 lg:p-20">
                <div class="flex items-center gap-3 mb-6">
                    <span class="h-px w-8 bg-brand-primary"></span>
                    <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">{{ $this->talent->category?->name ?? 'Professional Act' }}</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-text-primary font-serif tracking-tight mb-8">{{ $this->talent->name }}</h1>
                
                <div class="flex flex-wrap gap-10 mb-12">
                    <div>
                        <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-1">Starting Investment</p>
                        <p class="text-2xl font-bold text-text-primary font-serif">
                            {{ $this->talent->starting_price ? '$' . number_format($this->talent->starting_price) : 'Custom Quotation' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-1">Primary Base</p>
                        <p class="text-lg font-semibold text-text-primary">{{ $this->talent->location ?? 'International' }}</p>
                    </div>
                </div>
                
                <div class="prose prose-lg text-text-secondary font-light leading-relaxed mb-12">
                    {!! $this->talent->bio !!}
                </div>

                <div class="flex flex-col sm:flex-row gap-6">
                    <x-button variant="primary" size="lg" href="/book?talent={{ $this->talent->id }}">
                        Secure the Act
                    </x-button>
                    <x-button variant="secondary" size="lg" href="/talent">
                        Back to Roster
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</div>
