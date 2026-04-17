<div class="bg-canvas min-h-screen">

    <!-- Hero / Primary Image -->
    <div class="relative h-96 md:h-128 bg-dark/90 overflow-hidden">
        @if($talent->hasMedia('primary_image'))
            <img src="{{ $talent->getFirstMediaUrl('primary_image') }}" alt="{{ $talent->name }}"
                class="w-full h-full object-cover grayscale opacity-70">
            <div class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-80 mix-blend-color"></div>
        @else
            <div class="w-full h-full bg-linear-to-br from-primary-900 to-dark flex items-center justify-center">
                <span class="text-8xl font-bold text-white opacity-20 tracking-tighter">
                    {{ collect(explode(' ', $talent->name))->map(fn($part) => substr($part, 0, 1))->take(2)->join('') }}
                </span>
            </div>
        @endif
        <div class="absolute inset-0 bg-linear-to-t from-dark via-dark/40 to-transparent"></div>

        <div class="absolute bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                <div
                    class="inline-flex items-center px-3 py-1 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm text-sm font-medium text-white mb-4">
                    {{ $talent->category?->name ?? 'Premium Talent' }}
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight">{{ $talent->name }}</h1>
            </div>
        </div>
    </div>

    <!-- Main Content Split -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ activeTab: 'bio' }">
        <div class="flex flex-col lg:flex-row gap-16">

            <!-- Left Primary Content -->
            <div class="w-full lg:w-2/3">
                
                <!-- Video Reel Section -->
                @if($talent->video_url)
                <section class="mb-12">
                    <div class="aspect-video w-full rounded-3xl overflow-hidden bg-dark shadow-2xl border border-white/10 relative group">
                        @php
                            $embedUrl = '';
                            if (str_contains($talent->video_url, 'youtube.com') || str_contains($talent->video_url, 'youtu.be')) {
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $talent->video_url, $match);
                                if (isset($match[1])) {
                                    $embedUrl = "https://www.youtube.com/embed/{$match[1]}?autoplay=0&rel=0";
                                }
                            } elseif (str_contains($talent->video_url, 'vimeo.com')) {
                                preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/i', $talent->video_url, $match);
                                if (isset($match[1])) {
                                    $embedUrl = "https://player.vimeo.com/video/{$match[1]}";
                                }
                            }
                        @endphp

                        @if($embedUrl)
                            <iframe src="{{ $embedUrl }}" class="absolute inset-0 w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                            <div class="flex items-center justify-center h-full text-white/40">
                                <a href="{{ $talent->video_url }}" target="_blank" class="hover:text-primary transition-colors flex flex-col items-center">
                                    <svg class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"></path></svg>
                                    <span class="font-bold uppercase tracking-widest text-xs">Watch Video Portfolio</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </section>
                @endif

                <!-- Tabbed Navigation -->
                <div class="mb-8 border-b border-border">
                    <nav class="flex space-x-8">
                        <button 
                            @click="activeTab = 'bio'"
                            :class="activeTab === 'bio' ? 'border-primary text-primary' : 'border-transparent text-text-muted hover:text-text-main hover:border-border'"
                            class="pb-4 px-1 border-b-2 font-bold text-sm uppercase tracking-widest transition-all focus:outline-none"
                        >
                            Biography
                        </button>
                        @if($talent->technical_rider)
                        <button 
                            @click="activeTab = 'rider'"
                            :class="activeTab === 'rider' ? 'border-primary text-primary' : 'border-transparent text-text-muted hover:text-text-main hover:border-border'"
                            class="pb-4 px-1 border-b-2 font-bold text-sm uppercase tracking-widest transition-all focus:outline-none"
                        >
                            Technical Rider
                        </button>
                        @endif
                        <button 
                            @click="activeTab = 'gallery'"
                            :class="activeTab === 'gallery' ? 'border-primary text-primary' : 'border-transparent text-text-muted hover:text-text-main hover:border-border'"
                            class="pb-4 px-1 border-b-2 font-bold text-sm uppercase tracking-widest transition-all focus:outline-none"
                        >
                            Gallery
                        </button>
                    </nav>
                </div>

                <!-- Tab Panels -->
                <div class="mb-16 min-h-[400px]">
                    <!-- Bio Tab -->
                    <div x-show="activeTab === 'bio'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="prose prose-lg prose-indigo max-w-none text-text-muted">
                            {!! $talent->bio !!}
                        </div>
                    </div>

                    <!-- Rider Tab -->
                    @if($talent->technical_rider)
                    <div x-show="activeTab === 'rider'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="p-8 bg-surface border border-border rounded-2xl prose prose-indigo max-w-none text-text-muted shadow-sm">
                            {!! $talent->technical_rider !!}
                        </div>
                    </div>
                    @endif

                    <!-- Gallery Tab -->
                    <div x-show="activeTab === 'gallery'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        @if($talent->hasMedia('gallery'))
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                @foreach($talent->getMedia('gallery') as $media)
                                    <div class="aspect-square rounded-2xl overflow-hidden bg-canvas border border-border relative group shadow-sm">
                                        <img src="{{ $media->getUrl() }}" alt="Gallery Image"
                                            class="w-full h-full object-cover grayscale opacity-80 group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-linear-to-br from-secondary/40 to-primary/40 opacity-60 mix-blend-color group-hover:opacity-40 transition-opacity"></div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-24 text-text-muted opacity-40">
                                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="font-bold uppercase tracking-widest text-[10px]">No images available yet</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar: At a Glance -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-28 bg-surface p-8 rounded-3xl shadow-xl border border-border">
                    <h3 class="text-xl font-bold text-text-main mb-6 border-b border-border pb-4">At a Glance</h3>

                    <dl class="space-y-6 mb-8">
                        <div>
                            <dt class="text-sm font-medium text-text-muted mb-1">Base Location</dt>
                            <dd class="text-base font-semibold text-text-main flex items-center">
                                <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $talent->location ?? 'Information upon request' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-text-muted mb-1">Starting Price</dt>
                            <dd class="text-base font-semibold text-text-main flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                {{ $talent->starting_price ? '$' . number_format($talent->starting_price, 0) : 'Custom Quote Required' }}
                            </dd>
                        </div>
                    </dl>

                    <a href="/book?talent={{ $talent->id }}" wire:navigate
                        class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-primary hover:bg-primary-dark shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary group">
                        Request Quote
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>

                    <p class="mt-4 text-[10px] text-center text-text-muted uppercase font-bold tracking-widest">
                        No commitment required
                    </p>

                    <!-- Share Section -->
                    <div class="mt-10 pt-10 border-t border-border" x-data="{ copied: false }">
                        <h4 class="text-sm font-bold text-text-main mb-6 uppercase tracking-wider">Share Profile</h4>
                        <div class="flex items-center gap-4">
                            <button
                                @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-canvas border border-border rounded-lg text-sm font-semibold text-text-main hover:bg-surface transition-all">
                                <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3">
                                    </path>
                                </svg>
                                <svg x-show="copied" x-cloak class="w-4 h-4 text-green-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span x-text="copied ? 'Copied!' : 'Copy Link'"></span>
                            </button>

                            <div class="flex gap-2">
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank"
                                    class="p-2 bg-canvas border border-border rounded-lg hover:text-primary transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($talent->name . ' - ' . request()->fullUrl()) }}"
                                    target="_blank"
                                    class="p-2 bg-canvas border border-border rounded-lg hover:text-green-500 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>