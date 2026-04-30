<div class="bg-surface-muted min-h-screen py-24">
 <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
  
  @if($isSubmitted)
   <div class="bg-surface-light rounded-[2.5rem] p-16 text-center shadow-2xl border border-subtle mt-12">
    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
     <svg class="h-12 w-12 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </div>
    <h2 class="text-4xl font-bold text-text-primary mb-6 font-serif">Application Received</h2>
    <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
     Our A&R and talent procurement team will review your portfolio. We prioritize performers who align with our premium corporate and private event standards. If your act is a fit, an agent will reach out to discuss representation.
    </p>
    <x-button variant="primary" size="lg" href="/" wire:navigate>
     Return to the Agency
    </x-button>
   </div>
  @else
   <div class="text-center mb-16">
    <div class="flex items-center justify-center gap-3 mb-4">
     <span class="h-px w-8 bg-brand-primary"></span>
     <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Agency Representation</span>
     <span class="h-px w-8 bg-brand-primary"></span>
    </div>
    <h1 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight font-serif">Join the Roster</h1>
    <p class="mt-4 text-lg text-text-secondary">Apply for inclusion in our exclusive talent network serving high-profile global clients.</p>
   </div>

   <!-- Progress Indicator -->
   <div class="mb-16 max-w-2xl mx-auto">
    <div class="relative">
     <div class="overflow-hidden h-1.5 mb-6 text-xs flex rounded-full bg-subtle">
      <div style="width: {{ ($currentStep / 3) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-text-inverse justify-center bg-brand-primary transition-all duration-700"></div>
     </div>
     <div class="grid grid-cols-3 text-[10px] font-bold text-text-muted uppercase tracking-[0.2em]">
      <span class="{{ $currentStep >= 1 ? 'text-brand-primary' : '' }} text-left">Professional Identity</span>
      <span class="{{ $currentStep >= 2 ? 'text-brand-primary' : '' }} text-center">Portfolio & Assets</span>
      <span class="{{ $currentStep >= 3 ? 'text-brand-primary' : '' }} text-right">Engagement Details</span>
     </div>
    </div>
   </div>

   <div class="w-full bg-surface-light p-10 sm:p-16 rounded-[2.5rem] shadow-2xl border border-subtle ">
    <form wire:submit.prevent="submit">
     
     <!-- Step 1: Identity -->
     <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
      <h3 class="text-2xl font-bold text-text-primary font-serif">Professional Identity</h3>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
       <div>
        <label for="artist_name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Stage / Act Name</label>
        <input type="text" id="artist_name" wire:model="artist_name" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. The Nairobi Symphony">
        @error('artist_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="email" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Professional Email</label>
        <input type="email" id="email" wire:model="email" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="bookings@example.com">
        @error('email') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="phone" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Direct Contact</label>
        <input type="tel" id="phone" wire:model="phone" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="+254...">
        @error('phone') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="location" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Primary Base (City)</label>
        <input type="text" id="location" wire:model="location" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. Nairobi, Kenya">
        @error('location') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="category" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Primary Discipline</label>
        <input type="text" id="category" wire:model="category" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. Keynote Speaker, Live Band">
        @error('category') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="genre" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Style / Genre</label>
        <input type="text" id="genre" wire:model="genre" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. Contemporary Jazz">
        @error('genre') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>
      </div>
     </div>

     <!-- Step 2: Portfolio -->
     <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
      <h3 class="text-2xl font-bold text-text-primary font-serif">Portfolio & Assets</h3>
      
      <div class="space-y-8">
       <div>
        <label for="epk_link" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Electronic Press Kit (EPK) or Portfolio Link</label>
        <input type="url" id="epk_link" wire:model="epk_link" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="https://talent.com/portfolio">
        <p class="text-xs text-text-muted mt-3">EPKs must contain professional performance reels, high-resolution branding assets, and technical riders.</p>
        @error('epk_link') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>
 
       <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
         <label for="instagram_url" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Instagram (Professional)</label>
         <input type="url" id="instagram_url" wire:model="instagram_url" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium">
        </div>
        
        <div>
         <label for="youtube_url" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Performance Channel (YouTube/Vimeo)</label>
         <input type="url" id="youtube_url" wire:model="youtube_url" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium">
        </div>
       </div>

       <div class="pt-8 border-t border-subtle ">
        <div class="flex items-center justify-between mb-6">
         <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest">Media Gallery Links</h4>
         <button type="button" wire:click="addGalleryItem" class="text-brand-primary text-[10px] font-bold uppercase tracking-widest flex items-center gap-2 hover:text-brand-primary/80 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
          Add Media Link
         </button>
        </div>

        <div class="space-y-6">
         @foreach($gallery as $index => $item)
          <div class="bg-surface-muted /50 p-6 rounded-2xl border border-subtle relative group">
           <button type="button" wire:click="removeGalleryItem({{ $index }})" class="absolute top-4 right-4 text-text-muted hover:text-red-500 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
           </button>

           <div class="grid grid-cols-1 gap-6">
            <div>
             <label class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-2">Media URL (Image, YouTube, or Vimeo)</label>
             <input type="url" wire:model="gallery.{{ $index }}.url" class="block w-full px-4 py-3 bg-surface-muted border border-subtle rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-sm font-medium" placeholder="https://...">
             @error('gallery.'.$index.'.url') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
             <div>
              <label class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-2">Title</label>
              <input type="text" wire:model="gallery.{{ $index }}.title" class="block w-full px-4 py-3 bg-surface-muted border border-subtle rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-sm font-medium" placeholder="Performance at...">
             </div>
             <div>
              <label class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-2">Short Description</label>
              <input type="text" wire:model="gallery.{{ $index }}.description" class="block w-full px-4 py-3 bg-surface-muted border border-subtle rounded-lg focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-sm font-medium" placeholder="e.g. Live at the Grand Hall">
             </div>
            </div>
           </div>
          </div>
         @endforeach

         @if(empty($gallery))
          <div class="text-center py-10 border-2 border-dashed border-subtle rounded-2xl">
           <p class="text-xs text-text-muted font-bold uppercase tracking-widest">No gallery items added yet</p>
          </div>
         @endif
        </div>
       </div>
      </div>
     </div>

     <!-- Step 3: Engagement Details -->
     <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
      <h3 class="text-2xl font-bold text-text-primary font-serif">Engagement Details</h3>
      
      <div class="space-y-8">
       <div>
        <label for="bio" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Executive Summary / Career Highlights</label>
        <textarea id="bio" wire:model="bio" rows="4" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium resize-none" placeholder="Detail your experience with corporate clients, notable venues, and performance scale..."></textarea>
        @error('bio') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>
 
       <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
         <label for="years_experience" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Years of Professional Performance</label>
         <input type="number" id="years_experience" wire:model="years_experience" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium">
         @error('years_experience') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
 
        <div>
         <label for="minimum_fee" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Minimum Performance Fee (USD)</label>
         <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
           <span class="text-brand-primary font-bold">$</span>
          </div>
          <input type="number" id="minimum_fee" wire:model="minimum_fee" class="block w-full pl-12 pr-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-lg font-bold text-text-primary" placeholder="1000">
         </div>
         @error('minimum_fee') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
       </div>

       <div class="bg-surface-muted p-8 rounded-2xl border border-subtle ">
        <div class="flex items-start gap-5">
         <div class="flex items-center h-6">
          <input id="has_management" wire:model="has_management" type="checkbox" class="w-5 h-5 text-brand-primary border-subtle rounded focus:ring-brand-primary">
         </div>
         <label for="has_management" class="cursor-pointer">
          <span class="block text-sm font-bold text-text-primary uppercase tracking-widest">Exclusive Representation</span>
          <span class="block text-xs text-text-secondary mt-1">Check this if you are currently represented by an exclusive booking agency or management firm.</span>
         </label>
        </div>
        
        @if($has_management)
         <div class="mt-8">
          <label for="management_contact" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Management Contact Details</label>
          <input type="text" id="management_contact" wire:model="management_contact" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="Agency Name / Contact Person / Email">
          @error('management_contact') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
         </div>
        @endif
       </div>
      </div>
     </div>

     <!-- Navigation -->
     <div class="flex items-center justify-between mt-16 pt-10 border-t border-subtle ">
      @if($currentStep > 1)
       <x-button variant="ghost" wire:click="previousStep">
        Back
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
        Submit Roster Application
       </x-button>
      @endif
     </div>
    </form>
   </div>
  @endif
 </div>
</div>
