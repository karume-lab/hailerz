<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
 <div class="flex flex-col md:flex-row gap-8">
  <!-- Sidebar Filters -->
  <aside class="w-full md:w-64 shrink-0">
   <div class="sticky top-24 space-y-8">
    <div>
     <h3 class="text-sm font-bold uppercase tracking-widest text-text-primary mb-6">Filters</h3>
     
     <div class="space-y-6">
      <!-- Search -->
      <div>
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter mb-2">Search Name</label>
       <div class="relative">
        <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-text-muted" />
        <input 
         wire:model.live.debounce.300ms="search" 
         type="text" 
         placeholder="e.g. DJ Horizon"
         class="w-full pl-9 pr-4 py-2 bg-white border border-subtle rounded-xl text-sm focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all"
        >
       </div>
      </div>

      <!-- Category -->
      <div>
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter mb-2">Category</label>
       <select 
        wire:model.live="categoryId"
        class="w-full px-4 py-2 bg-white border border-subtle rounded-xl text-sm focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all"
       >
        <option value="">All Categories</option>
        @foreach($categories as $category)
         <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
       </select>
      </div>

      <!-- Location -->
      <div>
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter mb-2">Location</label>
       <input 
        wire:model.live.debounce.300ms="location" 
        type="text" 
        placeholder="e.g. New York"
        class="w-full px-4 py-2 bg-white border border-subtle rounded-xl text-sm focus:ring-2 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all"
       >
      </div>
     </div>
    </div>
    
    <div class="pt-8 border-t border-subtle italic text-xs text-text-muted">
     Showing {{ $talents->total() }} available artists.
    </div>
   </div>
  </aside>

  <!-- Talent Grid -->
  <div class="grow">
   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    @forelse($talents as $talent)
     <div class="bg-white rounded-3xl overflow-hidden border border-subtle shadow-sm hover:shadow-md transition-all group">
      <div class="relative h-64 overflow-hidden">
       <img 
        src="{{ $talent->getFirstMediaUrl('primary_image') ?: 'https://images.unsplash.com/photo-1514525253361-bee8a187499b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
        alt="{{ $talent->name }}"
        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
       >
       @if($talent->is_featured)
        <div class="absolute top-4 right-4 bg-surface-dark text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
         Featured
        </div>
       @endif
      </div>
      
      <div class="p-6">
       <h3 class="font-bold text-text-primary mb-1">{{ $talent->name }}</h3>
       <p class="text-xs text-text-muted mb-4">{{ $talent->location }} • {{ $talent->category?->name }}</p>
       
       <div class="flex justify-between items-center pt-4 border-t border-subtle">
        <span class="text-sm font-bold text-text-primary">${{ number_format($talent->starting_price, 0) }}+</span>
        <x-button variant="outline" size="sm" href="/talent/{{ $talent->slug }}" wire:navigate>
         View Profile
        </x-button>
       </div>
      </div>
     </div>
    @empty
     <div class="col-span-full py-32 text-center bg-white rounded-3xl border border-dashed border-subtle">
      <x-heroicon-o-magnifying-glass class="w-12 h-12 text-text-muted mx-auto mb-4" />
      <h3 class="text-text-primary font-bold mb-1">No talent found</h3>
      <p class="text-text-muted text-sm">Try adjusting your filters to find who you're looking for.</p>
     </div>
    @endforelse
   </div>

   <div class="mt-8">
    {{ $talents->links() }}
   </div>
  </div>
 </div>
</div>
