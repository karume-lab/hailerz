<div class="bg-surface-muted min-h-screen">

  <!-- Hero / Primary Showcase -->
  <div class="relative h-[600px] bg-surface-dark overflow-hidden">
    <img src="{{ $talent->profile_photo_url }}" alt="{{ $talent->name }}"
      fetchpriority="high" decoding="sync" loading="eager"
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
              class="aspect-video w-full rounded-md overflow-hidden bg-surface-dark shadow-2xl border border-subtle relative group">
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
                  loading="lazy" title="{{ $talent->name }} - Performance Reel"
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
              class="bg-surface-light p-8 md:p-12 rounded-md border border-subtle shadow-sm prose max-w-none text-text-secondary">
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
                  lightboxType: 'image',
                  lightboxUrl: '', 
                  lightboxTitle: '',
                  openLightbox(url, title, type = 'image') {
                      this.lightboxUrl = url;
                      this.lightboxTitle = title;
                      this.lightboxType = type;
                      this.lightboxOpen = true;
                  }
               }">
            @if($talent->galleryItems->count() > 0)
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($talent->galleryItems as $item)
                  <div
                    class="group bg-surface-light rounded-md overflow-hidden border border-subtle shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col h-full">
                    <div class="relative overflow-hidden bg-surface-dark aspect-video">
                      @php
                        $galleryEmbedUrl = '';
                        $thumbnailUrl = $item->url;
                        $isvimeo = false;
                        
                        if (str_contains($item->url, 'youtube.com') || str_contains($item->url, 'youtu.be')) {
                          preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $item->url, $match);
                          if (isset($match[1])) {
                            $galleryEmbedUrl = "https://www.youtube.com/embed/{$match[1]}?autoplay=1&rel=0";
                            $thumbnailUrl = "https://img.youtube.com/vi/{$match[1]}/hqdefault.jpg";
                          }
                        } elseif (str_contains($item->url, 'vimeo.com')) {
                          preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/i', $item->url, $match);
                          if (isset($match[1])) {
                            $galleryEmbedUrl = "https://player.vimeo.com/video/{$match[1]}?autoplay=1";
                            $isvimeo = true;
                            // Vimeo thumbnails usually require an API call, so we'll just use the URL if it's an image or a placeholder
                          }
                        }
                      @endphp

                      @if($galleryEmbedUrl)
                        <div class="relative cursor-pointer w-full h-full" @click="openLightbox('{{ $galleryEmbedUrl }}', '{{ $item->title }}', 'video')">
                          <img src="{{ $thumbnailUrl }}" loading="lazy" decoding="async"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="{{ $item->title ?? 'Gallery Video' }}" />
                          
                          <!-- Play Button Overlay -->
                          <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/40 transition-colors">
                            <div class="w-16 h-16 rounded-full bg-brand-primary/90 flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform">
                              <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                              </svg>
                            </div>
                          </div>
                        </div>
                      @else
                        <div class="relative cursor-zoom-in w-full h-full" @click="openLightbox('{{ $item->url }}', '{{ $item->title }}', 'image')">
                          <img src="{{ $item->url }}" loading="lazy" decoding="async"
                            class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110"
                            alt="{{ $item->title ?? 'Gallery Image for ' . $talent->name }}" />
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
                      <div class="p-6 flex-1 flex flex-col justify-center">
                        @if($item->title)
                          <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest mb-1">{{ $item->title }}</h4>
                        @endif
                        @if($item->description)
                          <p class="text-xs text-text-muted leading-relaxed line-clamp-2">{{ $item->description }}</p>
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
                class="fixed inset-0 z-100 flex items-center justify-center bg-surface-dark/95 backdrop-blur-md p-4 md:p-10"
                @click="lightboxOpen = false" @keydown.escape.window="lightboxOpen = false" x-cloak>

                <button class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors z-101" aria-label="Close Lightbox">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12">
                    </path>
                  </svg>
                </button>

                <div class="max-w-5xl w-full flex flex-col items-center" @click.stop>
                  <template x-if="lightboxType === 'image'">
                    <img :src="lightboxUrl"
                      class="max-w-full max-h-[85vh] object-contain rounded-md shadow-2xl border border-white/10"
                      :alt="lightboxTitle">
                  </template>
                  <template x-if="lightboxType === 'video'">
                    <div class="aspect-video w-full max-w-4xl rounded-md overflow-hidden shadow-2xl border border-white/10">
                      <iframe :src="lightboxUrl" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                  </template>
                  <div class="mt-6 text-center" x-show="lightboxTitle">
                    <h4 x-text="lightboxTitle" class="text-text-inverse text-xl font-serif tracking-wide"></h4>
                  </div>
                </div>
              </div>
            @else
              <div class="py-20 text-center border-2 border-dashed border-subtle rounded-md">
                <p class="text-text-muted text-xs font-bold uppercase tracking-widest">Extended portfolio available upon
                  request</p>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Sticky Sidebar -->
      <div class="w-full lg:w-1/3">
        <div class="sticky top-28 bg-surface-light p-10 rounded-md shadow-2xl border border-subtle ">
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
            <h4 class="text-2xl font-bold text-text-primary font-serif mb-8">Online Presence</h4>
            <div class="grid grid-cols-2 gap-6">
              @if($talent->website_url)
                <a href="{{ $talent->website_url }}" target="_blank" class="block p-6 bg-surface-muted border border-subtle rounded-md hover:bg-brand-primary/10 transition-all group h-full">
                    <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Website</p>
                    <p class="text-sm text-text-primary font-medium truncate">{{ $talent->website_url }}</p>
                </a>
              @endif

              @if($talent->instagram_handle)
                @php $igUrl = str_starts_with($talent->instagram_handle, 'http') ? $talent->instagram_handle : 'https://instagram.com/' . ltrim($talent->instagram_handle, '@'); @endphp
                <a href="{{ $igUrl }}" target="_blank" class="block p-6 bg-surface-muted border border-subtle rounded-md hover:bg-brand-primary/10 transition-all group h-full">
                    <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Instagram Handle</p>
                    <p class="text-sm text-text-primary font-medium truncate">{{ $talent->instagram_handle }}</p>
                </a>
              @endif

              @if($talent->facebook_url)
                <a href="{{ $talent->facebook_url }}" target="_blank" class="block p-6 bg-surface-muted border border-subtle rounded-md hover:bg-brand-primary/10 transition-all group h-full">
                    <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Facebook Page</p>
                    <p class="text-sm text-text-primary font-medium truncate">{{ $talent->facebook_url }}</p>
                </a>
              @endif

              @if($talent->youtube_channel)
                <a href="{{ $talent->youtube_channel }}" target="_blank" class="block p-6 bg-surface-muted border border-subtle rounded-md hover:bg-brand-primary/10 transition-all group h-full">
                    <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">YouTube Channel</p>
                    <p class="text-sm text-text-primary font-medium truncate">{{ $talent->youtube_channel }}</p>
                </a>
              @endif

              @if($talent->tiktok_handle)
                @php $tiktokUrl = str_starts_with($talent->tiktok_handle, 'http') ? $talent->tiktok_handle : 'https://tiktok.com/@' . ltrim($talent->tiktok_handle, '@'); @endphp
                <a href="{{ $tiktokUrl }}" target="_blank" class="block p-6 bg-surface-muted border border-subtle rounded-md hover:bg-brand-primary/10 transition-all group h-full">
                    <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">TikTok</p>
                    <p class="text-sm text-text-primary font-medium truncate">{{ $talent->tiktok_handle }}</p>
                </a>
              @endif
            </div>
          </div>
          @endif

          <!-- Share -->
          <div class="pt-8 border-t border-subtle " x-data="{ showShareModal: false, copied: false, url: window.location.href }">
            <div class="flex items-center justify-between gap-4">
              <button
                @click="showShareModal = true"
                class="flex-1 px-4 py-3 bg-surface-muted rounded-xl text-xs font-bold text-text-primary uppercase tracking-widest hover:bg-brand-primary/10 transition-colors shadow-sm border border-subtle">
                Share Portfolio
              </button>
            </div>

            <!-- Share Modal -->
            <div x-show="showShareModal" style="display: none;"
                 class="fixed inset-0 z-100 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 sm:p-6"
                 x-transition.opacity
                 @keydown.escape.window="showShareModal = false">
                 
                 <div @click.away="showShareModal = false"
                      class="bg-[#212121] text-[#f1f1f1] w-full max-w-[520px] rounded-2xl shadow-2xl flex flex-col font-sans"
                      x-transition:enter="transition ease-out duration-300"
                      x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
                      x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                      x-transition:leave="transition ease-in duration-200"
                      x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                      x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95">
                      
                      <!-- Header -->
                      <div class="flex items-center justify-between px-6 pt-5 pb-3">
                          <h3 class="text-[18px] font-medium tracking-wide">Share</h3>
                          <button @click="showShareModal = false" class="text-[#aaaaaa] hover:text-white transition-colors rounded-full p-1.5 hover:bg-white/10">
                              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                          </button>
                      </div>

                      <!-- Content -->
                      <div class="px-6 pb-7">
                          <!-- Share Options List -->
                          <div class="flex overflow-x-auto gap-2 sm:gap-4 pb-4 mb-2 snap-x scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                              <style>
                                  .scrollbar-hide::-webkit-scrollbar {
                                      display: none;
                                  }
                              </style>
                              <!-- Embed -->
                              <div class="flex flex-col items-center gap-2 min-w-[76px] snap-start">
                                  <button @click="navigator.clipboard.writeText(`<iframe src='${url}' width='100%' height='600' frameborder='0'></iframe>`); copied = true; setTimeout(() => copied = false, 2000)" class="w-[60px] h-[60px] rounded-full bg-[#3d3d3d] flex items-center justify-center hover:bg-[#4d4d4d] transition-colors group">
                                      <svg class="w-7 h-7 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">Embed</span>
                              </div>
                              
                              <!-- WhatsApp -->
                              <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent('Check out this talent: ' + url)" target="_blank" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-[#25D366] flex items-center justify-center group-hover:opacity-90 transition-opacity">
                                      <svg class="w-8 h-8 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">WhatsApp</span>
                              </a>

                              <!-- Facebook -->
                              <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url)" target="_blank" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-[#1877F2] flex items-center justify-center group-hover:opacity-90 transition-opacity">
                                      <svg class="w-8 h-8 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">Facebook</span>
                              </a>

                              <!-- X (Twitter) -->
                              <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url)" target="_blank" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-black flex items-center justify-center group-hover:bg-gray-900 transition-colors border border-white/10">
                                      <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">X</span>
                              </a>

                              <!-- Email -->
                              <a :href="'mailto:?subject=' + encodeURIComponent('Check out this portfolio') + '&body=' + encodeURIComponent(url)" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-[#3d3d3d] flex items-center justify-center group-hover:bg-[#4d4d4d] transition-colors">
                                      <svg class="w-7 h-7 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">Email</span>
                              </a>
                          </div>

                          <!-- Link Copy Box -->
                          <div class="mt-2 flex items-center bg-[#0f0f0f] rounded-xl border border-white/10 p-1.5 pl-4 shadow-inner">
                              <div class="flex-1 overflow-hidden mr-2">
                                  <p class="text-[14px] text-[#f1f1f1] truncate" x-text="url"></p>
                              </div>
                              <button @click="navigator.clipboard.writeText(url); copied = true; setTimeout(() => copied = false, 2000)" 
                                      class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white text-[14px] font-medium rounded-full transition-colors shrink-0">
                                  <span x-text="copied ? 'Copied' : 'Copy'"></span>
                              </button>
                          </div>
                      </div>
                 </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>