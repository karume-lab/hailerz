<div class="bg-surface-muted min-h-screen py-20">
 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  
  <div class="mb-16">
   <div class="flex items-center gap-3 mb-4">
    <span class="h-px w-12 bg-brand-primary"></span>
    <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Global Talent Network</span>
   </div>
   <h1 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight font-serif">Talent</h1>
   <p class="mt-4 text-lg text-text-secondary max-w-2xl">Discover and secure world-class performers, keynote speakers, and specialty acts for your next high-profile event.</p>
  </div>

  <div class="flex flex-col lg:flex-row gap-12">
   
   <!-- Sidebar Filters -->
   <aside class="w-full lg:w-1/4">
    <div class="sticky top-28 bg-surface-light p-8 rounded-3xl shadow-sm border border-subtle ">
     <div class="flex items-center justify-between mb-10">
      <h2 class="text-xs font-bold text-text-muted uppercase tracking-widest">Refine Search</h2>
      <button wire:click="resetFilters" class="text-[10px] font-bold text-brand-primary uppercase tracking-widest hover:underline transition-colors">
       Reset All
      </button>
     </div>
     
     <div class="space-y-10">
      <!-- Search -->
      <div>
       <label for="search" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-4">Keywords</label>
       <input wire:model.live.debounce.300ms="search" type="text" id="search" class="w-full px-5 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-all outline-none text-text-primary text-sm font-medium" placeholder="Name or expertise...">
      </div>

      <!-- Sort Order -->
      <div>
       <label for="sort" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-4">Priority</label>
       <select wire:model.live="sort" id="sort" class="w-full px-5 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent transition-all outline-none text-text-primary text-sm font-medium appearance-none">
        <option value="name">Alphabetical</option>
        <option value="latest">Newly Commissioned</option>
        <option value="price_asc">Investment: Low to High</option>
        <option value="price_desc">Investment: High to Low</option>
       </select>
      </div>

      <!-- Category -->
      <div>
       <label for="category" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-4">Talent Category</label>
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
        <label for="location" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest">Base Location</label>
        <button @click="locateMe()" type="button" class="text-[10px] font-bold text-brand-primary uppercase tracking-widest hover:underline flex items-center gap-1">
         <svg x-show="!isLocating" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
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
           @if($talent->primary_image_url)
            <img src="{{ $talent->primary_image_url }}" width="400" height="533" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $talent->name }}" />
           @elseif($talent->hasMedia('primary_image'))
            <img src="{{ $talent->getFirstMediaUrl('primary_image') }}" width="400" height="533" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $talent->name }}" />
            @else
            <div class="w-full h-full flex items-center justify-center bg-surface-dark">
             <span class="text-4xl font-bold text-text-inverse/20 font-serif">{{ substr($talent->name, 0, 1) }}</span>
            </div>
           @endif
           <div class="absolute inset-0 bg-linear-to-tr from-brand-primary/80 to-brand-secondary/40 mix-blend-color opacity-80 transition-opacity group-hover:opacity-60"></div>
           <div class="absolute inset-0 bg-linear-to-t from-surface-dark/90 via-transparent to-transparent"></div>
           
           @if($talent->is_featured)
            <div class="absolute top-6 right-6 bg-brand-primary text-text-inverse text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
             Premier Act
            </div>
           @endif
           
           <div class="absolute bottom-6 left-6">
            <p class="text-[10px] font-bold text-brand-secondary uppercase tracking-widest mb-1">{{ $talent->category?->name ?? 'Professional' }}</p>
            <h3 class="text-xl font-bold text-text-inverse">{{ $talent->name }}</h3>
           </div>
          </div>
         </a>
         
         <div class="p-8">
          <div class="flex items-center gap-2 text-xs text-text-secondary mb-6">
           <svg class="w-4 h-4 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
           {{ $talent->location ?? 'International' }}
          </div>
          
          <div class="flex justify-between items-center pt-6 border-t border-subtle ">
           <div>
            <p class="text-[10px] font-bold text-text-muted uppercase tracking-widest">Starting Investment</p>
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
       <p class="text-text-secondary mb-8">Refine your criteria to explore our alternative roster members.</p>
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
