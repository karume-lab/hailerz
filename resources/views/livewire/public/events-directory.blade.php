<div class="bg-surface-muted min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-heading title="Featured" highlight="Events" class="mb-16" />
        <p class="mt--12 mb-16 text-lg text-text-secondary max-w-2xl">
            Explore and connect with upcoming conferences, workshops, creator meetups, and entertainment events hosted on the Hailerz platform.
        </p>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-1/4">
                <x-card padding="p-8" class="sticky top-28 border border-brand-primary/10">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-xs font-bold text-text-secondary uppercase tracking-widest">Refine Selection</h2>
                        <button wire:click="resetFilters" aria-label="Reset all search filters"
                            class="text-[10px] font-bold text-brand-primary uppercase tracking-widest hover:underline transition-colors">
                            Reset All
                        </button>
                    </div>

                    <div class="space-y-10">
                        <!-- Search -->
                        <x-input wire:model.live.debounce.300ms="search" name="search" label="Keywords"
                            placeholder="Event name..." />

                        <!-- Sort Order -->
                        <x-select wire:model.live="sort" name="sort" label="Order">
                            <option value="name">Alphabetical</option>
                            <option value="latest">Newly Registered</option>
                        </x-select>
                    </div>
                </x-card>
            </aside>

            <!-- Exhibitors Grid -->
            <main class="w-full lg:w-3/4">
                <div class="transition-all duration-500 ease-in-out" wire:loading.class="opacity-40 blur-[1px]">
                    @if($registrations->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                            @foreach($registrations as $reg)
                                <x-card padding="p-0" class="group transition-all duration-500 flex flex-col h-full overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:border-brand-primary/30 animate-fadeIn border border-brand-primary/10">
                                    <div class="block">
                                        <div class="group relative overflow-hidden aspect-3/4 bg-surface-dark flex items-center justify-center p-6">
                                            @if($reg->company_logo)
                                                <img src="{{ $reg->company_logo }}"
                                                    loading="{{ $loop->iteration <= 6 ? 'eager' : 'lazy' }}"
                                                    fetchpriority="{{ $loop->iteration <= 2 ? 'high' : 'auto' }}" decoding="async"
                                                    class="max-h-24 w-auto max-w-[80%] object-contain transition-transform duration-700 group-hover:scale-110 filter dark:invert"
                                                    alt="{{ $reg->company_name }}" />
                                            @else
                                                @php
                                                    $initials = collect(explode(' ', $reg->company_name))
                                                        ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                                        ->take(3)
                                                        ->implode('');
                                                @endphp
                                                <div class="w-24 h-24 rounded-2xl bg-brand-primary/15 border border-brand-primary/25 flex items-center justify-center text-brand-primary font-bold text-3xl tracking-widest transition-transform duration-700 group-hover:scale-110">
                                                    {{ $initials }}
                                                </div>
                                            @endif

                                            <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/40 to-brand-secondary/10 mix-blend-color opacity-25 transition-opacity group-hover:opacity-40 pointer-events-none"></div>
                                            <div class="absolute inset-0 bg-linear-to-t from-surface-dark/90 via-surface-dark/30 to-transparent pointer-events-none"></div>

                                            <div class="absolute bottom-6 left-6 right-6">
                                                <p class="text-[10px] font-bold text-text-inverse/70 uppercase tracking-widest mb-1">
                                                    Confirmed Event
                                                </p>
                                                <h3 class="text-xl font-bold text-text-inverse truncate">{{ $reg->company_name }}</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-8 flex-1 flex flex-col justify-between bg-surface-light">
                                        <p class="text-text-secondary text-sm leading-relaxed mb-6 line-clamp-3">
                                            {{ $reg->company_description }}
                                        </p>

                                        <div class="flex justify-between items-center pt-6 border-t border-subtle">
                                            <div>
                                                <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest">Registered Date</p>
                                                <p class="text-sm font-bold text-text-primary mt-1">{{ $reg->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-primary/10 text-brand-primary text-[10px] font-bold uppercase tracking-widest">
                                                Event Confirmed
                                            </div>
                                        </div>
                                    </div>
                                </x-card>
                            @endforeach
                        </div>

                        @if($registrations->hasMorePages())
                            <div x-data="{
                                isLoading: false,
                                observe() {
                                    let observer = new IntersectionObserver((entries) => {
                                        entries.forEach(entry => {
                                            if (entry.isIntersecting && !this.isLoading) {
                                                this.isLoading = true;
                                                @this.loadMore().then(() => {
                                                    this.isLoading = false;
                                                });
                                            }
                                        })
                                    }, { rootMargin: '400px' })
                                    observer.observe(this.$el)
                                }
                            }" x-init="observe()" class="mt-12 py-12 flex justify-center">
                                <div class="flex items-center gap-3 text-text-muted">
                                    <x-lucide-loader-2 class="animate-spin h-5 w-5" stroke-width="2" />
                                    <span class="text-sm font-semibold uppercase tracking-widest">Loading More Events...</span>
                                </div>
                            </div>
                        @endif
                    @else
                        <x-card padding="py-32" class="text-center border-dashed">
                            <h3 class="text-2xl font-bold text-text-primary mb-4">No Results Found</h3>
                            <p class="text-text-secondary mb-8">Refine your selection parameters to find specific events.</p>
                            <x-button variant="secondary" wire:click="resetFilters">
                                Clear All Filters
                            </x-button>
                        </x-card>
                    @endif
                </div>
            </main>
        </div>
    </div>
</div>
