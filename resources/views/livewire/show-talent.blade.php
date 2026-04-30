<div class="pb-24">
 <!-- Profile Hero -->
 <section class="bg-white border-b border-subtle py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   <div class="flex flex-col lg:flex-row gap-16">
    <!-- Image Gallery -->
    <div class="w-full lg:w-1/2">
     <div class="rounded-4xl overflow-hidden shadow-2xl shadow-brand-primary/10 aspect-4/5 bg-surface-muted">
      <img src="{{ $talent->getFirstMediaUrl('primary_image') ?: 'https://images.unsplash.com/photo-1514525253361-bee8a187499b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
       alt="{{ $talent->name }}" class="w-full h-full object-cover">
     </div>
    </div>

    <!-- Info -->
    <div class="w-full lg:w-1/2 flex flex-col">
     <div class="mb-10 flex flex-wrap items-center gap-4">
      <span
       class="px-4 py-1.5 bg-brand-primary/10 text-brand-primary text-xs font-bold uppercase tracking-widest rounded-full">
       {{ $talent->category?->name }}
      </span>
      @if($talent->is_featured)
       <span
        class="px-4 py-1.5 bg-surface-dark text-white text-xs font-bold uppercase tracking-widest rounded-full">
        Featured Artist
       </span>
      @endif
     </div>

     <h1 class="text-5xl md:text-6xl font-serif font-black text-text-primary mb-6 tracking-tight">
      {{ $talent->name }}
     </h1>

     <div class="flex items-center gap-6 mb-12 text-text-muted">
      <div class="flex items-center gap-2">
       <x-heroicon-o-map-pin class="w-5 h-5 text-text-muted" />
       <span class="text-sm font-semibold">{{ $talent->location }}</span>
      </div>
      <div class="flex items-center gap-2">
       <x-heroicon-o-banknotes class="w-5 h-5 text-text-muted" />
       <span class="text-sm font-semibold">Starts at
        ${{ number_format($talent->starting_price, 0) }}</span>
      </div>
     </div>

     <div class="prose prose-slate prose-lg mb-12 max-w-none">
      {!! $talent->bio !!}
     </div>

     <div class="mt-auto space-y-4">
      <a href="/book?talent={{ $talent->id }}"
       class="w-full flex items-center justify-center px-8 py-5 bg-brand-primary text-white font-bold rounded-2xl hover:bg-brand-primary transition-all shadow-xl shadow-brand-primary/20 text-lg">
       Request Availability
      </a>
      <p class="text-center text-xs text-text-muted">
       Availability is not guaranteed until a contract is signed.
      </p>
     </div>
    </div>
   </div>
  </div>
 </section>

 <!-- Technical & Requirements -->
 <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
   <div>
    <h2
     class="text-2xl font-black text-text-primary mb-8 border-b border-subtle pb-4 flex items-center gap-3">
     <x-heroicon-o-wrench-screwdriver class="w-6 h-6 text-brand-primary" />
     Technical Rider
    </h2>
    <div class="bg-surface-muted rounded-3xl p-8 border border-subtle">
     @if($talent->technical_rider)
      <div class="prose prose-slate prose-sm max-w-none">
       {!! $talent->technical_rider !!}
      </div>
     @else
      <p class="text-text-muted italic text-sm">No specific technical requirements listed. Please contact
       the agency for more details.</p>
     @endif
    </div>
   </div>

   <div>
    <h2
     class="text-2xl font-black text-text-primary mb-8 border-b border-subtle pb-4 flex items-center gap-3">
     <x-heroicon-o-information-circle class="w-6 h-6 text-brand-primary" />
     Booking Information
    </h2>
    <dl class="space-y-6">
     <div class="bg-white border border-subtle rounded-2xl p-6 shadow-sm">
      <dt class="text-xs font-bold text-text-muted uppercase tracking-widest mb-1">Pricing Model</dt>
      <dd class="text-text-primary font-semibold">Base fee starts at
       ${{ number_format($talent->starting_price, 0) }}. Travel and accommodation expenses are
       calculated separately depending on the event location.</dd>
     </div>
     <div class="bg-white border border-subtle rounded-2xl p-6 shadow-sm">
      <dt class="text-xs font-bold text-text-muted uppercase tracking-widest mb-1">Travel Policy</dt>
      <dd class="text-text-primary font-semibold">Available for travel worldwide. Travel within
       {{ $talent->location }} is included in the base fee.</dd>
     </div>
    </dl>
   </div>
  </div>
 </section>
</div>