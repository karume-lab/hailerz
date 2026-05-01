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
       <div>
        <label for="talent_id" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Requested Talent / Act</label>
        <select id="talent_id" wire:model="talent_id" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-text-muted rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium transition-all appearance-none">
         <option value="">-- Select from Roster --</option>
         @foreach($talents as $t)
          <option value="{{ $t->id }}">{{ $t->name }}</option>
         @endforeach
        </select>
        @error('talent_id') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
