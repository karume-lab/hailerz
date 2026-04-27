<div class="bg-surface-muted min-h-screen">

    <!-- Hero / Primary Showcase -->
    <div class="relative h-[600px] bg-surface-dark overflow-hidden">
        @if($talent->hasMedia('primary_image'))
            <img src="{{ $talent->getFirstMediaUrl('primary_image') }}" alt="{{ $talent->name }}"
                class="w-full h-full object-cover grayscale opacity-60 transition-transform duration-1000 scale-105">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <span class="text-9xl font-bold text-white/5 font-serif">{{ substr($talent->name, 0, 1) }}</span>
            </div>
        @endif
        
        <!-- Design Overlays -->
        <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-70"></div>
        <div class="absolute inset-0 bg-linear-to-t from-brand-navy via-brand-navy/40 to-transparent"></div>

        <div class="absolute bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
                <div class="flex items-center gap-3 mb-6">
                    <span class="h-px w-12 bg-brand-teal"></span>
                    <span class="text-xs font-bold text-brand-teal uppercase tracking-widest">{{ $talent->category?->name ?? 'Premier Roster' }}</span>
                </div>
                <h1 class="text-5xl md:text-8xl font-bold text-text-inverse tracking-tight font-serif">{{ $talent->name }}</h1>
            </div>
        </div>
    </div>

    <!-- Main Content Split -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24" x-data="{ activeTab: 'bio' }">
        <div class="flex flex-col lg:flex-row gap-20">

            <!-- Left Primary Content -->
            <div class="w-full lg:w-2/3">
                
                <!-- Performance Reel -->
                @if($talent->video_url)
                <section class="mb-20">
                    <div class="aspect-video w-full rounded-4xl overflow-hidden bg-brand-navy shadow-2xl border border-white/5 relative group">
                        @php
                            $embedUrl = '';
                            if (str_contains($talent->video_url, 'youtube.com') || str_contains($talent->video_url, 'youtu.be')) {
                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $talent->video_url, $match);
                                if (isset($match[1])) { $embedUrl = "https://www.youtube.com/embed/{$match[1]}?autoplay=0&rel=0"; }
                            } elseif (str_contains($talent->video_url, 'vimeo.com')) {
                                preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/i', $talent->video_url, $match);
                                if (isset($match[1])) { $embedUrl = "https://player.vimeo.com/video/{$match[1]}"; }
                            }
                        @endphp

                        @if($embedUrl)
                            <iframe src="{{ $embedUrl }}" class="absolute inset-0 w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                            <div class="flex items-center justify-center h-full">
                                <x-button variant="outline" href="{{ $talent->video_url }}" target="_blank">
                                    View Performance Reel
                                </x-button>
                            </div>
                        @endif
                    </div>
                </section>
                @endif

                <!-- Navigation Tabs -->
                <div class="mb-12 border-b border-brand-navy/10">
                    <nav class="flex space-x-12">
                        <button @click="activeTab = 'bio'" :class="activeTab === 'bio' ? 'border-brand-teal text-brand-navy' : 'border-transparent text-text-muted hover:text-text-primary'" class="pb-6 border-b-2 font-bold text-xs uppercase tracking-widest transition-all outline-none">
                            Artist Biography
                        </button>
                        @if($talent->technical_rider)
                        <button @click="activeTab = 'rider'" :class="activeTab === 'rider' ? 'border-brand-teal text-brand-navy' : 'border-transparent text-text-muted hover:text-text-primary'" class="pb-6 border-b-2 font-bold text-xs uppercase tracking-widest transition-all outline-none">
                            Technical Requirements
                        </button>
                        @endif
                        <button @click="activeTab = 'gallery'" :class="activeTab === 'gallery' ? 'border-brand-teal text-brand-navy' : 'border-transparent text-text-muted hover:text-text-primary'" class="pb-6 border-b-2 font-bold text-xs uppercase tracking-widest transition-all outline-none">
                            Portfolio Gallery
                        </button>
                    </nav>
                </div>

                <!-- Panels -->
                <div class="min-h-[400px]">
                    <div x-show="activeTab === 'bio'" x-transition class="prose prose-lg max-w-none text-text-secondary leading-relaxed font-light">
                        {!! $talent->bio !!}
                    </div>

                    @if($talent->technical_rider)
                    <div x-show="activeTab === 'rider'" x-cloak x-transition class="bg-surface-light p-12 rounded-3xl border border-brand-navy/5 shadow-sm prose max-w-none text-text-secondary">
                        <h3 class="text-brand-navy font-bold font-serif mb-6 text-2xl">Production & Technical Rider</h3>
                        {!! $talent->technical_rider !!}
                    </div>
                    @endif

                    <div x-show="activeTab === 'gallery'" x-cloak x-transition>
                        @if($talent->hasMedia('gallery'))
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                                @foreach($talent->getMedia('gallery') as $media)
                                    <div class="group relative overflow-hidden rounded-2xl aspect-square bg-brand-navy">
                                        <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110" alt="Gallery Image" />
                                        <div class="absolute inset-0 bg-linear-to-tr from-brand-teal/80 to-brand-mint/40 mix-blend-color opacity-60"></div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-20 text-center border-2 border-dashed border-brand-navy/5 rounded-3xl">
                                <p class="text-text-muted text-xs font-bold uppercase tracking-widest">Extended portfolio available upon request</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-28 bg-surface-light p-10 rounded-[2.5rem] shadow-2xl border border-brand-navy/5">
                    <h3 class="text-2xl font-bold text-brand-navy mb-8 font-serif">Booking Information</h3>

                    <div class="space-y-8 mb-10">
                        <div class="flex items-start gap-5">
                            <div class="h-10 w-10 rounded-xl bg-brand-teal/5 flex items-center justify-center text-brand-teal shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-1">Base Location</p>
                                <p class="text-text-primary font-semibold">{{ $talent->location ?? 'International Roster' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="h-10 w-10 rounded-xl bg-brand-teal/5 flex items-center justify-center text-brand-teal shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-1">Starting Investment</p>
                                <p class="text-text-primary font-semibold text-xl">
                                    {{ $talent->starting_price ? '$' . number_format($talent->starting_price, 0) : 'Custom Quotation' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <x-button variant="primary" size="lg" class="w-full mb-6" href="/book?talent={{ $talent->id }}" wire:navigate>
                        Secure the Act
                    </x-button>

                    <div class="flex items-center justify-center gap-2 text-[10px] font-bold text-text-muted uppercase tracking-widest mb-10">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                        Professional Engagement
                    </div>

                    <!-- Share -->
                    <div class="pt-8 border-t border-brand-navy/5" x-data="{ copied: false }">
                        <div class="flex items-center justify-between gap-4">
                            <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)" class="flex-1 px-4 py-2 bg-surface-muted rounded-lg text-[10px] font-bold text-brand-navy uppercase tracking-widest hover:bg-brand-teal/10 transition-colors">
                                <span x-text="copied ? 'Copied to Clipboard' : 'Share Portfolio'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>