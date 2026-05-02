<div class="py-24 bg-canvas min-h-screen relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-y-1/2 -translate-x-1/2"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-secondary/5 rounded-full blur-3xl translate-y-1/2 translate-x-1/2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Header -->
        <div class="mb-20 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-text-main mb-6 tracking-tight font-serif">
                Knowledge <span class="text-primary">Hub</span>
            </h1>
            <p class="text-xl text-text-muted max-w-2xl mx-auto leading-relaxed">
                Expert insights, industry guides, and essential assets to help you navigate the world of premium talent.
            </p>
        </div>

        <!-- Resources Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
            @forelse($resources as $resource)
                <article class="flex flex-col bg-surface rounded-4xl overflow-hidden border border-border/50 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                    <div class="p-10 flex-1">
                        <div class="flex items-center justify-between mb-8">
                            @php
                                $typeLabel = match($resource->type) {
                                    'guide' => 'Industry Guide',
                                    'news' => 'Agency News',
                                    'asset' => 'Digital Asset',
                                    default => ucfirst($resource->type)
                                };
                                $typeIcon = match($resource->type) {
                                    'guide' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>',
                                    'news' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 13H8"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17H8"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9H8"></path></svg>',
                                    'asset' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>',
                                    default => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                                };
                                $typeColor = match($resource->type) {
                                    'guide' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                    'news' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    'asset' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20',
                                    default => 'bg-primary/10 text-primary border-primary/20'
                                };
                            @endphp
                            <span class="flex items-center gap-2 px-4 py-1.5 {{ $typeColor }} border text-[10px] font-black uppercase tracking-[0.2em] rounded-full">
                                {!! $typeIcon !!}
                                {{ $typeLabel }}
                            </span>
                            <span class="text-xs text-text-muted/60 font-medium tracking-wide">
                                {{ $resource->created_at->format('M Y') }}
                            </span>
                        </div>
                        
                        <h2 class="text-2xl font-bold text-text-main mb-6 leading-tight group-hover:text-primary transition-colors duration-300">
                            {{ $resource->title }}
                        </h2>
                        
                        <div class="text-text-muted text-sm leading-relaxed line-clamp-4 mb-10 opacity-80">
                            {!! Str::limit(strip_tags($resource->content), 180) !!}
                        </div>
                    </div>
                    
                    <div class="px-10 pb-10 pt-0 mt-auto">
                        @if($resource->file_path)
                            <a href="{{ $resource->file_path }}" target="_blank" class="group/link inline-flex items-center gap-3 text-sm font-bold text-text-main hover:text-primary transition-all duration-300">
                                <span class="relative">
                                    {{ $resource->type === 'asset' ? 'Download Asset' : 'View Resource' }}
                                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
                                </span>
                                <div class="w-8 h-8 rounded-full bg-surface-muted flex items-center justify-center group-hover/link:bg-primary group-hover/link:text-white transition-all duration-300">
                                    <svg class="w-4 h-4 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </a>
                        @else
                            <span class="text-xs text-text-muted italic flex items-center gap-2 opacity-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Full details available upon request
                            </span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="col-span-full py-32 text-center">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-surface rounded-full mb-8 border border-border shadow-inner">
                        <svg class="w-10 h-10 text-text-muted/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-text-main mb-3 italic">Our library is growing</h3>
                    <p class="text-text-muted max-w-md mx-auto">We're curating exclusive guides and assets. Check back soon or subscribe for updates.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($resources->hasPages())
            <div class="mt-24 flex justify-center">
                <div class="bg-surface px-8 py-4 rounded-full border border-border shadow-sm">
                    {{ $resources->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
