<div class="bg-surface-muted min-h-screen py-32">
 <div class="mx-auto max-w-7xl px-6 lg:px-8">
  <div class="mx-auto max-w-2xl space-y-16 lg:mx-0 lg:max-w-none">
   <div class="grid grid-cols-1 gap-x-12 gap-y-10 lg:grid-cols-3">
    <div>
     <x-section-heading 
        subtitle="Connect" 
        title='Ready to <span class="text-brand-secondary">Work Together?</span>' 
        class="mb-6"
      />
     <p class="mt-6 text-lg leading-relaxed text-text-secondary font-light">
      Whether you're looking to book top-tier talent for an upcoming event or discuss agency representation, our team is here to assist you.
     </p>
    </div>
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:col-span-2">
      <x-card padding="p-10">
       <h3 class="text-xs font-bold text-brand-primary uppercase tracking-[0.2em] mb-4">Headquarters</h3>
       <address class="not-italic text-sm text-text-secondary leading-relaxed">
        Westlands Business District<br>
        Nairobi, Kenya
       </address>
      </x-card>
      <x-card padding="p-10">
       <h3 class="text-xs font-bold text-brand-primary uppercase tracking-[0.2em] mb-4">Direct Inquiry</h3>
       <p class="text-sm text-text-secondary mb-2">General: <a class="font-bold text-brand-primary hover:underline transition-colors" href="mailto:info@hailerz.com">info@hailerz.com</a></p>
       <p class="text-sm text-text-secondary">Bookings: <a class="font-bold text-brand-primary hover:underline transition-colors" href="mailto:bookings@hailerz.com">bookings@hailerz.com</a></p>
      </x-card>
    </div>
   </div>

   <div class="pt-16 lg:grid lg:grid-cols-3 lg:gap-12 border-t border-subtle ">
    <div>
     <h2 class="text-2xl font-bold tracking-tight text-text-primary  mb-4">Direct <span class="text-brand-secondary">Inquiries</span></h2>
     <p class="text-sm text-text-secondary font-light leading-relaxed">
      Reach out and we'll respond promptly to your request. For urgent booking needs, we recommend using our <a href="/book" class="text-brand-primary font-bold hover:underline">expedited request process</a>.
     </p>
    </div>
    <div class="lg:col-span-2">
     @if (session('success'))
      <div class="rounded-2xl bg-green-50 p-6 mb-8 border border-green-100 flex items-center gap-4">
       <div class="shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
        <x-lucide-check class="h-6 w-6" stroke-width="2" />
       </div>
       <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
      </div>
     @endif

     <form wire:submit="submit" class="grid grid-cols-1 gap-y-8 sm:grid-cols-2 sm:gap-x-8">
       <x-input wire:model="name" name="name" label="Full Name" placeholder="Name or Organization" />
       <x-input wire:model="email" name="email" type="email" label="Professional Email" placeholder="email@company.com" />
       <x-input wire:model="subject" name="subject" label="Inquiry Subject" class="sm:col-span-2" />
       <x-textarea wire:model="message" name="message" label="Message" rows="5" placeholder="Tell us about your event vision and the talent you're interested in..." class="sm:col-span-2" />
      <div class="sm:col-span-2 flex justify-end">
       <x-button type="submit" size="lg">
        Send Message
       </x-button>
      </div>
     </form>
    </div>
   </div>
  </div>
 </div>
</div>
