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
        <h1 class="text-4xl sm:text-6xl md:text-8xl font-bold text-text-inverse tracking-tight wrap-break-words">{{ $talent->name }}</h1>
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
                    $embedUrl = "https://www.youtube.com/embed/{$match[1]}?autoplay=1&mute=1&rel=0";
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

        <div class="mb-12 border-b border-subtle overflow-x-auto scrollbar-hide">
          <nav class="flex space-x-8 md:space-x-12 min-w-max">
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
            <x-card padding="p-8 md:p-12" x-show="activeTab === 'rider'" x-cloak x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
              class="prose max-w-none text-text-secondary">
              <h3 class="text-text-primary mb-6 ">Production & Technical Rider</h3>
              @if(filter_var($talent->technical_rider, FILTER_VALIDATE_URL))
                <p>Our technical requirements are available at the following link:</p>
                <a href="{{ $talent->technical_rider }}" target="_blank"
                  class="text-brand-primary font-bold hover:underline">View Technical Rider</a>
              @else
                {!! $talent->technical_rider !!}
              @endif
            </x-card>
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
                  },
                  closeLightbox() {
                      this.lightboxOpen = false;
                      this.lightboxUrl = '';
                  }
               }">
            @if($talent->galleryItems->count() > 0)
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($talent->galleryItems as $item)
                  <x-card padding="p-0" class="group transition-all duration-500 flex flex-col h-full overflow-hidden">
                    <div class="relative overflow-hidden bg-surface-dark aspect-video">
                      @php
                        $galleryEmbedUrl = '';
                        $thumbnailUrl = $item->url;
                        $isvimeo = false;
                        
                        if (str_contains($item->url, 'youtube.com') || str_contains($item->url, 'youtu.be')) {
                          preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $item->url, $match);
                          if (isset($match[1])) {
                            $galleryEmbedUrl = "https://www.youtube.com/embed/{$match[1]}?autoplay=1&mute=1&rel=0";
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
                              <x-lucide-play class="w-8 h-8 ml-1" fill="currentColor" stroke-width="0" />
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
                              <x-lucide-zoom-in class="w-6 h-6" stroke-width="2" />
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
                  </x-card>
                @endforeach
              </div>

              {{-- Lightbox --}}
              <div x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-100 flex items-center justify-center bg-surface-dark/80 backdrop-blur-xl p-4 md:p-10"
                @click="closeLightbox()" @keydown.escape.window="closeLightbox()" x-cloak>

                <button @click="closeLightbox()" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors z-101" aria-label="Close Lightbox">
                  <x-lucide-x class="w-8 h-8" stroke-width="1.5" />
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
                    <h4 x-text="lightboxTitle" class="text-text-inverse text-xl  tracking-wide"></h4>
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

      <div class="w-full lg:w-1/3">
        <x-card padding="p-6 md:p-10" class="lg:sticky lg:top-28 shadow-2xl">
          <h3 class="text-2xl font-bold text-text-primary mb-8 ">Booking Information</h3>

          <div class="space-y-8 mb-10">
            <div class="flex items-start gap-5">
              <div
                class="h-10 w-10 rounded-xl bg-text-secondary/10 flex items-center justify-center text-text-secondary shrink-0">
                <x-lucide-map-pin class="w-5 h-5" stroke-width="2" />
              </div>
              <div>
                <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-1">Base Location</p>
                <p class="text-text-primary font-semibold">{{ $talent->location }}{{ $talent->country ? ', ' . $talent->country : '' }}</p>
              </div>
            </div>
            <div class="flex items-start gap-5">
              <div
                class="h-10 w-10 rounded-xl bg-text-secondary/10 flex items-center justify-center text-text-secondary shrink-0">
                <x-lucide-banknote class="w-5 h-5" stroke-width="2" />
              </div>
              <div>
                <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-1">Starting Rate</p>
                <p class="text-text-primary font-semibold text-xl">
                  {{ $talent->starting_price ? \App\Helpers\CurrencyHelper::format($talent->starting_price) : 'Custom Quotation' }}
                </p>
              </div>
            </div>
          </div>

          <x-button variant="primary" size="lg" class="w-full mb-6" href="/book?talent={{ $talent->id }}" wire:navigate>
            Book Now
          </x-button>

          @if($talent->website_url || $talent->instagram_handle || $talent->facebook_url || $talent->youtube_channel || $talent->tiktok_handle)
          <div class="pt-8 border-t border-subtle mb-6">
            <h4 class="text-2xl font-bold text-text-primary  mb-8">Online Presence</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
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
              <x-button
                @click="showShareModal = true"
                variant="outline"
                class="w-full">
                Share Portfolio
              </x-button>
            </div>

            <!-- Share Modal -->
            <div x-show="showShareModal" style="display: none;"
                 class="fixed inset-0 z-100 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 sm:p-6"
                 x-transition.opacity
                 @keydown.escape.window="showShareModal = false">
                 
                 <div @click.away="showShareModal = false"
                      class="bg-surface-dark text-text-inverse w-full max-w-[520px] rounded-2xl shadow-sm border border-white/10 flex flex-col "
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
                              <x-lucide-x class="w-6 h-6" stroke-width="2" />
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
                                      <x-lucide-code class="w-7 h-7 text-white group-hover:scale-110 transition-transform" stroke-width="1.5" />
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">Embed</span>
                              </div>
                              
                              <!-- WhatsApp -->
                              <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent('Check out this talent: ' + url)" target="_blank" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-[#25D366] flex items-center justify-center group-hover:opacity-90 transition-opacity">
                                      <x-lucide-message-circle class="w-8 h-8 text-white group-hover:scale-110 transition-transform" stroke-width="2" />
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">WhatsApp</span>
                              </a>

                              <!-- Facebook -->
                              <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url)" target="_blank" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-[#1877F2] flex items-center justify-center group-hover:opacity-90 transition-opacity">
                                      <x-lucide-facebook class="w-8 h-8 text-white group-hover:scale-110 transition-transform" stroke-width="2" />
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">Facebook</span>
                              </a>

                              <!-- X (Twitter) -->
                              <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url)" target="_blank" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-black flex items-center justify-center group-hover:bg-gray-900 transition-colors border border-white/10">
                                      <x-lucide-twitter class="w-6 h-6 text-white group-hover:scale-110 transition-transform" stroke-width="2" />
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">X</span>
                              </a>

                              <!-- Email -->
                              <a :href="'mailto:?subject=' + encodeURIComponent('Check out this portfolio') + '&body=' + encodeURIComponent(url)" class="flex flex-col items-center gap-2 min-w-[76px] snap-start group">
                                  <button class="w-[60px] h-[60px] rounded-full bg-[#3d3d3d] flex items-center justify-center group-hover:bg-[#4d4d4d] transition-colors">
                                      <x-lucide-mail class="w-7 h-7 text-white group-hover:scale-110 transition-transform" stroke-width="1.5" />
                                  </button>
                                  <span class="text-[13px] text-[#aaaaaa]">Email</span>
                              </a>
                          </div>

                          <!-- Link Copy Box -->
                          <div class="mt-2 flex flex-col sm:flex-row items-center bg-black rounded-2xl sm:rounded-full border border-white/10 p-1.5 shadow-inner gap-2 sm:gap-0">
                              <x-input 
                                  x-model="url" 
                                  readonly 
                                  class="w-full sm:flex-1 bg-transparent! border-none! text-text-inverse! text-[13px] sm:text-[14px]! py-2! sm:py-2.5! ring-0!" 
                              />
                              <button @click="navigator.clipboard.writeText(url); copied = true; setTimeout(() => copied = false, 2000)" 
                                      class="w-full sm:w-auto px-5 py-2 sm:py-2.5 bg-white/10 hover:bg-white/20 text-white text-[13px] sm:text-[14px] font-medium rounded-xl sm:rounded-full transition-colors shrink-0">
                                  <span x-text="copied ? 'Copied' : 'Copy'"></span>
                              </button>
                          </div>
                      </div>
                 </div>
            </div>
          </div>
        </x-card>
      </div>

    </div>
  </div>
</div>