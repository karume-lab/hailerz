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
                                        
                                        @php 
                                            // Mocking latest comment for UI accuracy based on the design since the relationship might not be loaded
                                            $latestComment = $challenge->comments()->latest()->first();
                                        @endphp
                                        
                                        <div class="flex items-center text-[15px] text-text-secondary mb-6">
                                            <svg class="w-4 h-4 mr-2 shrink-0 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                            </svg>
                                            @if($latestComment && $latestComment->user)
                                                {{ $latestComment->user->name }} replied {{ $latestComment->created_at->diffForHumans() }}
                                            @else
                                                OKAFOR replied 8 hours ago
                                            @endif
                                        </div>
                                        
                                        <div class="mt-auto flex items-center gap-5 text-text-primary font-medium">
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-6 h-6 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                                {{ $challenge->interactions_count ?? 3 }}
                                            </span>
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-6 h-6 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                {{ $challenge->comments_count ?? 5 }}
                                            </span>
                                        </div>
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
