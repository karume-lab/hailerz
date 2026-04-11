<div class="bg-surface min-h-screen">
    
    <!-- Hero / Primary Image -->
    <div class="relative h-96 md:h-128 bg-dark/90 overflow-hidden">
        @if($talent->hasMedia('primary_image'))
            <img src="{{ $talent->getFirstMediaUrl('primary_image') }}" alt="{{ $talent->name }}" class="w-full h-full object-cover opacity-70">
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
                <div class="inline-flex items-center px-3 py-1 rounded-full border border-gray-400/30 bg-gray-600/30 backdrop-blur-sm text-sm font-medium text-white mb-4">
                    {{ $talent->category?->name ?? 'Premium Talent' }}
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight">{{ $talent->name }}</h1>
            </div>
        </div>
    </div>

    <!-- Main Content Split -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <!-- Bio and Repertoire -->
            <div class="w-full lg:w-2/3">
                <section class="mb-16">
                    <h2 class="text-2xl font-bold text-dark mb-6">Biography</h2>
                    <div class="prose prose-lg prose-indigo max-w-none text-gray-600">
                        {!! $talent->bio !!}
                    </div>
                </section>

                @if($talent->technical_rider)
                <section class="mb-16">
                    <h2 class="text-2xl font-bold text-dark mb-6">Technical Rider & Repertoire</h2>
                    <div class="p-8 bg-canvas border border-dark/5 rounded-2xl prose prose-indigo max-w-none text-gray-600">
                        {!! $talent->technical_rider !!}
                    </div>
                </section>
                @endif

                @if($talent->hasMedia('gallery'))
                <section>
                    <h2 class="text-2xl font-bold text-dark mb-6">Gallery</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($talent->getMedia('gallery') as $media)
                            <div class="aspect-square rounded-xl overflow-hidden bg-gray-100">
                                <img src="{{ $media->getUrl() }}" alt="Gallery Image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Sticky Sidebar: At a Glance -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-28 bg-surface p-8 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-dark/5">
                    <h3 class="text-xl font-bold text-dark mb-6 border-b border-dark/5 pb-4">At a Glance</h3>
                    
                    <dl class="space-y-6 mb-8">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Base Location</dt>
                            <dd class="text-base font-semibold text-dark-muted flex items-center">
                                <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $talent->location ?? 'Information upon request' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Starting Price</dt>
                            <dd class="text-base font-semibold text-dark-muted flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $talent->starting_price ? '$' . number_format($talent->starting_price, 0) : 'Custom Quote Required' }}
                            </dd>
                        </div>
                    </dl>

                    <a href="/book?talent={{ $talent->id }}" wire:navigate class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-dark hover:bg-dark-muted shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark group">
                        Request Quote
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    
                    <p class="mt-4 text-xs text-center text-gray-500">
                        No commitment required. Quotes are typically returned within 24 hours.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
