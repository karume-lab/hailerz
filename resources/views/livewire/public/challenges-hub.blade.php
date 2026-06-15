<div class="w-full min-h-screen bg-surface-muted/30 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Introduction Section -->
        <div class="mb-12 text-center max-w-2xl mx-auto">
            <h1 class="text-4xl font-extrabold text-brand-accent mb-4 dark:text-text-primary">Hailerz Challenges</h1>
            <p class="text-text-secondary text-sm">Join monthly skill-based sprints, compile high-quality deliverables, and compete with creators across the continent for premium cash rewards.</p>
        </div>

        <!-- Time-Based Discovery Filters -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-12 pb-6 border-b border-subtle">
            <button wire:click="setFilter('all')" class="px-5 py-2.5 rounded-full text-xs font-bold tracking-wider uppercase transition-all {{ $selectedFilter === 'all' ? 'bg-brand-primary text-white shadow-md' : 'bg-white border border-subtle text-text-secondary hover:border-brand-primary' }}">
                All Challenges
            </button>
            <button wire:click="setFilter('active')" class="px-5 py-2.5 rounded-full text-xs font-bold tracking-wider uppercase transition-all {{ $selectedFilter === 'active' ? 'bg-brand-primary text-white shadow-md' : 'bg-white border border-subtle text-text-secondary hover:border-brand-primary' }}">
                Active Sprints
            </button>
            
            @foreach($availableMonths as $sprint)
                @php $sprintKey = "{$sprint->year}-" . str_pad($sprint->month, 2, '0', STR_PAD_LEFT); @endphp
                <button wire:click="setFilter('{{ $sprintKey }}')" class="px-5 py-2.5 rounded-full text-xs font-bold tracking-wider uppercase transition-all {{ $selectedFilter === $sprintKey ? 'bg-brand-primary text-white shadow-md' : 'bg-white border border-subtle text-text-secondary hover:border-brand-primary' }}">
                    {{ date('F Y', mktime(0, 0, 0, $sprint->month, 1, $sprint->year)) }}
                </button>
            @endforeach
        </div>

        <!-- Challenge Grid View -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($challenges as $challenge)
                <div class="bg-white rounded-4xl overflow-hidden border border-subtle shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div>
                        <div class="relative aspect-16/10 bg-surface-muted">
                            @if($challenge->banner_image)
                                <img src="{{ asset('storage/' . $challenge->banner_image) }}" class="w-full h-full object-cover" alt="Banner">
                            @endif
                            <div class="absolute top-4 left-4 bg-brand-accent/90 text-white font-bold text-[10px] uppercase tracking-widest px-3 py-1 rounded-full">
                                Pool: {{ number_format($challenge->prize_pool, 2) }} NGN
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-brand-accent mb-2">{{ $challenge->title }}</h3>
                            <p class="text-xs text-text-secondary mb-4">Ends: {{ $challenge->end_date->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Peer Activity Tracking Footer Block -->
                    <div class="px-6 py-4 border-t border-subtle/60 flex justify-between items-center bg-surface-muted/20">
                        <div class="flex gap-4 text-xs text-text-muted">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-rose-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                {{ $challenge->interactions_count }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-brand-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>
                                {{ $challenge->comments_count }}
                            </span>
                        </div>
                        <a href="/challenges/{{ $challenge->slug }}" wire:navigate class="text-xs font-bold text-brand-primary hover:underline">View Challenge &rarr;</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-4xl border border-subtle">
                    <p class="text-text-muted text-sm">No challenges active inside this specific time partition.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $challenges->links() }}
        </div>
    </div>
</div>
