This file is a merged representation of a subset of the codebase, containing specifically included files, combined into a single document by Repomix.

# File Summary

## Purpose
This file contains a packed representation of a subset of the repository's contents that is considered the most important context.
It is designed to be easily consumable by AI systems for analysis, code review,
or other automated processes.

## File Format
The content is organized as follows:
1. This summary section
2. Repository information
3. Directory structure
4. Repository files (if enabled)
5. Multiple file entries, each consisting of:
  a. A header with the file path (## File: path/to/file)
  b. The full contents of the file in a code block

## Usage Guidelines
- This file should be treated as read-only. Any changes should be made to the
  original repository files, not this packed version.
- When processing this file, use the file path to distinguish
  between different files in the repository.
- Be aware that this file may contain sensitive information. Handle it with
  the same level of security as you would the original repository.

## Notes
- Some files may have been excluded based on .gitignore rules and Repomix's configuration
- Binary files are not included in this packed representation. Please refer to the Repository Structure section for a complete list of file paths, including binary files
- Only files matching these patterns are included: resources/views/livewire/public/talent-directory.blade.php, resources/views/livewire/public/show-talent.blade.php, resources/views/components/layouts/app.blade.php, app/Livewire/Public/ShowTalent.php, app/Http/Controllers/OgImageController.php, routes/web.php, app/Models/Talent.php
- Files matching patterns in .gitignore are excluded
- Files matching default ignore patterns are excluded
- Files are sorted by Git change count (files with more changes are at the bottom)

# Directory Structure
```
app/
  Http/
    Controllers/
      OgImageController.php
  Livewire/
    Public/
      ShowTalent.php
  Models/
    Talent.php
resources/
  views/
    components/
      layouts/
        app.blade.php
    livewire/
      public/
        show-talent.blade.php
        talent-directory.blade.php
routes/
  web.php
```

# Files

## File: app/Http/Controllers/OgImageController.php
```php
<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OgImageController extends Controller
{
    public function show(string $slug)
    {
        $talent = Talent::where('slug', $slug)->firstOrFail();

        return Cache::remember("talent_og_image_{$talent->id}", 86400, function () use ($talent) {
            $manager = new ImageManager(new Driver());

            // 1. Get Base Image
            $source = $talent->primary_image_url ?: $talent->getFirstMediaUrl('primary_image', 'optimized');
            
            if (!$source) {
                // Generate initials fallback if no image
                $name = urlencode($talent->name);
                $source = "https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=1200";
            }

            try {
                // In Intervention v4, use decode() instead of read()
                $image = $manager->decode($source);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("OG Image generation failed for talent {$talent->id}: " . $e->getMessage());
                // Fallback to a solid color if image fails to load
                // In Intervention v4, use createImage() instead of create()
                $image = $manager->createImage(1200, 630)->fill('223757');
            }

            // 2. Resize to OG dimensions (1200x630)
            $image->cover(1200, 630);

            // 3. Add Dark Gradient Overlay
            $image->fill('rgba(0, 0, 0, 0.4)');

            // 4. Place Hailerz Logo (Top-Left)
            $logoPath = public_path('images/logo.webp');
            if (file_exists($logoPath)) {
                // Use decode() for the logo as well
                $logo = $manager->decode($logoPath);
                $logo->scale(height: 60);
                // In Intervention v4, use insert() instead of place()
                $image->insert($logo, 40, 40);
            }

            // 5. Encode as WebP and return
            return Response::make($image->encodeUsingMediaType('image/webp')->toString(), 200, [
                'Content-Type' => 'image/webp',
                'Cache-Control' => 'public, max-age=86400',
            ]);
        });
    }
}
```

## File: app/Livewire/Public/ShowTalent.php
```php
<?php

namespace App\Livewire\Public;

use App\Models\Talent;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ShowTalent extends Component
{
    public Talent $talent;

    public function mount(string $slug)
    {
        $this->talent = Talent::with('galleryItems')->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.show-talent')
            ->title('Book ' . $this->talent->name . ' | Hailerz')
            ->layout('components.layouts.app', [
                'ogTitle' => $this->talent->name . ' | Premium Talent',
                'ogDescription' => Str::limit(strip_tags($this->talent->bio), 150),
                'ogImage' => route('og.talent', $this->talent->slug),
            ]);
    }
}
```

## File: app/Models/Talent.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Talent extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, SoftDeletes;

    protected $table = 'talents';
    protected $guarded = [];
    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->primary_image_url) {
            return $this->primary_image_url;
        }

        return $this->getFirstMediaUrl('primary_image', 'thumb') ?: null;
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        $url = $this->primary_image_url ?: $this->getFirstMediaUrl('primary_image', 'optimized');

        if ($url) {
            return $url;
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=223757&color=ffffff&size=800';
    }

    protected function casts(): array
    {
        return [
            'starting_price' => 'decimal:2',
            'is_featured' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('primary_image')
            ->singleFile();

        $this->addMediaCollection('gallery');
    }

    public function galleryItems(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(GalleryItem::class, 'galleryable');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(400)
            ->sharpen(10);

        $this->addMediaConversion('optimized')
            ->width(1200)
            ->height(800)
            ->withResponsiveImages();
    }
}
```

## File: routes/web.php
```php
<?php

use App\Livewire\Public\Home;
use App\Livewire\Public\TalentDirectory;
use App\Livewire\Public\ShowTalent;
use App\Livewire\Public\BookingWizard;
use App\Livewire\Public\About;
use App\Livewire\Public\Services;
use App\Livewire\Public\JoinTalent;
use App\Livewire\BookingConfirmation;
use App\Livewire\PostList;
use App\Livewire\ShowPost;
use App\Livewire\Public\Legal\TermsOfService;
use App\Livewire\Public\Legal\PrivacyPolicy;
use App\Livewire\Public\Legal\BookingAgreement;
use App\Livewire\Public\Legal\CancellationPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OgImageController;

// Public Frontends
Route::get('/', Home::class)->name('home');
Route::get('/talent', TalentDirectory::class)->name('talent.directory');
Route::get('/talent/{slug}', ShowTalent::class)->name('talent.show');
Route::get('/og/talent/{slug}', [OgImageController::class, 'show'])->name('og.talent');
Route::get('/book', BookingWizard::class)->name('booking.wizard');
Route::get('/book/confirm', BookingConfirmation::class)->name('booking.confirmation');

Route::get('/about', About::class)->name('about');
Route::get('/services', Services::class)->name('services');
Route::get('/staffing', \App\Livewire\Public\Staffing::class)->name('staffing');
Route::get('/contact', \App\Livewire\Public\Contact::class)->name('contact');
Route::get('/join', JoinTalent::class)->name('join');

// Legal
Route::get('/legal/terms', TermsOfService::class)->name('legal.terms');
Route::get('/legal/privacy', PrivacyPolicy::class)->name('legal.privacy');
Route::get('/legal/booking', BookingAgreement::class)->name('legal.booking');
Route::get('/legal/cancellation', CancellationPolicy::class)->name('legal.cancellation');

// News / Blog
Route::get('/news', PostList::class)->name('news.index');
Route::get('/news/{slug}', ShowPost::class)->name('news.show');

// Maintenance
Route::view('/maintenance', 'maintenance')->name('maintenance');

// CSP Violation Reports
Route::post('/csp-report', function (Request $request) {
    $report = $request->json()->all();
    if (!empty($report)) {
        Log::warning('CSP Violation', $report);
    }
    return response()->noContent();
})->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
  ->middleware('throttle:30,1')
  ->name('csp.report');
```

## File: resources/views/livewire/public/show-talent.blade.php
```php
<div class="bg-surface-muted min-h-screen">

  <!-- Hero / Primary Showcase -->
  <div class="relative h-[600px] bg-surface-dark overflow-hidden">
    <img src="{{ $talent->profile_photo_url }}" alt="{{ $talent->name }}"
      class="w-full h-full object-cover grayscale opacity-60 transition-transform duration-1000 scale-105">

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
                  {{ $talent->starting_price ? '$' . number_format($talent->starting_price, 0) : 'Custom Quotation' }}
                </p>
              </div>
            </div>
          </div>

          <x-button variant="primary" size="lg" class="w-full mb-6" href="/book?talent={{ $talent->id }}" wire:navigate>
            Book Now
          </x-button>

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
```

## File: resources/views/livewire/public/talent-directory.blade.php
```php
<div class="bg-surface-muted min-h-screen py-20">
 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  
  <div class="mb-16">
   <div class="flex items-center gap-3 mb-4">
    <span class="h-px w-12 bg-brand-primary"></span>
    <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Global Talent Network</span>
   </div>
   <h1 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight font-serif"><span class="text-brand-secondary">Talent</span></h1>
   <p class="mt-4 text-lg text-text-secondary max-w-2xl">Discover and secure world-class performers, keynote speakers, and specialty acts for your next high-profile event.</p>
  </div>

  <div class="flex flex-col lg:flex-row gap-12">
   
   <!-- Sidebar Filters -->
   <aside class="w-full lg:w-1/4">
    <div class="sticky top-28 bg-surface-light p-8 rounded-3xl shadow-sm border border-subtle ">
     <div class="flex items-center justify-between mb-10">
      <h2 class="text-xs font-bold text-text-secondary uppercase tracking-widest">Refine Search</h2>
      <button wire:click="resetFilters" class="text-[10px] font-bold text-brand-primary uppercase tracking-widest hover:underline transition-colors">
       Reset All
      </button>
     </div>
     
     <div class="space-y-10">
      <!-- Search -->
      <div>
       <label for="search" class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-4">Keywords</label>
       <input wire:model.live.debounce.300ms="search" type="text" id="search" class="w-full px-5 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-all outline-none text-text-primary text-sm font-medium" placeholder="Name or expertise...">
      </div>

      <!-- Sort Order -->
      <div>
       <label for="sort" class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-4">Priority</label>
       <select wire:model.live="sort" id="sort" class="w-full px-5 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-all outline-none text-text-primary text-sm font-medium appearance-none">
        <option value="name">Alphabetical</option>
        <option value="latest">Newly Commissioned</option>
        <option value="price_asc">Investment: Low to High</option>
        <option value="price_desc">Investment: High to Low</option>
       </select>
      </div>

      <!-- Category -->
      <div>
       <label for="category" class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-4">Talent Category</label>
       <select wire:model.live="category_id" id="category" class="w-full px-5 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-all outline-none text-text-primary text-sm font-medium appearance-none">
        <option value="">All Disciplines</option>
        @foreach($categories as $category)
         <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
       </select>
      </div>

      <!-- Location -->
      <div x-data="{
       isLocating: false,
       locationError: '',
       async tryIpFallback() {
        try {
         const res = await fetch('https://ipapi.co/json/');
         const data = await res.json();
         if (!data.error && data.city) {
          @this.set('location', data.city);
         } else {
          this.locationError = 'unavailable';
         }
        } catch(e) {
         this.locationError = 'unavailable';
        } finally {
         this.isLocating = false;
        }
       },
       locateMe() {
        this.isLocating = true;
        this.locationError = '';
        if (!navigator.geolocation) {
         this.tryIpFallback();
         return;
        }
        navigator.geolocation.getCurrentPosition(
         async (position) => {
          try {
           const { latitude, longitude } = position.coords;
           const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
           const data = await response.json();
           let city = data.address.city || data.address.town || data.address.village || data.address.county;
           if (city) {
            @this.set('location', city);
            this.isLocating = false;
           } else {
            await this.tryIpFallback();
           }
          } catch(e) {
           await this.tryIpFallback();
          }
         },
         async (err) => {
          if (err.code === 1) {
           this.locationError = 'denied';
           this.isLocating = false;
          } else {
           await this.tryIpFallback();
          }
         },
         { timeout: 8000, maximumAge: 60000 }
        );
       }
      }">
       <div class="flex items-center justify-between mb-4">
        <label for="location" class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest">Base Location</label>
        <button @click="locateMe()" type="button" class="text-[10px] font-bold text-brand-primary uppercase tracking-widest hover:underline flex items-center gap-1">
         <svg x-show="!isLocating" class="w-3 h-3 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
         <span x-text="isLocating ? '...' : 'Auto-Detect'"></span>
        </button>
       </div>
       <p x-show="locationError === 'denied'" class="text-[10px] text-red-400 mb-2">Location access denied. Please type your city manually.</p>
       <p x-show="locationError === 'unavailable'" class="text-[10px] text-amber-400 mb-2">Could not detect location. Please type your city manually.</p>
       <input
        wire:model.live.debounce.300ms="location"
        type="text"
        id="location"
        list="location-suggestions"
        autocomplete="off"
        placeholder="City or region..."
        class="w-full px-5 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-all outline-none text-text-primary text-sm font-medium"
       >
       <datalist id="location-suggestions">
        @foreach($locations as $loc)
         <option value="{{ $loc }}">
        @endforeach
       </datalist>
      </div>
     </div>
    </div>
   </aside>

   <!-- Talent Grid -->
   <main class="w-full lg:w-3/4">
    
    <div class="transition-opacity duration-300">
     @if($talents->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
       @foreach($talents as $talent)
        <div class="bg-surface-light rounded-2xl shadow-sm border border-subtle overflow-hidden group hover:shadow-2xl transition-all duration-500">
         <a href="/talent/{{ $talent->slug }}" wire:navigate class="block">
          <div class="group relative overflow-hidden aspect-3/4 bg-surface-dark">
           <img src="{{ $talent->profile_photo_url }}" width="400" height="533" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $talent->name }}" />
           
           <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-80 transition-opacity group-hover:opacity-60"></div>
           <div class="absolute inset-0 bg-linear-to-t from-surface-dark via-surface-dark/60 to-transparent"></div>
           
           @if($talent->is_featured)
            <div class="absolute top-6 right-6 bg-brand-primary text-text-inverse text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
             Premier Act
            </div>
           @endif
           
           <div class="absolute bottom-6 left-6">
            <p class="text-[10px] font-bold text-text-inverse/70 uppercase tracking-widest mb-1">{{ $talent->category?->name ?? 'Professional' }}</p>
            <h3 class="text-xl font-bold text-text-inverse">{{ $talent->name }}</h3>
           </div>
          </div>
         </a>
         
         <div class="p-8">
          <div class="flex items-center gap-2 text-xs text-text-secondary mb-6">
           <svg class="w-4 h-4 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
           {{ $talent->location ?? 'International' }}
          </div>
          
          <div class="flex justify-between items-center pt-6 border-t border-subtle ">
           <div>
            <p class="text-[10px] font-bold text-text-secondary uppercase tracking-widest">Starting Investment</p>
            <p class="text-lg font-bold text-text-primary">${{ number_format($talent->starting_price ?? 0, 0) }}</p>
           </div>
           <x-button variant="ghost" size="sm" href="/talent/{{ $talent->slug }}" wire:navigate class="text-brand-primary hover:text-brand-primary/80">
            View Profile
           </x-button>
          </div>
         </div>
        </div>
       @endforeach
      </div>
      
      @if($talents->hasMorePages())
       <div x-data="{
        isLoading: false,
        observe() {
         let observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
           if (entry.isIntersecting && !this.isLoading) {
            this.isLoading = true;
            @this.loadMore().then(() => {
             this.isLoading = false;
            });
           }
          })
         }, { rootMargin: '400px' })
         observer.observe(this.$el)
        }
       }" x-init="observe()" class="mt-12 py-12 flex justify-center">
        <div class="flex items-center gap-3 text-text-muted">
         <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
         <span class="text-sm font-semibold uppercase tracking-widest">Loading More Talent...</span>
        </div>
       </div>
      @endif
     @else
      <div class="text-center py-32 bg-surface-light rounded-3xl border border-dashed border-subtle ">
       <h3 class="text-2xl font-bold text-text-primary mb-4 font-serif">No Results Found</h3>
       <p class="text-text-secondary mb-8">Refine your criteria to explore our alternative talent members.</p>
       <x-button variant="secondary" wire:click="resetFilters">
        Clear All Filters
       </x-button>
      </div>
     @endif
    </div>

   </main>
  </div>
 </div>
</div>
```

## File: resources/views/components/layouts/app.blade.php
```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Hailerz is a premium talent booking agency connecting event planners with world-class performers, keynote speakers, and corporate entertainers.">
  <meta name="theme-color" content="#223757">
  <link rel="apple-touch-icon" href="/images/logo.webp">

  <title>{{ $title ?? 'Hailerz | Premium Talent Booking Agency' }}</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $ogTitle ?? ($title ?? 'Hailerz | Premium Talent Booking Agency') }}">
  <meta property="og:description"
    content="{{ $ogDescription ?? 'A boutique talent agency specializing in securing world-class performers for corporate events, galas, and private functions.' }}">
  <meta property="og:image" content="{{ $ogImage ?? asset('images/logo.webp') }}">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="{{ url()->current() }}">
  <meta name="twitter:title" content="{{ $ogTitle ?? ($title ?? 'Hailerz | Premium Talent Booking Agency') }}">
  <meta name="twitter:description"
    content="{{ $ogDescription ?? 'A boutique talent agency specializing in securing world-class performers for corporate events, galas, and private functions.' }}">
  <meta name="twitter:image" content="{{ $ogImage ?? asset('images/logo.webp') }}">

  <!-- Self-hosted fonts loaded via @font-face + font-display:swap in app.css -->
  <link rel="manifest" href="/manifest.json">

  @production
    <script>
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
          navigator.serviceWorker.register('/sw.js');
        });
      }
    </script>
  @else
    <script>
      // Auto-unregister service workers in development to prevent stale cache issues
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.getRegistrations().then(function (registrations) {
          for (let registration of registrations) {
            registration.unregister();
            console.log('Service Worker unregistered');
          }
        });
      }
    </script>
  @endproduction

  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="icon" href="/images/logo.webp" type="image/webp">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <script>
    function applyTheme() {
      if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    }

    function toggleTheme() {
      const isDark = document.documentElement.classList.toggle('dark');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
      window.dispatchEvent(new CustomEvent('theme-changed', { detail: { isDark } }));
    }

    applyTheme();
    document.addEventListener('livewire:navigated', applyTheme);
  </script>

  @stack('head')
  @livewireStyles
</head>

<body
  class="bg-surface-light text-text-primary font-sans antialiased flex flex-col min-h-screen transition-colors duration-300">

  <header
    class="sticky top-0 z-50 w-full backdrop-blur-xl bg-surface-light/90 border-b border-subtle transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="shrink-0 flex items-center">
          <a href="/" class="flex items-center gap-2.5" aria-label="Hailerz Home">
            <img src="/images/logo.webp" alt="" aria-hidden="true" width="40" height="41"
              class="h-10 w-auto object-contain rounded-lg" />
            <span
              class="text-2xl font-bold tracking-tight font-serif {{ request()->is('/') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors uppercase tracking-widest hidden lg:block">
              Hailerz
            </span>
          </a>
        </div>
        <nav class="hidden md:flex items-center space-x-10">
          <a href="/talent" wire:navigate
            class="text-xs font-bold {{ request()->is('talent*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors uppercase tracking-widest">The
            Talent</a>
          <a href="/services" wire:navigate
            class="text-xs font-bold {{ request()->is('services*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors uppercase tracking-widest">Services</a>
          <a href="/staffing" wire:navigate
            class="text-xs font-bold {{ request()->is('staffing*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors uppercase tracking-widest">Staffing</a>
          <a href="/about" wire:navigate
            class="text-xs font-bold {{ request()->is('about*') ? 'text-brand-primary' : 'text-text-secondary hover:text-brand-primary' }} transition-colors uppercase tracking-widest">The
            Agency</a>
        </nav>

        <div class="flex items-center space-x-4">
          <!-- Desktop Theme Toggle -->
          <div class="hidden md:block">
            <x-theme-toggle />
          </div>

          <x-button variant="primary" size="sm" href="/book" wire:navigate
            class="flex border-none shadow-lg px-6 py-2.5 rounded-full hover:scale-105 transition-transform text-xs sm:text-sm">
            Book Now
          </x-button>

          <!-- Mobile Menu Container -->
          <x-mobile-menu />
        </div>
      </div>
    </div>
  </header>

  <main class="grow">
    {{ $slot }}
  </main>

  <footer class="bg-surface-light text-text-primary border-t border-subtle ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
        <div class="col-span-1 md:col-span-1">
          <a href="/" class="flex items-center gap-2.5 mb-6" aria-label="Hailerz Home">
            <img src="/images/logo.webp" alt="" aria-hidden="true" width="32" height="33"
              class="h-8 w-auto object-contain rounded" />
            <span class="text-2xl font-bold tracking-tight text-brand-primary font-serif">
              Hailerz
            </span>
          </a>
          <p class="text-text-secondary leading-relaxed text-sm mb-6">
            A boutique talent agency specializing in securing world-class performers for corporate events, galas, and
            private functions.
          </p>
          <div class="flex gap-4">
            <a href="#" aria-label="Follow us on LinkedIn"
              class="h-12 w-12 rounded-xl bg-surface-muted hover:bg-brand-primary/20 transition-colors flex items-center justify-center text-text-secondary">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
              </svg>
            </a>
            <a href="#" aria-label="Follow us on Instagram"
              class="h-12 w-12 rounded-xl bg-surface-muted hover:bg-brand-primary/20 transition-colors flex items-center justify-center text-text-secondary">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
              </svg>
            </a>
            <a href="#" aria-label="Follow us on Twitter"
              class="h-12 w-12 rounded-xl bg-surface-muted hover:bg-brand-primary/20 transition-colors flex items-center justify-center text-text-secondary">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
              </svg>
            </a>
          </div>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Talent</h3>
          <ul class="space-y-4">
            <li><a href="/talent" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">All Talent</a></li>
            <li><a href="/talent?category=speakers"
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Speakers</a></li>
            <li><a href="/talent?category=musicians"
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Musicians</a></li>
            <li><a href="/talent?category=variety-artists"
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Variety Artists</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Agency</h3>
          <ul class="space-y-4">
            <li><a href="/about" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Our Story</a></li>
            <li><a href="/services" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Services</a></li>
            <li><a href="/staffing" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Staffing &
                Augmentation</a></li>
            <li><a href="/join" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Join Talent</a></li>
            <li><a href="/contact" wire:navigate
                class="text-sm text-text-secondary hover:text-brand-primary transition-colors">Contact</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-6">Secure Talent</h3>
          <p class="text-sm text-text-secondary mb-6">Ready to elevate your next event with premium talent?</p>
          <x-button variant="secondary" size="sm" class="w-full " href="/book" wire:navigate>
            Start Inquiry
          </x-button>
        </div>
      </div>

      <div class="mt-20 pt-8 border-t border-subtle flex flex-col md:row justify-between items-center gap-6">
        <p class="text-xs text-text-muted">
          &copy; {{ date('Y') }} Hailerz Premium Talent Booking. All rights reserved.
        </p>
        <div class="flex gap-8">
          <a href="/legal/privacy" wire:navigate
            class="text-xs text-text-muted hover:text-brand-primary transition-colors">Privacy</a>
          <a href="/legal/terms" wire:navigate
            class="text-xs text-text-muted hover:text-brand-primary transition-colors">Terms</a>
          <a href="/legal/booking-agreement" wire:navigate
            class="text-xs text-text-muted hover:text-brand-primary transition-colors">Booking Agreement</a>
        </div>
      </div>
    </div>
  </footer>

  @livewireScripts
</body>

</html>
```
