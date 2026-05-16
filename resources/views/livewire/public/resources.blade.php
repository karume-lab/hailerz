<div class="bg-surface-muted min-h-screen">
    <!-- Hero Section -->
    <section class="py-24 bg-surface-light border-b border-subtle">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal">
            <div class="max-w-3xl">
                <x-heading level="h1" title="Resources" class="mb-4" />
                <p class="text-xl text-text-secondary leading-relaxed font-light">
                    Booking guides, industry insights, video performances, and highlights from events we've powered.
                </p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tabs -->
            <div class="flex flex-wrap gap-4 mb-12 reveal">
                <button wire:click="setTab('blog')" 
                    class="flex items-center gap-2 px-8 py-3 rounded-2xl font-medium transition-all {{ $tab === 'blog' ? 'bg-brand-primary text-text-inverse shadow-lg shadow-brand-primary/20 scale-105' : 'bg-surface-light text-text-secondary hover:border-brand-primary border border-subtle' }}">
                    <x-lucide-book-open class="w-5 h-5" />
                    Blog
                </button>
                <button wire:click="setTab('videos')" 
                    class="flex items-center gap-2 px-8 py-3 rounded-2xl font-medium transition-all {{ $tab === 'videos' ? 'bg-brand-primary text-text-inverse shadow-lg shadow-brand-primary/20 scale-105' : 'bg-surface-light text-text-secondary hover:border-brand-primary border border-subtle' }}">
                    <x-lucide-video class="w-5 h-5" />
                    Video Library
                </button>
                <button wire:click="setTab('gallery')" 
                    class="flex items-center gap-2 px-8 py-3 rounded-2xl font-medium transition-all {{ $tab === 'gallery' ? 'bg-brand-primary text-text-inverse shadow-lg shadow-brand-primary/20 scale-105' : 'bg-surface-light text-text-secondary hover:border-brand-primary border border-subtle' }}">
                    <x-lucide-image class="w-5 h-5" />
                    Event Gallery
                </button>
            </div>

            @if($tab === 'blog')
                <!-- Blog Categories -->
                <div class="flex flex-wrap gap-3 mb-10 reveal reveal-delay-100">
                    @foreach(['All', 'Tips', 'News', 'Events', 'Guides', 'Industry'] as $cat)
                        <button wire:click="setCategory('{{ $cat }}')"
                            class="px-5 py-2 rounded-full text-sm font-medium transition-all border {{ $category === $cat ? 'bg-brand-primary text-text-inverse border-brand-primary' : 'bg-surface-light text-text-secondary border-subtle hover:border-brand-primary' }}">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>

                <!-- Blog Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($posts as $index => $post)
                        <article class="bg-surface-light border border-subtle rounded-3xl overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 group reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
                            <div class="h-56 overflow-hidden">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                            </div>
                            <div class="p-8 flex flex-col flex-1">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="px-3 py-1 bg-brand-primary/10 text-brand-primary text-[10px] font-medium rounded-full uppercase tracking-widest border border-brand-primary/20">
                                        {{ $post->category }}
                                    </span>
                                    <span class="text-xs text-text-muted flex items-center gap-1.5">
                                        <x-lucide-calendar class="w-3 h-3" />
                                        {{ $post->published_at->format('M j, Y') }}
                                    </span>
                                </div>
                                <h2 class="text-xl font-medium mb-3 text-text-primary group-hover:text-brand-primary transition-colors leading-tight">
                                    <a href="/resources/{{ $post->slug }}" wire:navigate>{{ $post->title }}</a>
                                </h2>
                                <p class="text-text-secondary text-sm leading-relaxed mb-6 line-clamp-3 font-normal">
                                    {{ $post->subtitle }}
                                </p>
                                <div class="mt-auto pt-6 border-t border-subtle flex items-center justify-between">
                                    <span class="text-xs text-text-muted">By {{ $post->author }}</span>
                                    <a href="/resources/{{ $post->slug }}" wire:navigate class="text-sm font-medium text-brand-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        Read Post
                                        <x-lucide-arrow-right class="w-4 h-4" />
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <x-lucide-book-open class="w-16 h-16 text-brand-primary/20 mx-auto mb-6" />
                            <h3 class="text-2xl font-medium text-text-primary mb-2">No Blog Posts Found</h3>
                            <p class="text-text-secondary">We're working on new content. Check back soon!</p>
                        </div>
                    @endforelse
                </div>
            @elseif($tab === 'videos')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($posts as $index => $post)
                        <article class="bg-surface-light border border-subtle rounded-3xl overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 group reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
                            <div class="h-56 overflow-hidden relative">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                    <div class="w-16 h-16 bg-brand-primary text-white rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                        <x-lucide-play class="w-8 h-8 fill-current ml-1" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-8 flex flex-col flex-1">
                                <h2 class="text-xl font-medium mb-3 text-text-primary group-hover:text-brand-primary transition-colors leading-tight">
                                    <a href="/resources/{{ $post->slug }}" wire:navigate>{{ $post->title }}</a>
                                </h2>
                                <p class="text-text-secondary text-sm leading-relaxed mb-6 line-clamp-2 font-normal">
                                    {{ $post->subtitle }}
                                </p>
                                <div class="mt-auto pt-6 border-t border-subtle flex items-center justify-between">
                                    <span class="text-xs text-text-muted">{{ $post->published_at->format('M j, Y') }}</span>
                                    <a href="/resources/{{ $post->slug }}" wire:navigate class="text-sm font-medium text-brand-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        Watch Video
                                        <x-lucide-arrow-right class="w-4 h-4" />
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <x-lucide-video class="w-16 h-16 text-brand-primary/20 mx-auto mb-6" />
                            <h3 class="text-2xl font-medium text-text-primary mb-2">No Videos Found</h3>
                            <p class="text-text-secondary">Check back soon for new content.</p>
                        </div>
                    @endforelse
                </div>
            @elseif($tab === 'gallery')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($posts as $index => $post)
                        <article class="bg-surface-light border border-subtle rounded-3xl overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 group reveal {{ $index % 3 === 1 ? 'reveal-delay-100' : ($index % 3 === 2 ? 'reveal-delay-200' : '') }}">
                            <div class="h-64 overflow-hidden relative">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <span class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-sm font-bold text-text-primary shadow-lg">View Gallery</span>
                                </div>
                            </div>
                            <div class="p-8 flex flex-col flex-1">
                                <h2 class="text-xl font-medium mb-3 text-text-primary group-hover:text-brand-primary transition-colors leading-tight">
                                    <a href="/resources/{{ $post->slug }}" wire:navigate>{{ $post->title }}</a>
                                </h2>
                                <p class="text-text-secondary text-sm leading-relaxed mb-6 line-clamp-2 font-normal">
                                    {{ $post->subtitle }}
                                </p>
                                <div class="mt-auto pt-6 border-t border-subtle flex items-center justify-between">
                                    <span class="text-xs text-text-muted">{{ $post->published_at->format('M j, Y') }}</span>
                                    <a href="/resources/{{ $post->slug }}" wire:navigate class="text-sm font-medium text-brand-primary flex items-center gap-1 hover:gap-2 transition-all">
                                        View Photos
                                        <x-lucide-arrow-right class="w-4 h-4" />
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <x-lucide-image class="w-16 h-16 text-brand-primary/20 mx-auto mb-6" />
                            <h3 class="text-2xl font-medium text-text-primary mb-2">No Gallery Items Found</h3>
                            <p class="text-text-secondary">Check back soon for new content.</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-24 bg-surface-muted text-center border-t border-subtle">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 reveal">
            <x-heading level="h2" title="Ready to Book Top Talent?" align="center" class="mb-6" />
            <p class="text-xl text-text-secondary mb-12 max-w-2xl mx-auto">
                Browse our roster or submit a booking inquiry today.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <x-button variant="primary" size="lg" href="/talent" wire:navigate>
                    Browse Talent
                </x-button>
                <x-button variant="outline" size="lg" href="/book" wire:navigate>
                    Submit Booking Request
                </x-button>
            </div>
        </div>
    </section>
</div>
