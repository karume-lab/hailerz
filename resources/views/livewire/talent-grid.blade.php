<?php

use App\Models\Talent;
use Livewire\Component;

new class extends Component {
    public string $category_id = '';

    public function with(): array
    {
        return [
            'talents' => Talent::when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })->where('status', 'active')->get(),
            'categories' => \App\Models\Category::all(),
        ];
    }
};
?>

<div class="max-w-7xl mx-auto p-8">

    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="h-px w-8 bg-brand-teal"></span>
                <span class="text-xs font-bold text-brand-teal uppercase tracking-widest">Agency Roster</span>
            </div>
            <h1 class="text-4xl font-bold text-text-primary font-serif">Explore the Talent</h1>
        </div>

        <select wire:model.live="category_id" aria-label="Filter talent by category" class="bg-surface-muted border border-brand-navy/10 rounded-xl px-5 py-3 text-sm font-bold text-text-primary uppercase tracking-widest focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all">
            <option value="">All Disciplines</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($talents as $talent)
            <div class="bg-surface-light rounded-3xl shadow-sm overflow-hidden border border-brand-navy/5 group hover:shadow-2xl transition-all duration-500">

                <div class="group relative overflow-hidden aspect-3/4 bg-surface-dark">
                    @if($talent->hasMedia('primary_image'))
                        <img src="{{ $talent->getFirstMediaUrl('primary_image') }}" loading="lazy" class="w-full h-full object-cover grayscale transition-transform duration-500 group-hover:scale-110" alt="{{ $talent->name }}" />
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-brand-navy">
                            <span class="text-4xl font-bold text-white/10 font-serif">{{ substr($talent->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-70 group-hover:opacity-50 transition-opacity"></div>
                    <div class="absolute inset-0 bg-linear-to-t from-brand-navy/90 via-transparent to-transparent"></div>
                    
                    <div class="absolute bottom-6 left-6">
                        <p class="text-[10px] font-bold text-brand-mint uppercase tracking-widest mb-1">{{ $talent->category?->name }}</p>
                        <h3 class="text-xl font-bold text-white">{{ $talent->name }}</h3>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest">Performance Fee</p>
                            <p class="text-lg font-bold text-text-primary font-serif">${{ number_format($talent->starting_price ?? 0) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest">Location</p>
                            <p class="text-sm font-semibold text-text-primary">{{ $talent->location ?? 'Global' }}</p>
                        </div>
                    </div>

                    <x-button variant="primary" class="w-full" href="/talent/{{ $talent->slug }}">
                        View Portfolio
                    </x-button>
                </div>

            </div>
        @endforeach
    </div>
</div>
