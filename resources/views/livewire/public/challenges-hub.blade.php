<div class="bg-surface-muted min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-heading title="Hailerz" highlight="Challenges" class="mb-16" />
        <p class="mt--12 mb-16 text-lg text-text-secondary max-w-2xl">Join monthly skill-based sprints, compile high-quality deliverables, and compete with creators across the continent for premium cash rewards.</p>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-1/4">
                <x-card padding="p-8" class="sticky top-28">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-xs font-bold text-text-secondary uppercase tracking-widest">Refine Selection</h2>
                    </div>

                    <div class="space-y-10">
                        <!-- Time Filters -->
                        <div>
                            <label class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-4">Sprint Timeline</label>
                            <div class="flex flex-col gap-3">
                                <button wire:click="setFilter('all')" class="text-left px-4 py-3 rounded-xl text-sm font-bold transition-all {{ $selectedFilter === 'all' ? 'bg-brand-primary text-white shadow-md' : 'bg-surface-muted text-text-secondary hover:bg-surface-muted/70' }}">
                                    All Challenges
                                </button>
                                <button wire:click="setFilter('active')" class="text-left px-4 py-3 rounded-xl text-sm font-bold transition-all {{ $selectedFilter === 'active' ? 'bg-brand-primary text-white shadow-md' : 'bg-surface-muted text-text-secondary hover:bg-surface-muted/70' }}">
                                    Active Sprints
                                </button>
                                
                                @foreach($availableMonths as $sprint)
                                    @php $sprintKey = "{$sprint->year}-" . str_pad($sprint->month, 2, '0', STR_PAD_LEFT); @endphp
                                    <button wire:click="setFilter('{{ $sprintKey }}')" class="text-left px-4 py-3 rounded-xl text-sm font-bold transition-all {{ $selectedFilter === $sprintKey ? 'bg-brand-primary text-white shadow-md' : 'bg-surface-muted text-text-secondary hover:bg-surface-muted/70' }}">
                                        {{ date('F Y', mktime(0, 0, 0, $sprint->month, 1, $sprint->year)) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </x-card>
            </aside>

            <!-- Challenge Grid View -->
            <main class="w-full lg:w-3/4">
                <div class="transition-all duration-500 ease-in-out" wire:loading.class="opacity-40 blur-[1px]">
                    @if($challenges->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($challenges as $challenge)
                                <x-card padding="p-0" class="group transition-all duration-500 flex flex-col h-full overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:border-brand-primary/30 animate-fadeIn">
                                    <a href="/challenges/browse/{{ $challenge->slug }}" wire:navigate class="block">
                                        <div class="group relative overflow-hidden aspect-16/10 bg-surface-dark">
                                            @if($challenge->banner_image)
                                                <img src="{{ asset('storage/' . $challenge->banner_image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Banner">
                                            @endif
                                            
                                            <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-40 transition-opacity group-hover:opacity-60"></div>
                                            <div class="absolute inset-0 bg-linear-to-t from-surface-dark via-surface-dark/40 to-transparent"></div>
                                            
                                            <div class="absolute top-6 right-6 bg-brand-primary text-text-inverse text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                                                Pool: {{ \App\Helpers\CurrencyHelper::format($challenge->prize_pool) }}
                                            </div>

                                            <div class="absolute bottom-6 left-6 pr-6">
                                                <h3 class="text-xl font-bold text-text-inverse leading-tight">{{ $challenge->title }}</h3>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="p-8 flex-1 flex flex-col justify-between">
                                        <div class="flex flex-wrap items-center justify-between text-xs text-text-secondary mb-6 gap-y-4">
                                            <span class="flex items-center gap-2 font-bold tracking-widest uppercase">
                                                <x-lucide-calendar class="w-4 h-4 text-brand-primary" stroke-width="2" />
                                                Ends: {{ $challenge->end_date->format('M d, Y') }}
                                            </span>
                                            
                                            <div class="flex gap-4">
                                                <span class="flex items-center gap-1">
                                                    <x-lucide-heart class="w-4 h-4 text-rose-500" stroke-width="2" />
                                                    {{ $challenge->interactions_count }}
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <x-lucide-message-square class="w-4 h-4 text-brand-primary" stroke-width="2" />
                                                    {{ $challenge->comments_count }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex justify-between items-center pt-6 border-t border-subtle">
                                            <x-button variant="secondary" size="sm" href="/challenges/browse/{{ $challenge->slug }}" wire:navigate class="text-brand-primary hover:text-brand-primary/80 ml-auto">
                                                View Challenge
                                            </x-button>
                                        </div>
                                    </div>
                                </x-card>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $challenges->links() }}
                        </div>
                    @else
                        <x-card padding="py-32" class="text-center border-dashed">
                            <h3 class="text-2xl font-bold text-text-primary mb-4">No Challenges Found</h3>
                            <p class="text-text-secondary mb-8">Try adjusting your timeline filters to find more sprints.</p>
                            <x-button variant="secondary" wire:click="setFilter('all')">
                                View All Challenges
                            </x-button>
                        </x-card>
                    @endif
                </div>
            </main>
        </div>
    </div>
</div>
