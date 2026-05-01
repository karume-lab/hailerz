<div class="bg-surface-muted min-h-screen">

  <!-- Hero / Primary Showcase -->
  <div class="relative h-[600px] bg-surface-dark overflow-hidden">
    <img src="{{ $talent->profile_photo_url }}" alt="{{ $talent->name }}"
      class="w-full h-full object-cover grayscale opacity-60 transition-transform duration-1000 scale-105"
      >

    <!-- Design Overlays -->
    <div
      class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-70">
    </div>
    <div class="absolute inset-0 bg-linear-to-t from-surface-dark via-surface-dark/40 to-transparent"></div>

    <div class="absolute bottom-0 left-0 w-full">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="flex items-center gap-3 mb-6">
          <span class="h-px w-12 bg-brand-primary"></span>
          <span
            class="text-xs font-bold text-text-inverse/80 uppercase tracking-widest">{{ $talent->category?->name ?? 'Premier Talent' }}</span>
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
            <div
              class="aspect-video w-full rounded-4xl overflow-hidden bg-surface-dark shadow-2xl border border-subtle relative group">
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
                <iframe src="{{ $embedUrl }}" class="absolute inset-0 w-full h-full" frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
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
        <div class="mb-12 border-b border-subtle ">
          <nav class="flex space-x-12">
            <button @click="activeTab = 'bio'"
              :class="activeTab === 'bio' ? 'border-brand-primary text-text-primary' : 'border-transparent text-text-muted hover:text-text-primary'"
              class="pb-6 border-b-2 font-bold text-xs uppercase tracking-widest transition-all outline-none">
              Artist Biography
            </button>
            @if($talent->technical_rider)
              <button @click="activeTab = 'rider'"
                :class="activeTab === 'rider' ? 'border-brand-primary text-text-primary' : 'border-transparent text-text-muted hover:text-text-primary'"
                class="pb-6 border-b-2 font-bold text-xs uppercase tracking-widest transition-all outline-none">
                Technical Requirements
              </button>
            @endif
            <button @click="activeTab = 'gallery'"
              :class="activeTab === 'gallery' ? 'border-brand-primary text-text-primary' : 'border-transparent text-text-muted hover:text-text-primary'"
              class="pb-6 border-b-2 font-bold text-xs uppercase tracking-widest transition-all outline-none">
              Portfolio Gallery
            </button>
          </nav>
        </div>

        <div class="relative min-h-[500px]">
          {{-- Artist Biography --}}
          <div x-show="activeTab === 'bio'" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            class="prose prose-lg max-w-none text-text-secondary leading-relaxed font-light">
            {!! $talent->bio !!}
          </div>

          {{-- Technical Requirements --}}
          @if($talent->technical_rider)
            <div x-show="activeTab === 'rider'" x-cloak x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
              class="bg-surface-light p-8 md:p-12 rounded-3xl border border-subtle shadow-sm prose max-w-none text-text-secondary">
              <h3 class="text-text-primary mb-6 font-serif">Production & Technical Rider</h3>
              @if(filter_var($talent->technical_rider, FILTER_VALIDATE_URL))
                <p>Our technical requirements are available at the following link:</p>
                <a href="{{ $talent->technical_rider }}" target="_blank"
                  class="text-brand-primary font-bold hover:underline">View Technical Rider</a>
              @else
                {!! $talent->technical_rider !!}
              @endif
            </div>
          @endif

          {{-- Portfolio Gallery --}}
          <div x-show="activeTab === 'gallery'" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-data="{ 
                  lightboxOpen: false, 
                  lightboxImage: '', 
                  lightboxTitle: '',
                  openLightbox(url, title) {
                      this.lightboxImage = url;
                      this.lightboxTitle = title;
                      this.lightboxOpen = true;
                  }
               }">
            @if($talent->galleryItems->count() > 0)
              <div class="columns-1 sm:columns-2 lg:columns-3 gap-8 space-y-8">
                @foreach($talent->galleryItems as $item)
                  <div
                    class="break-inside-avoid group bg-surface-light rounded-3xl overflow-hidden border border-subtle shadow-sm hover:shadow-xl transition-all duration-500">
                    <div class="relative overflow-hidden bg-surface-dark">
                      @php
                        $galleryEmbedUrl = '';
                        if (str_contains($item->url, 'youtube.com') || str_contains($item->url, 'youtu.be')) {
                          preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $item->url, $match);
                          if (isset($match[1])) {
                            $galleryEmbedUrl = "https://www.youtube.com/embed/{$match[1]}?autoplay=0&rel=0";
                          }
                        } elseif (str_contains($item->url, 'vimeo.com')) {
                          preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/i', $item->url, $match);
                          if (isset($match[1])) {
                            $galleryEmbedUrl = "https://player.vimeo.com/video/{$match[1]}";
                          }
                        }
                      @endphp

                      @if($galleryEmbedUrl)
                        <div class="aspect-video relative">
                          <iframe src="{{ $galleryEmbedUrl }}" class="absolute inset-0 w-full h-full" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        </div>
                      @else
                        <div class="relative cursor-zoom-in" @click="openLightbox('{{ $item->url }}', '{{ $item->title }}')">
                          <img src="{{ $item->url }}"
                            class="w-full h-auto object-cover grayscale transition-transform duration-700 group-hover:scale-110"
                            alt="{{ $item->title ?? 'Gallery Image' }}" />
                          <div
                            class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-20 group-hover:opacity-10 transition-opacity">
                          </div>

                          <!-- Hover Overlay -->
                          <div
                            class="absolute inset-0 bg-surface-dark/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <div
                              class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                              </svg>
                            </div>
                          </div>
                        </div>
                      @endif
                    </div>
                    @if($item->title || $item->description)
                      <div class="p-6">
                        @if($item->title)
                          <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest mb-1">{{ $item->title }}</h4>
                        @endif
                        @if($item->description)
                          <p class="text-xs text-text-muted leading-relaxed">{{ $item->description }}</p>
                        @endif
                      </div>
                    @endif
                  </div>
                @endforeach
              </div>

              {{-- Lightbox --}}
              <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center bg-surface-dark/95 backdrop-blur-md p-4 md:p-10"
                @click="lightboxOpen = false" @keydown.escape.window="lightboxOpen = false" x-cloak>

                <button class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12">
                    </path>
                  </svg>
                </button>

                <div class="max-w-5xl w-full flex flex-col items-center" @click.stop>
                  <img :src="lightboxImage"
                    class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl border border-white/10"
                    :alt="lightboxTitle">
                  <div class="mt-6 text-center" x-show="lightboxTitle">
                    <h4 x-text="lightboxTitle" class="text-text-inverse text-xl font-serif tracking-wide"></h4>
                  </div>
                </div>
              </div>
            @else
              <div class="py-20 text-center border-2 border-dashed border-subtle rounded-3xl">
                <p class="text-text-muted text-xs font-bold uppercase tracking-widest">Extended portfolio available upon
                  request</p>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Sticky Sidebar -->
      <div class="w-full lg:w-1/3">
        <div class="sticky top-28 bg-surface-light p-10 rounded-[2.5rem] shadow-2xl border border-subtle ">
          <h3 class="text-2xl font-bold text-text-primary mb-8 font-serif">Booking Information</h3>

          <div class="space-y-8 mb-10">
            <div class="flex items-start gap-5">
              <div
                class="h-10 w-10 rounded-xl bg-text-secondary/10 flex items-center justify-center text-text-secondary shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                </svg>
              </div>
              <div>
                <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-1">Base Location</p>
                <p class="text-text-primary font-semibold">{{ $talent->location ?? 'International Talent' }}</p>
              </div>
            </div>
            <div class="flex items-start gap-5">
              <div
                class="h-10 w-10 rounded-xl bg-text-secondary/10 flex items-center justify-center text-text-secondary shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"></path>
                </svg>
              </div>
              <div>
                <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-1">Starting Investment</p>
                <p class="text-text-primary font-semibold text-xl">
                  {{ $talent->starting_price ? '₦' . number_format($talent->starting_price, 0) : 'Custom Quotation' }}
                </p>
              </div>
            </div>
          </div>

          <x-button variant="primary" size="lg" class="w-full mb-6" href="/book?talent={{ $talent->id }}" wire:navigate>
            Book Now
          </x-button>

          @if($talent->website_url || $talent->instagram_handle || $talent->facebook_url || $talent->youtube_channel || $talent->tiktok_handle)
          <div class="pt-8 border-t border-subtle mb-6">
            <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-6">Online Presence</p>
            <div class="grid grid-cols-1 gap-4">
              @if($talent->website_url)
                <a href="{{ $talent->website_url }}" target="_blank" class="flex items-center gap-4 p-4 bg-surface-muted rounded-2xl hover:bg-brand-primary/10 transition-all group">
                  <div class="h-8 w-8 rounded-lg bg-surface-dark flex items-center justify-center text-text-muted group-hover:text-brand-primary transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                  </div>
                  <div>
                    <p class="text-[8px] font-bold text-text-muted uppercase tracking-widest">Website</p>
                    <p class="text-xs text-text-primary font-medium truncate max-w-[150px]">{{ parse_url($talent->website_url, PHP_URL_HOST) ?: $talent->website_url }}</p>
                  </div>
                </a>
              @endif

              @if($talent->instagram_handle)
                @php $igUrl = str_starts_with($talent->instagram_handle, 'http') ? $talent->instagram_handle : 'https://instagram.com/' . ltrim($talent->instagram_handle, '@'); @endphp
                <a href="{{ $igUrl }}" target="_blank" class="flex items-center gap-4 p-4 bg-surface-muted rounded-2xl hover:bg-brand-primary/10 transition-all group">
                  <div class="h-8 w-8 rounded-lg bg-surface-dark flex items-center justify-center text-text-muted group-hover:text-brand-primary transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                  </div>
                  <div>
                    <p class="text-[8px] font-bold text-text-muted uppercase tracking-widest">Instagram</p>
                    <p class="text-xs text-text-primary font-medium truncate max-w-[150px]">{{ $talent->instagram_handle }}</p>
                  </div>
                </a>
              @endif

              @if($talent->facebook_url)
                <a href="{{ $talent->facebook_url }}" target="_blank" class="flex items-center gap-4 p-4 bg-surface-muted rounded-2xl hover:bg-brand-primary/10 transition-all group">
                  <div class="h-8 w-8 rounded-lg bg-surface-dark flex items-center justify-center text-text-muted group-hover:text-brand-primary transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                  </div>
                  <div>
                    <p class="text-[8px] font-bold text-text-muted uppercase tracking-widest">Facebook</p>
                    <p class="text-xs text-text-primary font-medium truncate max-w-[150px]">{{ parse_url($talent->facebook_url, PHP_URL_HOST) ?: 'Facebook' }}</p>
                  </div>
                </a>
              @endif

              @if($talent->youtube_channel)
                <a href="{{ $talent->youtube_channel }}" target="_blank" class="flex items-center gap-4 p-4 bg-surface-muted rounded-2xl hover:bg-brand-primary/10 transition-all group">
                  <div class="h-8 w-8 rounded-lg bg-surface-dark flex items-center justify-center text-text-muted group-hover:text-brand-primary transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                  </div>
                  <div>
                    <p class="text-[8px] font-bold text-text-muted uppercase tracking-widest">YouTube</p>
                    <p class="text-xs text-text-primary font-medium truncate max-w-[150px]">{{ parse_url($talent->youtube_channel, PHP_URL_HOST) ?: 'YouTube' }}</p>
                  </div>
                </a>
              @endif

              @if($talent->tiktok_handle)
                @php $tiktokUrl = str_starts_with($talent->tiktok_handle, 'http') ? $talent->tiktok_handle : 'https://tiktok.com/@' . ltrim($talent->tiktok_handle, '@'); @endphp
                <a href="{{ $tiktokUrl }}" target="_blank" class="flex items-center gap-4 p-4 bg-surface-muted rounded-2xl hover:bg-brand-primary/10 transition-all group">
                  <div class="h-8 w-8 rounded-lg bg-surface-dark flex items-center justify-center text-text-muted group-hover:text-brand-primary transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.036 2.612-.012 3.914-.012.041 2.221 1.351 4.07 3.232 5.122.041.817.06 1.638.102 2.455-1.284-.191-2.417-.727-3.428-1.588-.045 2.533-.03 5.064-.04 7.591-.13 3.316-2.97 6.025-6.232 5.841-3.364-.19-5.917-3.122-5.49-6.456.353-2.731 2.825-4.756 5.57-4.323.516.081 1.012.244 1.485.487-.017-1.122-.017-2.243-.017-3.364-.782-.24-1.611-.334-2.414-.23-3.693.435-6.311 3.933-5.842 7.604.46 3.622 3.691 6.423 7.332 6.1 3.535-.313 6.136-3.41 6.002-6.942-.012-1.742-.004-3.484-.012-5.226.79.52 1.68.861 2.617 1.014.01-1.041.01-2.083.021-3.124-1.173-.314-2.134-1.056-2.791-2.045-.045-1.125-.045-2.25-.083-3.375z"/></svg>
                  </div>
                  <div>
                    <p class="text-[8px] font-bold text-text-muted uppercase tracking-widest">TikTok</p>
                    <p class="text-xs text-text-primary font-medium truncate max-w-[150px]">{{ $talent->tiktok_handle }}</p>
                  </div>
                </a>
              @endif
            </div>
          </div>
          @endif

          <!-- Share -->
          <div class="pt-8 border-t border-subtle " x-data="{ copied: false }">
            <div class="flex items-center justify-between gap-4">
              <button
                @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                class="flex-1 px-4 py-2 bg-surface-muted rounded-lg text-[10px] font-bold text-text-primary uppercase tracking-widest hover:bg-brand-primary/10 transition-colors">
                <span x-text="copied ? 'Copied to Clipboard' : 'Share Portfolio'"></span>
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>