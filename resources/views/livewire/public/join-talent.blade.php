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
    <h1 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight font-serif">Join Talent</h1>
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
      <div class="flex items-center gap-4 mb-2">
       <div class="h-10 w-10 rounded-xl bg-brand-primary/10 flex items-center justify-center text-brand-primary">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
       </div>
       <h3 class="text-2xl font-bold text-text-primary font-serif">Professional Identity</h3>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
       <div>
        <label for="artist_name" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Stage / Act Name</label>
        <input type="text" id="artist_name" wire:model="artist_name" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. The Nairobi Symphony">
        <p class="text-xs text-text-muted mt-2">This is the name that will be displayed on your public profile.</p>
        @error('artist_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="email" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Professional Email</label>
        <input type="email" id="email" wire:model="email" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="bookings@example.com">
        <p class="text-xs text-text-muted mt-2">We will use this for all booking inquiries and official communication.</p>
        @error('email') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="phone" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Direct Contact</label>
        <input type="tel" id="phone" wire:model="phone" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="+254...">
        <p class="text-xs text-text-muted mt-2">A mobile number where we can reach you or your manager directly.</p>
        @error('phone') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="location" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Primary Base (City)</label>
        <input type="text" id="location" wire:model="location" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. Nairobi, Kenya">
        <p class="text-xs text-text-muted mt-2">Used to calculate travel logistics and local booking availability.</p>
        @error('location') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div>
        <label for="category" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Professional Category</label>
        <select id="category" wire:model.live="category" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium">
         <option value="">Select a category...</option>
         @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
          <option value="{{ $cat->name }}">{{ $cat->name }}</option>
         @endforeach
         <option value="Other">Other (Please specify)</option>
        </select>
        <p class="text-xs text-text-muted mt-2">Select the category that best describes your main performance act.</p>
        @error('category') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       @if($category === 'Other')
        <div class="md:col-span-2">
         <label for="other_category" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Please Specify Category</label>
         <input type="text" id="other_category" wire:model="other_category" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. Aerial Acrobat, Virtual Reality Artist">
         @error('other_category') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
       @endif

       <div>
        <label for="genre" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Style / Genre</label>
        <input type="text" id="genre" wire:model="genre" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="e.g. Contemporary Jazz">
        <p class="text-xs text-text-muted mt-2">Specify your artistic style (e.g., Acoustic, High-Energy, Corporate, etc.).</p>
        @error('genre') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>
      </div>
     </div>

     <!-- Step 2: Portfolio -->
     <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-12">
      <div class="flex items-center gap-4 mb-2">
       <div class="h-10 w-10 rounded-xl bg-brand-primary/10 flex items-center justify-center text-brand-primary">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
       </div>
       <h3 class="text-2xl font-bold text-text-primary font-serif">Portfolio & Assets</h3>
      </div>
      
      <div class="space-y-10">
       <div class="bg-surface-muted/50 p-8 rounded-3xl border border-subtle">
        <label for="epk_link" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-4">Electronic Press Kit (EPK) or Portfolio Link</label>
        <input type="url" id="epk_link" wire:model="epk_link" class="block w-full px-6 py-5 bg-surface-muted border border-subtle rounded-2xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="https://talent.com/portfolio">
        <p class="text-sm text-text-muted mt-4 italic leading-relaxed">EPKs are mandatory for our review process. They must contain professional performance reels, high-resolution branding assets, and technical riders. We use this to evaluate your act for high-end corporate clients.</p>
        @error('epk_link') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
         <label for="instagram_url" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Instagram (Professional)</label>
         <input type="url" id="instagram_url" wire:model="instagram_url" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium">
         <p class="text-xs text-text-muted mt-2">Help us see your current brand engagement and aesthetic.</p>
        </div>
        
        <div>
         <label for="youtube_url" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Performance Channel (YouTube/Vimeo)</label>
         <input type="url" id="youtube_url" wire:model="youtube_url" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium">
         <p class="text-xs text-text-muted mt-2">Direct links to your live performances and high-quality video content.</p>
        </div>
       </div>

       <div class="pt-10 border-t border-subtle">
        <div class="flex items-center justify-between mb-8">
         <div>
          <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest mb-1">Media Gallery Links</h4>
          <p class="text-xs text-text-muted">Showcase specific highlights of your work.</p>
         </div>
         <button type="button" wire:click="addGalleryItem" class="px-5 py-2.5 bg-brand-primary/10 text-brand-primary text-xs font-bold uppercase tracking-widest rounded-full flex items-center gap-2 hover:bg-brand-primary hover:text-text-inverse transition-all">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
          Add Media
         </button>
        </div>

        <div class="space-y-6">
         @foreach($gallery as $index => $item)
          <div class="bg-surface-muted p-8 rounded-3xl border border-subtle relative group animate-fadeIn">
           <button type="button" wire:click="removeGalleryItem({{ $index }})" class="absolute top-6 right-6 text-text-muted hover:text-red-500 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
           </button>

           <div class="grid grid-cols-1 gap-8">
            <div>
             <label class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Media URL (Image, YouTube, or Vimeo)</label>
             <input type="url" wire:model="gallery.{{ $index }}.url" class="block w-full px-5 py-3.5 bg-surface-light border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-sm font-medium" placeholder="https://...">
             @error('gallery.'.$index.'.url') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             <div>
              <label class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Title</label>
              <input type="text" wire:model="gallery.{{ $index }}.title" class="block w-full px-5 py-3.5 bg-surface-light border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-sm font-medium" placeholder="Performance at...">
             </div>
             <div>
              <label class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Short Description</label>
              <input type="text" wire:model="gallery.{{ $index }}.description" class="block w-full px-5 py-3.5 bg-surface-light border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-sm font-medium" placeholder="e.g. Live at the Grand Hall">
             </div>
            </div>
           </div>
          </div>
         @endforeach

         @if(empty($gallery))
          <div class="text-center py-16 border-2 border-dashed border-subtle rounded-3xl">
           <svg class="w-10 h-10 text-text-muted mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
           <p class="text-xs text-text-muted font-bold uppercase tracking-widest">Showcase your best moments</p>
           <button type="button" wire:click="addGalleryItem" class="mt-4 text-brand-primary text-xs font-bold underline">Add your first media link</button>
          </div>
         @endif
        </div>
       </div>
      </div>
     </div>

     <!-- Step 3: Engagement Details -->
     <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-12">
      <div class="flex items-center gap-4 mb-2">
       <div class="h-10 w-10 rounded-xl bg-brand-primary/10 flex items-center justify-center text-brand-primary">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
       </div>
       <h3 class="text-2xl font-bold text-text-primary font-serif">Engagement Details</h3>
      </div>
      
      <div class="space-y-10">
       <div>
        <label for="bio" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Executive Summary / Career Highlights</label>
        <textarea id="bio" wire:model="bio" rows="6" class="block w-full px-6 py-5 bg-surface-muted border border-subtle rounded-2xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium resize-none leading-relaxed" placeholder="Detail your experience with corporate clients, notable venues, and performance scale..."></textarea>
        <p class="text-xs text-text-muted mt-3 leading-relaxed">Provide a professional summary of your career. Focus on major corporate events, awards, or unique value propositions that make your act stand out.</p>
        @error('bio') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
       </div>

       <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
         <label for="years_experience" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Professional Experience (Years)</label>
         <input type="number" id="years_experience" wire:model="years_experience" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary font-medium">
         <p class="text-xs text-text-muted mt-2">Total years performing at a professional level.</p>
         @error('years_experience') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>

        <div>
         <label for="minimum_fee" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Minimum Performance Fee (USD)</label>
         <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
           <span class="text-brand-primary font-bold">$</span>
          </div>
          <input type="number" id="minimum_fee" wire:model="minimum_fee" class="block w-full pl-12 pr-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-lg font-bold text-text-primary" placeholder="1000">
         </div>
         <p class="text-xs text-text-muted mt-2">Base fee for a standard corporate set.</p>
         @error('minimum_fee') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
        </div>
       </div>

       <div class="bg-brand-primary/5 p-10 rounded-[2.5rem] border border-brand-primary/10">
        <div class="flex items-start gap-6">
         <div class="flex items-center h-6">
          <input id="has_management" wire:model="has_management" type="checkbox" class="w-6 h-6 text-brand-primary border-subtle rounded-lg focus:ring-brand-primary cursor-pointer">
         </div>
         <label for="has_management" class="cursor-pointer">
          <span class="block text-base font-bold text-text-primary uppercase tracking-widest">Exclusive Representation</span>
          <span class="block text-sm text-text-secondary mt-1 leading-relaxed">Check this if you are currently represented by an exclusive booking agency or management firm. We coordinate directly with your representatives.</span>
         </label>
        </div>
        
        @if($has_management)
         <div class="mt-10 animate-fadeIn">
          <label for="management_contact" class="block text-xs font-bold text-text-muted uppercase tracking-widest mb-3">Management Contact Details</label>
          <input type="text" id="management_contact" wire:model="management_contact" class="block w-full px-6 py-4 bg-surface-light border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary placeholder-text-muted font-medium" placeholder="Agency Name / Contact Person / Email">
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
        Submit Talent Application
       </x-button>
      @endif
     </div>
    </form>
   </div>
  @endif
 </div>
</div>
