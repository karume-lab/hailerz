<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-16 text-center">
            <h1 class="text-4xl md:text-5xl font-serif font-black text-slate-950 mb-4 tracking-tighter">Industry News</h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Insights, updates, and deep dives into the global entertainment market.
            </p>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($posts as $post)
                <article class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group flex flex-col">
                    <div class="p-8 flex-1">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="px-3 py-1 bg-primary-100 text-primary-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                                Update
                            </span>
                            <time class="text-xs text-slate-400 font-medium" datetime="{{ $post->created_at->toW3cString() }}">
                                {{ $post->created_at->format('M d, Y') }}
                            </time>
                        </div>
                        
                        <h2 class="text-2xl font-serif font-black text-slate-950 mb-4 group-hover:text-primary-600 transition-colors">
                            <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-8">
                            {{ Str::limit(strip_tags($post->content), 150) }}
                        </p>
                    </div>
                    
                    <div class="px-8 pb-8 pt-0 mt-auto">
                        <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center text-sm font-bold text-slate-950 hover:text-primary-600 transition-colors group/link">
                            Read Full Story
                            <x-heroicon-o-arrow-long-right class="w-5 h-5 ml-2 group-hover/link:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-24 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 text-slate-300 rounded-full mb-6">
                        <x-heroicon-o-newspaper class="w-10 h-10" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-950">No updates found</h3>
                    <p class="text-slate-500 mt-2">Check back soon for latest industry insights.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</div>
