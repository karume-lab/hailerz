<div class="bg-canvas min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12 border-b border-dark/10 pb-8">
            <h1 class="text-4xl font-extrabold text-dark tracking-tight">Our Roster</h1>
            <p class="mt-2 text-lg text-gray-600">Discover exceptional talent for your next event.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-1/4">
                <div class="sticky top-28 bg-surface p-6 rounded-2xl shadow-sm border border-dark/5">
                    <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-6">Filter</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Name</label>
                            <input wire:model.live.debounce.300ms="search" type="text" id="search" class="w-full px-4 py-2 border border-dark/10 rounded-lg focus:ring-primary focus:border-primary transition-colors shadow-sm" placeholder="e.g. John Doe">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select wire:model.live="category_id" id="category" class="w-full px-4 py-2 border border-dark/10 rounded-lg focus:ring-primary focus:border-primary transition-colors shadow-sm bg-surface">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Talent Grid -->
            <main class="w-full lg:w-3/4">
                
                <div class="transition-opacity duration-300">
                    @if($talents->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($talents as $talent)
                                <div class="bg-surface rounded-2xl shadow-sm border border-dark/5 overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <a href="/talent/{{ $talent->slug }}" wire:navigate class="block relative h-64 overflow-hidden">
                                        @if($talent->hasMedia('primary_image'))
                                            <img src="{{ $talent->getFirstMediaUrl('primary_image') }}" alt="{{ $talent->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full bg-linear-to-br from-primary to-indigo-900 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                                <span class="text-4xl font-bold text-white opacity-50 tracking-tighter">
                                                    {{ collect(explode(' ', $talent->name))->map(fn($part) => substr($part, 0, 1))->take(2)->join('') }}
                                                </span>
                                            </div>
                                        @endif
                                        
                                        @if($talent->is_featured)
                                            <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-950 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                                Featured
                                            </div>
                                        @endif
                                    </a>
                                    
                                    <div class="p-6">
                                        <div class="text-xs font-semibold text-primary uppercase tracking-wider mb-2">
                                            {{ $talent->category?->name ?? 'Uncategorized' }}
                                        </div>
                                        <h3 class="text-xl font-bold text-dark-muted mb-1">
                                            <a href="/talent/{{ $talent->slug }}" wire:navigate class="hover:text-primary transition-colors">
                                                {{ $talent->name }}
                                            </a>
                                        </h3>
                                        <div class="text-sm text-gray-500 flex items-center mb-4">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $talent->location ?? 'Global' }}
                                        </div>
                                        
                                        <div class="flex justify-between items-center mt-6 pt-4 border-t border-dark/5">
                                            <div class="text-sm">
                                                <span class="text-gray-500 block text-xs">Starting from</span>
                                                <span class="font-bold text-dark-muted">${{ number_format($talent->starting_price ?? 0, 0) }}</span>
                                            </div>
                                            <a href="/talent/{{ $talent->slug }}" wire:navigate class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors flex items-center">
                                                View Profile
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($talents->hasMorePages())
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">
                                <!-- Loading Skeletons -->
                                <div wire:loading wire:target="loadMore" class="contents">
                                    @foreach(range(1, 3) as $i)
                                        <div class="bg-surface rounded-2xl shadow-sm border border-dark/5 overflow-hidden animate-pulse">
                                            <div class="h-64 bg-gray-200"></div>
                                            <div class="p-6">
                                                <div class="h-3 w-20 bg-gray-200 rounded mb-4"></div>
                                                <div class="h-6 w-48 bg-gray-200 rounded mb-2"></div>
                                                <div class="h-4 w-32 bg-gray-200 rounded mb-6"></div>
                                                <div class="flex justify-between items-center mt-6 pt-4 border-t border-dark/5">
                                                    <div class="space-y-2">
                                                        <div class="h-2 w-16 bg-gray-100 rounded"></div>
                                                        <div class="h-4 w-12 bg-gray-200 rounded"></div>
                                                    </div>
                                                    <div class="h-4 w-24 bg-gray-200 rounded"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

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
                                    }, {
                                        rootMargin: '400px'
                                    })
                                    observer.observe(this.$el)
                                }
                            }" x-init="observe()" class="mt-4 py-8 flex justify-center">
                                <!-- Intersection Trigger -->
                            </div>
                        @endif
                    @else
                        <div class="text-center py-24 bg-surface rounded-2xl border border-dark/5 shadow-sm">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <h3 class="mt-2 text-sm font-semibold text-dark-muted">No talent found</h3>
                            <p class="mt-1 text-sm text-gray-500">Adjust your search or filters to find what you're looking for.</p>
                            <div class="mt-6">
                                <button wire:click="$set('search', '')" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-primary bg-primary/10 hover:bg-primary/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Clear Search
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

            </main>
        </div>
    </div>
</div>
