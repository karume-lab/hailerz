<div class="bg-[#e9ecef] min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <x-heading title="Hailerz" highlight="Challenges" class="mb-16 hidden" />
        
        <div class="flex flex-col gap-8">
            <!-- Top Filters -->
            <div class="flex flex-wrap items-center gap-3">
                <button wire:click="setFilter('all')" class="px-6 py-2 rounded-full text-sm font-medium border transition-all {{ $selectedFilter === 'all' ? 'bg-surface-dark text-white border-surface-dark shadow-sm' : 'bg-white text-text-primary border-subtle hover:bg-surface-muted' }}">
                    All
                </button>
                <button wire:click="setFilter('active')" class="px-6 py-2 rounded-full text-sm font-medium border transition-all {{ $selectedFilter === 'active' ? 'bg-surface-dark text-white border-surface-dark shadow-sm' : 'bg-white text-text-primary border-subtle hover:bg-surface-muted' }}">
                    challenges
                </button>
                
                @foreach($availableMonths as $sprint)
                    @php 
                        $sprintKey = "{$sprint->year}-" . str_pad($sprint->month, 2, '0', STR_PAD_LEFT); 
                        $monthName = strtolower(date('F', mktime(0, 0, 0, $sprint->month, 1, $sprint->year)));
                        $label = $monthName . $sprint->year;
                    @endphp
                    <button wire:click="setFilter('{{ $sprintKey }}')" class="px-6 py-2 rounded-full text-sm font-medium border transition-all {{ $selectedFilter === $sprintKey ? 'bg-surface-dark text-white border-surface-dark shadow-sm' : 'bg-white text-text-primary border-subtle hover:bg-surface-muted' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <!-- Challenge Grid View -->
            <div class="transition-all duration-500 ease-in-out" wire:loading.class="opacity-40 blur-[1px]">
                @if($challenges->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($challenges as $challenge)
                            <a href="/challenges/browse/{{ $challenge->slug }}" wire:navigate class="block group">
                                <div class="bg-[#f2f4f6] rounded-3xl overflow-hidden border border-subtle/50 flex flex-col h-full transition-transform duration-300 hover:-translate-y-1 hover:shadow-xl">
                                    <!-- Banner -->
                                    <div class="relative h-48 w-full bg-surface-dark">
                                        @if($challenge->banner_image)
                                            <img src="{{ asset('storage/' . $challenge->banner_image) }}" class="w-full h-full object-cover" alt="Banner">
                                        @endif
                                        
                                        <!-- Overlapping logo -->
                                        <div class="absolute -bottom-5 left-6 z-10">
                                            <div class="w-10 h-10 rounded-full bg-brand-primary flex items-center justify-center border-2 border-[#f2f4f6] overflow-hidden shadow-sm">
                                                <img src="https://ui-avatars.com/api/?name=W&background=random" class="w-full h-full object-cover" alt="Logo">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Body -->
                                    <div class="p-6 pt-10 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-text-primary leading-tight mb-3">{{ $challenge->title }}</h3>
                                        

                                    </div>
                                </div>
                            </a>
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
        </div>
    </div>
</div>
