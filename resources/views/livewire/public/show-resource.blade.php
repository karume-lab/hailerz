<div class="bg-surface-light min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Link -->
        <a href="/resources" wire:navigate class="flex items-center gap-2 text-text-muted hover:text-brand-primary transition-colors mb-12">
            <x-lucide-arrow-left class="w-4 h-4" />
            Back to Resources
        </a>

        <!-- Header -->
        <div class="mb-12 reveal">
            <div class="flex items-center gap-4 mb-6">
                <span class="px-3 py-1 bg-brand-primary/10 text-brand-primary text-[10px] font-medium rounded-full uppercase tracking-widest border border-brand-primary/20">
                    {{ $post->category }}
                </span>
                <div class="flex items-center gap-4 text-xs text-text-muted">
                    <span class="flex items-center gap-1.5 font-normal">
                        <x-lucide-calendar class="w-3.5 h-3.5" />
                        {{ $post->published_at->format('M j, Y') }}
                    </span>
                    <span class="flex items-center gap-1.5 font-normal">
                        <x-lucide-user class="w-3.5 h-3.5" />
                        {{ $post->author }}
                    </span>
                </div>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-medium text-text-primary mb-6 leading-tight">
                {{ $post->title }}
            </h1>
            
            <p class="text-xl text-text-secondary font-light leading-relaxed">
                {{ $post->subtitle }}
            </p>
        </div>

        <!-- Featured Media -->
        @if($post->category === 'Video' && $post->getVideoUrl())
            <div class="rounded-3xl overflow-hidden mb-16 shadow-2xl reveal reveal-delay-100 aspect-video bg-black">
                <iframe src="{{ $post->getVideoUrl() }}?autoplay=1&mute=1&rel=0" 
                        class="w-full h-full border-none"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe>
            </div>
        @else
            <div class="rounded-3xl overflow-hidden mb-16 shadow-2xl reveal reveal-delay-100">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-auto" />
            </div>
        @endif

        <!-- Content -->
        <div class="prose prose-lg max-w-none prose-headings:text-text-primary prose-headings:font-medium prose-p:text-text-secondary prose-p:leading-relaxed prose-p:font-light reveal reveal-delay-200">
            @foreach($post->content as $block)
                @if($block['type'] === 'p')
                    <p class="mb-8 text-lg font-normal">{{ $block['text'] }}</p>
                @elseif($block['type'] === 'h2')
                    <h2 class="text-2xl font-medium mt-12 mb-6 text-text-primary">{{ $block['text'] }}</h2>
                @elseif($block['type'] === 'video')
                    {{-- Only show if not already shown at top --}}
                    @if($post->category !== 'Video')
                        <div class="rounded-3xl overflow-hidden mb-12 shadow-xl aspect-video bg-black">
                            <iframe src="{{ $block['url'] }}?autoplay=1&mute=1" 
                                    class="w-full h-full border-none"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    @endif
                @elseif($block['type'] === 'gallery')
                    <div class="grid grid-cols-2 gap-4 mb-12">
                        @foreach($block['images'] as $image)
                            <div class="rounded-2xl overflow-hidden shadow-md">
                                <img src="{{ $image }}" alt="Gallery image" class="w-full h-auto hover:scale-105 transition-transform duration-500" />
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Footer -->
        <div class="mt-20 pt-10 border-t border-subtle flex flex-col md:flex-row md:items-center justify-between gap-8">
            <x-button variant="outline" href="/resources" wire:navigate class="rounded-xl flex items-center gap-2">
                <x-lucide-arrow-left class="w-4 h-4" />
                All Posts
            </x-button>
            <div>
                <p class="text-xs text-text-muted uppercase tracking-widest mb-1">Written by</p>
                <p class="text-lg font-medium text-text-primary">{{ $post->author }}</p>
            </div>
        </div>
    </div>
</div>
