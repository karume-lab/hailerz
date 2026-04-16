<div class="py-16 bg-canvas min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-16 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-text-main mb-4 tracking-tight">Industry News</h1>
            <p class="text-lg text-text-muted max-w-2xl mx-auto leading-relaxed">
                Insights, updates, and deep dives into the global entertainment market.
            </p>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($posts as $post)
                <article class="bg-surface rounded-3xl overflow-hidden border border-border shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group flex flex-col">
                    <div class="p-8 flex-1">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest rounded-full">
                                Update
                            </span>
                            <time class="text-xs text-text-muted font-medium" datetime="{{ $post->created_at->toW3cString() }}">
                                {{ $post->created_at->format('M d, Y') }}
                            </time>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-text-main mb-4 group-hover:text-primary transition-colors">
                            <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        
                        <p class="text-text-muted text-sm leading-relaxed line-clamp-3 mb-8">
                            {{ Str::limit(strip_tags($post->content), 150) }}
                        </p>
                    </div>
                    
                    <div class="px-8 pb-8 pt-0 mt-auto">
                        <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center text-sm font-bold text-text-main hover:text-primary transition-colors group/link">
                            Read Full Story
                            <svg class="w-5 h-5 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-24 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-surface text-text-muted rounded-full mb-6 border border-border">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 13H8"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17H8"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9H8"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-text-main">No updates found</h3>
                    <p class="text-text-muted mt-2">Check back soon for latest industry insights.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</div>

