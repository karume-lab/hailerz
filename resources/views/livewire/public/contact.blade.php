<div class="bg-surface-muted min-h-screen py-32">
 <div class="mx-auto max-w-7xl px-6 lg:px-8">
  <div class="mx-auto max-w-2xl space-y-16 lg:mx-0 lg:max-w-none">
   <div class="grid grid-cols-1 gap-x-12 gap-y-10 lg:grid-cols-3">
    <div>
     <div class="flex items-center gap-3 mb-6">
      <span class="h-px w-8 bg-brand-primary"></span>
      <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Connect</span>
     </div>
     <h2 class="text-4xl font-bold tracking-tight text-text-primary font-serif">Get in Touch</h2>
     <p class="mt-6 text-lg leading-relaxed text-text-secondary font-light">
      Whether you're looking to secure talent for an upcoming event or discuss agency representation, our team of dedicated agents is here to assist.
     </p>
    </div>
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:col-span-2">
     <div class="rounded-3xl bg-surface-light p-10 border border-subtle shadow-sm">
      <h3 class="text-xs font-bold text-brand-primary uppercase tracking-[0.2em] mb-4">Headquarters</h3>
      <address class="not-italic text-sm text-text-secondary leading-relaxed">
       Westlands Business District<br>
       Nairobi, Kenya
      </address>
     </div>
     <div class="rounded-3xl bg-surface-light p-10 border border-subtle shadow-sm">
      <h3 class="text-xs font-bold text-brand-primary uppercase tracking-[0.2em] mb-4">Direct Inquiry</h3>
      <p class="text-sm text-text-secondary mb-2">General: <a class="font-bold text-brand-primary hover:underline transition-colors" href="mailto:info@hailerz.com">info@hailerz.com</a></p>
      <p class="text-sm text-text-secondary">Bookings: <a class="font-bold text-brand-primary hover:underline transition-colors" href="mailto:bookings@hailerz.com">bookings@hailerz.com</a></p>
     </div>
    </div>
   </div>

   <div class="pt-16 lg:grid lg:grid-cols-3 lg:gap-12 border-t border-subtle ">
    <div>
     <h2 class="text-2xl font-bold tracking-tight text-text-primary font-serif mb-4">Agency Correspondence</h2>
     <p class="text-sm text-text-secondary font-light leading-relaxed">
      Complete the form below for general inquiries. For specific talent requests, we recommend using our <a href="/book" class="text-brand-primary font-bold hover:underline">Booking Wizard</a> for expedited processing.
     </p>
    </div>
    <div class="lg:col-span-2">
     @if (session('success'))
      <div class="rounded-2xl bg-green-50 p-6 mb-8 border border-green-100 flex items-center gap-4">
       <div class="shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
       </div>
       <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
      </div>
     @endif

     <form wire:submit="submit" class="grid grid-cols-1 gap-y-8 sm:grid-cols-2 sm:gap-x-8">
      <div>
       <label for="name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Full Name</label>
       <input wire:model="name" type="text" id="name" placeholder="Name or Organization" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary dark:text-white text-sm font-medium transition-all">
       @error('name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
      </div>
      <div>
       <label for="email" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Professional Email</label>
       <input wire:model="email" type="email" id="email" placeholder="email@company.com" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary dark:text-white text-sm font-medium transition-all">
       @error('email') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
      </div>
      <div class="sm:col-span-2">
       <label for="subject" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Inquiry Subject</label>
       <input wire:model="subject" type="text" id="subject" class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary dark:text-white text-sm font-medium transition-all">
       @error('subject') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
      </div>
      <div class="sm:col-span-2">
       <label for="message" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Message</label>
       <textarea wire:model="message" id="message" rows="5" placeholder="Detail your inquiry or project requirements..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-transparent outline-none text-text-primary dark:text-white text-sm font-medium transition-all resize-none"></textarea>
       @error('message') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
      </div>
      <div class="sm:col-span-2 flex justify-end">
       <x-button type="submit" size="lg">
        Send Correspondence
       </x-button>
      </div>
     </form>
    </div>
   </div>
  </div>
 </div>
</div>
