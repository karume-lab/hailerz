<div class="bg-surface-muted min-h-screen py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($isSubmitted)
            <div class="bg-surface-light rounded-[2.5rem] p-16 text-center shadow-2xl border border-subtle mt-12">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
                    <svg class="h-12 w-12 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-4xl font-bold text-text-primary mb-6 font-serif">Application Received!</h2>
                <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
                    We've sent a confirmation email to your inbox with a PDF summary of your application. Our A&R team will review your portfolio and reach out if your act is a fit for our exclusive network.
                </p>
                <x-button variant="primary" size="lg" href="/" wire:navigate>
                    Return to the Agency
                </x-button>
            </div>
        @else
            <div class="text-center mb-16">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="h-px w-8 bg-brand-primary"></span>
                    <span class="text-xs font-bold text-brand-primary uppercase tracking-widest">Join Talent</span>
                    <span class="h-px w-8 bg-brand-primary"></span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-text-primary tracking-tight font-serif">Join <span class="text-brand-secondary">Hailerz</span></h1>
                <p class="mt-4 text-lg text-text-secondary">Apply for inclusion in our exclusive talent network.</p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-16 max-w-3xl mx-auto">
                <div class="relative">
                    <div class="overflow-hidden h-1.5 mb-6 text-xs flex rounded-full bg-subtle">
                        <div style="width: {{ ($currentStep / 5) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-text-inverse justify-center bg-brand-primary transition-all duration-700"></div>
                    </div>
                    <div class="grid grid-cols-5 text-[9px] font-bold text-text-muted uppercase tracking-[0.15em]">
                        <span class="{{ $currentStep >= 1 ? 'text-brand-primary' : '' }} text-left">Artist Info</span>
                        <span class="{{ $currentStep >= 2 ? 'text-brand-primary' : '' }} text-center">Professional</span>
                        <span class="{{ $currentStep >= 3 ? 'text-brand-primary' : '' }} text-center">Presence</span>
                        <span class="{{ $currentStep >= 4 ? 'text-brand-primary' : '' }} text-center">Experience</span>
                        <span class="{{ $currentStep >= 5 ? 'text-brand-primary' : '' }} text-right">Misc</span>
                    </div>
                </div>
            </div>

            <div class="w-full bg-surface-light p-10 sm:p-16 rounded-[2.5rem] shadow-2xl border border-subtle">
                <form wire:submit.prevent="submit">
                    <!-- Step 1: Artist Information -->
                    <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Artist Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="artist_name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Artist/Stage Name <span class="text-red-500">*</span></label>
                                <input type="text" id="artist_name" wire:model="artist_name" autocomplete="nickname" aria-required="true" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('artist_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="real_name" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Real Name <span class="text-red-500">*</span></label>
                                <input type="text" id="real_name" wire:model="real_name" autocomplete="name" aria-required="true" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('real_name') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" id="email" wire:model="email" autocomplete="email" aria-required="true" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('email') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Phone Number <span class="text-red-500">*</span></label>
                                <input type="text" id="phone" wire:model="phone" autocomplete="tel" aria-required="true" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('phone') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="location" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Location (City, State) <span class="text-red-500">*</span></label>
                                <input type="text" id="location" wire:model="location" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('location') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="profile_photo_url" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Profile Photo URL <span class="text-red-500">*</span></label>
                                <input type="text" id="profile_photo_url" wire:model="profile_photo_url" placeholder="https://..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                <p class="text-[10px] text-text-muted mt-2 italic">A high-quality link to your professional headshot.</p>
                                @error('profile_photo_url') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Professional Details -->
                    <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Professional Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="category" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Talent Category <span class="text-red-500">*</span></label>
                                <select id="category" wire:model="category" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                    <option value="">-- Select Category --</option>
                                    <option value="Musicians">Musicians</option>
                                    <option value="Speakers">Speakers</option>
                                    <option value="DJs">DJs</option>
                                    <option value="Comedians">Comedians</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('category') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="genre" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Primary Genre/Style</label>
                                <input type="text" id="genre" wire:model="genre" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('genre') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="years_active" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Years Active <span class="text-red-500">*</span></label>
                                <input type="text" id="years_active" wire:model="years_active" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('years_active') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="min_rate" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Min Rate (₦) <span class="text-red-500">*</span></label>
                                    <input type="number" id="min_rate" wire:model="min_rate" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                    <p class="text-[10px] text-text-muted mt-2 italic">Standard min/max booking fee range.</p>
                                    @error('min_rate') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="max_rate" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Max Rate (₦) <span class="text-red-500">*</span></label>
                                    <input type="number" id="max_rate" wire:model="max_rate" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                    @error('max_rate') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Online Presence -->
                    <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Online Presence</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="website_url" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Website Link</label>
                                <input type="url" id="website_url" wire:model="website_url" placeholder="https://..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('website_url') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="instagram_handle" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Instagram Link</label>
                                <input type="url" id="instagram_handle" wire:model="instagram_handle" placeholder="https://instagram.com/..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('instagram_handle') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="facebook_url" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Facebook Page Link</label>
                                <input type="url" id="facebook_url" wire:model="facebook_url" placeholder="https://..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('facebook_url') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="youtube_channel" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">YouTube Channel Link</label>
                                <input type="url" id="youtube_channel" wire:model="youtube_channel" placeholder="https://..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('youtube_channel') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="tiktok_handle" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">TikTok Link</label>
                                <input type="url" id="tiktok_handle" wire:model="tiktok_handle" placeholder="https://tiktok.com/@..." class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium">
                                @error('tiktok_handle') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Experience & Gallery -->
                    <div class="{{ $currentStep != 4 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Experience & Portfolio</h3>
                        <div class="grid grid-cols-1 gap-8">
                            <div>
                                <label for="notable_venues" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Notable Venues Performed</label>
                                <textarea id="notable_venues" wire:model="notable_venues" rows="3" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium resize-none"></textarea>
                            </div>
                            <div>
                                <label for="notable_clients" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Notable Events/Clients</label>
                                <textarea id="notable_clients" wire:model="notable_clients" rows="3" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium resize-none"></textarea>
                            </div>
                            <div>
                                <label for="press_features" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Press Features/Awards</label>
                                <textarea id="press_features" wire:model="press_features" rows="3" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium resize-none"></textarea>
                            </div>
                        </div>

                        <!-- Gallery (PRESERVED) -->
                        <div class="pt-10 border-t border-subtle">
                            <div class="flex items-center justify-between mb-8">
                                <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest">Media Gallery</h4>
                                <button type="button" wire:click="addGalleryItem" class="px-5 py-2.5 bg-brand-primary/10 text-brand-primary text-xs font-bold uppercase tracking-widest rounded-full flex items-center gap-2 hover:bg-brand-primary hover:text-text-inverse transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Add Media
                                </button>
                            </div>

                            <div class="space-y-6">
                                @foreach($gallery as $index => $item)
                                    <div class="bg-surface-muted p-8 rounded-3xl border border-subtle relative group">
                                        <button type="button" wire:click="removeGalleryItem({{ $index }})" class="absolute top-6 right-6 text-text-muted hover:text-red-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <label class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-3">Media URL <span class="text-red-500">*</span></label>
                                                <input type="text" wire:model="gallery.{{ $index }}.url" class="block w-full px-5 py-3.5 bg-surface-light border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-sm font-medium" placeholder="https://...">
                                                <p class="text-[10px] text-text-muted mt-2 italic">Links to YouTube, SoundCloud, or portfolio images.</p>
                                                @error('gallery.'.$index.'.url') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <label class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-3">Title</label>
                                                    <input type="text" wire:model="gallery.{{ $index }}.title" class="block w-full px-5 py-3.5 bg-surface-light border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-sm font-medium">
                                                </div>
                                                <div>
                                                    <label class="block text-[10px] font-bold text-text-secondary uppercase tracking-widest mb-3">Description</label>
                                                    <input type="text" wire:model="gallery.{{ $index }}.description" class="block w-full px-5 py-3.5 bg-surface-light border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-sm font-medium">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Additional Info -->
                    <div class="{{ $currentStep != 5 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Additional Information</h3>
                        <div class="space-y-8">
                            <div>
                                <label for="bio" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Artist Bio (Min 200 Characters) <span class="text-red-500">*</span></label>
                                <textarea id="bio" wire:model="bio" rows="6" class="block w-full px-6 py-5 bg-surface-muted border border-subtle rounded-2xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium resize-none"></textarea>
                                <p class="text-[10px] text-text-muted mt-2 italic">A compelling professional summary for your public profile.</p>
                                @error('bio') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="motivation" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">Why do you want to join Hailerz? <span class="text-red-500">*</span></label>
                                <textarea id="motivation" wire:model="motivation" rows="4" class="block w-full px-6 py-5 bg-surface-muted border border-subtle rounded-2xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium resize-none"></textarea>
                                @error('motivation') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="source" class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-3">How did you hear about us?</label>
                                <select id="source" wire:model="source" class="block w-full px-6 py-4 bg-surface-muted border border-subtle rounded-xl focus:ring-2 focus:ring-brand-primary outline-none text-text-primary font-medium transition-all">
                                    <option value="">-- Select Option --</option>
                                    <option value="Search Engine">Search Engine</option>
                                    <option value="Social Media">Social Media</option>
                                    <option value="Word of Mouth">Word of Mouth</option>
                                    <option value="Advertisement">Advertisement</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex items-center justify-between mt-16 pt-10 border-t border-subtle">
                        @if($currentStep > 1)
                            <x-button type="button" variant="ghost" wire:click="previousStep">
                                Back
                            </x-button>
                        @else
                            <div></div>
                        @endif

                        @if($currentStep < 5)
                            <x-button type="button" variant="primary" size="lg" wire:click="nextStep">
                                Continue
                            </x-button>
                        @else
                            <x-button variant="navy" size="lg" type="submit" wire:loading.attr="disabled" wire:target="submit">
                                <span wire:loading.remove wire:target="submit">Submit Talent Application</span>
                                <span wire:loading wire:target="submit" class="flex items-center justify-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </x-button>
                        @endif
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
