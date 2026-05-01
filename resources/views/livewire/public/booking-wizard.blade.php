<div class="bg-surface-muted min-h-screen py-24">
 <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
  
  @if($isComplete)
   <div class="bg-surface-light rounded-[2.5rem] p-16 text-center shadow-2xl border border-subtle ">
    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
     <svg class="h-12 w-12 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </div>
    <h2 class="text-4xl font-bold text-text-primary mb-6 font-serif">We've received your request</h2>
    <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
     One of our agents will look over your plans and get back to you within one business day. We'll send you a clear proposal with pricing and availability.
    </p>
    <x-button variant="primary" size="lg" href="/talent" wire:navigate>
     Return to Talent
    </x-button>
   </div>
  @else
   <div class="mb-16 text-center">
    <div class="flex items-center justify-center gap-3 mb-4">
     <span class="h-px w-8 bg-brand-primary"></span>
     <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Tell us about your event</span>
     <span class="h-px w-8 bg-brand-primary"></span>
    </div>
    <h1 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight font-serif">Start your booking</h1>
    <p class="mt-4 text-lg text-text-secondary">Fill in the details below so we can find the right artist for your event.</p>
   </div>

   <!-- Progress Indicator -->
   <div class="mb-16">
    <div class="relative">
     <div class="overflow-hidden h-1.5 mb-6 text-xs flex rounded-full bg-subtle">
      <div style="width: {{ ($currentStep / 3) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-text-inverse justify-center bg-brand-primary transition-all duration-700"></div>
     </div>
     <div class="grid grid-cols-3 text-[10px] font-bold text-text-muted uppercase tracking-[0.2em]">
      <span class="{{ $currentStep >= 1 ? 'text-brand-primary' : '' }} text-left">The Event</span>
      <span class="{{ $currentStep >= 2 ? 'text-brand-primary' : '' }} text-center">Budget</span>
      <span class="{{ $currentStep >= 3 ? 'text-brand-primary' : '' }} text-right">Contact</span>
     </div>
    </div>
   </div>

   <div class="bg-surface-light shadow-2xl rounded-[2.5rem] p-10 sm:p-16 border border-subtle ">
    <form wire:submit.prevent="submit">
     
     <!-- Step 1: Event Details -->
     <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
      <h3 class="text-2xl font-bold text-text-primary font-serif">Event details</h3>
      
      <div class="grid grid-cols-1 gap-8">
        <div class="relative">
         <label for="talent_id" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Requested Talent / Act</label>
         
         <div 
          x-data="{ 
           open: false, 
           selectedId: @entangle('talent_id').live,
           selectTalent(id) {
            this.selectedId = id;
            this.open = false;
           }
          }" 
          class="relative"
          @click.away="open = false"
         >
          <!-- Trigger -->
          <button 
           type="button"
           @click="open = !open"
           class="flex items-center justify-between w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all text-left"
          >
           <span>{{ $this->selectedTalent ? $this->selectedTalent->name : '-- Select from Talent --' }}</span>
           <svg class="w-5 h-5 text-text-muted transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
           </svg>
          </button>

          <!-- Dropdown Content -->
          <div 
           x-show="open"
           x-cloak
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="opacity-0 translate-y-1"
           x-transition:enter-end="opacity-100 translate-y-0"
           class="absolute z-50 w-full mt-2 bg-surface-light border border-subtle rounded-2xl shadow-2xl overflow-hidden"
          >
           <!-- Search Input -->
           <div class="p-4 border-b border-subtle">
            <input 
             wire:model.live.debounce.300ms="search"
             type="text" 
             placeholder="Search talent..." 
             class="w-full px-4 py-2 bg-surface-muted border border-subtle rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-sm"
             @keydown.escape="open = false"
            >
           </div>

           <!-- Options -->
           <div class="max-h-80 overflow-y-auto">
            @foreach($this->talents as $talent)
             <div 
              wire:key="talent-{{ $talent['id'] }}"
              @click="selectTalent({{ $talent['id'] }})"
              class="flex items-center gap-4 px-6 py-4 cursor-pointer hover:bg-brand-primary/5 transition-colors border-b border-subtle/50 last:border-0"
              :class="selectedId == {{ $talent['id'] }} ? 'bg-brand-primary/10' : ''"
             >
              <div class="w-12 h-12 rounded-lg overflow-hidden bg-brand-primary/5 shrink-0 flex items-center justify-center">
               <img src="{{ $talent['thumbnail_url'] }}" alt="{{ $talent['name'] }}" class="w-full h-full object-cover">
              </div>
              <div>
               <div class="font-bold text-text-primary">{{ $talent['name'] }}</div>
               <div class="text-xs text-text-muted">{{ $talent['category']['name'] ?? 'Talent' }}</div>
              </div>
             </div>
            @endforeach
            
            @if($this->hasMore)
             <div 
              x-data="{
               observe() {
                let observer = new IntersectionObserver((entries) => {
                 entries.forEach(entry => {
                  if (entry.isIntersecting) {
                   @this.loadMore()
                  }
                 })
                }, { threshold: 0.1 })
                observer.observe($el)
               }
              }"
              x-init="observe()"
              class="px-6 py-4 text-center"
             >
              <div class="flex items-center justify-center gap-2 text-text-muted text-xs">
               <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
               Loading more...
              </div>
             </div>
            @endif

            @if(count($this->talents) === 0)
             <div class="px-6 py-8 text-center text-text-muted">
              No talent found matching "{{ $search }}"
             </div>
            @endif
           </div>
          </div>
         </div>

         @if($this->selectedTalent)
          <div class="mt-8 p-6 bg-brand-primary/5 rounded-2xl border border-brand-primary/20 flex items-center gap-6 animate-fadeIn">
           <div class="w-24 h-24 rounded-xl overflow-hidden shadow-lg shrink-0">
             <img src="{{ $this->selectedTalent->thumbnail_url }}" alt="{{ $this->selectedTalent->name }}" class="w-full h-full object-cover">
           </div>
           <div class="flex-1">
            <div class="text-xs font-bold text-brand-primary uppercase tracking-widest mb-1">{{ $this->selectedTalent->category->name ?? 'Talent' }}</div>
            <h4 class="text-xl font-bold text-text-primary font-serif">{{ $this->selectedTalent->name }}</h4>
            <div class="flex items-center gap-4 mt-2">
             <span class="text-sm text-text-secondary">Starting from <strong class="text-text-primary">${{ number_format($this->selectedTalent->starting_price, 0) }}</strong></span>
             <a href="/talent/{{ $this->selectedTalent->id }}" target="_blank" class="text-xs font-bold text-brand-primary hover:underline flex items-center gap-1">
              View Profile
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
             </a>
            </div>
           </div>
           <button type="button" wire:click="$set('talent_id', null)" class="p-2 text-text-muted hover:text-red-500 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
           </button>
          </div>
         @endif

         @error('talent_id') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>

       <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        <div>
         <label for="event_date" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Engagement Date</label>
         <input type="date" id="event_date" wire:model="event_date" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all">
         @error('event_date') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
        <div>
         <label for="event_location" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Venue / Location</label>
         <input type="text" id="event_location" wire:model="event_location" placeholder="e.g. Nairobi National Museum" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all">
         @error('event_location') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
        <div class="md:col-span-2 xl:col-span-1">
         <label for="estimated_attendance" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Est. Attendance</label>
         <input type="number" id="estimated_attendance" wire:model="estimated_attendance" placeholder="e.g. 250" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all">
         @error('estimated_attendance') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
       </div>
       
       <div>
        <label for="event_description" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Tell us about the event</label>
        <textarea id="event_description" wire:model="event_description" rows="4" placeholder="What kind of event is it? How many people are coming? What kind of performance are you looking for?" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all resize-none"></textarea>
        @error('event_description') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>
      </div>
     </div>

     <!-- Step 2: Budget -->
     <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
      <h3 class="text-2xl font-bold text-text-primary font-serif">Budget</h3>
      
      <div class="space-y-8">
       <div>
        <label for="proposed_budget" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">What is your budget for talent? (USD)</label>
        <div class="relative">
         <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
          <span class="text-brand-primary font-bold">$</span>
         </div>
         <input type="number" id="proposed_budget" wire:model="proposed_budget" class="block w-full pl-12 pr-6 py-5 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-2xl font-bold text-text-primary" placeholder="0.00">
        </div>
        <p class="mt-4 text-xs text-text-muted leading-relaxed">
         Being clear about your budget helps us find the right options for you. Most of our artists start at $1,000.
        </p>
        @error('proposed_budget') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div class="flex items-start gap-5 p-8 rounded-2xl bg-surface-muted border border-subtle ">
        <div class="flex items-center h-6">
         <input id="budget_flexible" wire:model="budget_flexible" type="checkbox" class="w-5 h-5 text-brand-primary border-subtle rounded focus:ring-brand-primary">
        </div>
        <label for="budget_flexible" class="cursor-pointer">
         <span class="block text-sm font-bold text-text-primary uppercase tracking-widest">I'm flexible on the budget</span>
         <span class="block text-xs text-text-secondary mt-1">We're willing to pay more for the right artist if needed.</span>
        </label>
       </div>
      </div>
     </div>

     <!-- Step 3: Contact -->
     <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
      <h3 class="text-2xl font-bold text-text-primary font-serif">Your details</h3>
      
      <div class="grid grid-cols-1 gap-8">
       <div>
        <label for="client_name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Full Name / Organization</label>
        <input type="text" id="client_name" wire:model="client_name" placeholder="Contact Person or Company Name" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all">
        @error('client_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
         <label for="client_email" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Professional Email</label>
         <input type="email" id="client_email" wire:model="client_email" placeholder="email@company.com" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all">
         @error('client_email') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
        <div>
         <label for="client_phone" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Direct Phone Number</label>
         <input type="tel" id="client_phone" wire:model="client_phone" placeholder="+254..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all">
         @error('client_phone') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
       </div>
      </div>
     </div>

     <!-- Navigation -->
     <div class="flex items-center justify-between mt-16 pt-10 border-t border-subtle ">
      @if($currentStep > 1)
       <x-button variant="ghost" wire:click="previousStep">
        Previous Step
       </x-button>
      @else
       <div></div>
      @endif

      @if($currentStep < 3)
       <x-button variant="primary" size="lg" wire:click="nextStep">
        Continue
       </x-button>
      @else
       <x-button variant="navy" size="lg" type="submit">
        Send booking request
       </x-button>
      @endif
     </div>
    </form>
   </div>
  @endif
 </div>
</div>
