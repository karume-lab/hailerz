<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
 <div class="bg-white rounded-[3rem] shadow-2xl shadow-brand-primary/10 border border-subtle overflow-hidden">
  <!-- Progress Bar -->
  <div class="h-2 bg-surface-muted flex">
   <div 
    class="bg-brand-primary transition-all duration-500 ease-out" 
    style="width: {{ ($step / $totalSteps) * 100 }}%"
   ></div>
  </div>

  <div class="p-8 md:p-16">
   <header class="mb-12">
    <p class="text-[10px] font-black uppercase tracking-widest text-brand-primary mb-2">Step {{ $step }} of {{ $totalSteps }}</p>
    <h2 class="text-3xl font-serif font-black text-text-primary">
     @if($step === 1) Event Basics @elseif($step === 2) Logistics & Budget @else Contact Details @endif
    </h2>
    @if($selectedTalent)
     <div class="mt-4 flex items-center gap-3 p-3 bg-surface-muted rounded-2xl border border-subtle">
      <img src="{{ $selectedTalent->getFirstMediaUrl('primary_image') }}" class="w-10 h-10 rounded-full object-cover">
      <div>
       <span class="text-xs text-text-muted block font-bold uppercase tracking-tight">Booking for</span>
       <span class="text-sm font-bold text-text-primary">{{ $selectedTalent->name }}</span>
      </div>
     </div>
    @endif
   </header>

   <form wire:submit.prevent="submit" class="space-y-8">
    @if($step === 1)
     <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="space-y-2">
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter">Event Date</label>
       <input wire:model="event_date" type="date" class="w-full px-6 py-4 bg-surface-muted border border-subtle rounded-2xl focus:ring-4 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all">
       @error('event_date') <span class="text-xs text-rose-500 font-bold tracking-tight">{{ $message }}</span> @enderror
      </div>
      <div class="space-y-2">
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter">Event Type</label>
       <select wire:model="event_type" class="w-full px-6 py-4 bg-surface-muted border border-subtle rounded-2xl focus:ring-4 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all">
        <option value="">Select Type...</option>
        <option value="Corporate">Corporate Event</option>
        <option value="Wedding">Wedding</option>
        <option value="Private">Private Party</option>
        <option value="Festival">Festival / Public Event</option>
       </select>
       @error('event_type') <span class="text-xs text-rose-500 font-bold tracking-tight">{{ $message }}</span> @enderror
      </div>
     </div>
    @endif

    @if($step === 2)
     <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="space-y-2">
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter">Location / Venue</label>
       <input wire:model="location" type="text" placeholder="City or Venue Name" class="w-full px-6 py-4 bg-surface-muted border border-subtle rounded-2xl focus:ring-4 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all">
       @error('location') <span class="text-xs text-rose-500 font-bold tracking-tight">{{ $message }}</span> @enderror
      </div>
      <div class="space-y-2">
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter">Estimated Budget (USD)</label>
       <input wire:model="budget" type="number" placeholder="Optional" class="w-full px-6 py-4 bg-surface-muted border border-subtle rounded-2xl focus:ring-4 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all">
       @error('budget') <span class="text-xs text-rose-500 font-bold tracking-tight">{{ $message }}</span> @enderror
      </div>
     </div>
    @endif

    @if($step === 3)
     <div class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
       <div class="space-y-2">
        <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter">Full Name</label>
        <input wire:model="client_name" type="text" class="w-full px-6 py-4 bg-surface-muted border border-subtle rounded-2xl focus:ring-4 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all">
        @error('client_name') <span class="text-xs text-rose-500 font-bold tracking-tight">{{ $message }}</span> @enderror
       </div>
       <div class="space-y-2">
        <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter">Email Address</label>
        <input wire:model="client_email" type="email" class="w-full px-6 py-4 bg-surface-muted border border-subtle rounded-2xl focus:ring-4 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all">
        @error('client_email') <span class="text-xs text-rose-500 font-bold tracking-tight">{{ $message }}</span> @enderror
       </div>
      </div>
      <div class="space-y-2">
       <label class="block text-xs font-bold text-text-muted uppercase tracking-tighter">Anything else we should know?</label>
       <textarea wire:model="message" rows="4" class="w-full px-6 py-4 bg-surface-muted border border-subtle rounded-2xl focus:ring-4 focus:ring-brand-primary/20 focus:border-brand-primary outline-none transition-all"></textarea>
       @error('message') <span class="text-xs text-rose-500 font-bold tracking-tight">{{ $message }}</span> @enderror
      </div>
     </div>
    @endif

    <div class="pt-12 flex items-center justify-between border-t border-subtle">
     @if($step > 1)
      <button type="button" wire:click="prevStep" class="text-sm font-bold text-text-muted hover:text-text-primary transition-colors uppercase tracking-widest flex items-center gap-2">
       <x-heroicon-o-arrow-left class="w-4 h-4" /> Back
      </button>
     @else
      <div></div>
     @endif

     @if($step < $totalSteps)
      <button type="button" wire:click="nextStep" class="px-10 py-4 bg-brand-primary text-white font-bold rounded-full hover:bg-brand-primary transition-all shadow-xl shadow-brand-primary/20 flex items-center gap-2">
       Continue <x-heroicon-o-arrow-right class="w-4 h-4" />
      </button>
     @else
      <button type="submit" wire:loading.attr="disabled" class="px-10 py-4 bg-surface-dark text-white font-bold rounded-full hover:bg-surface-dark transition-all shadow-xl shadow-brand-primary/10 flex items-center gap-2 group">
       Submit Inquiry 
       <x-heroicon-o-check class="w-5 h-5 group-hover:scale-125 transition-transform" />
       <span wire:loading class="animate-spin ml-2">...</span>
      </button>
     @endif
    </div>
   </form>
  </div>
 </div>
</div>
