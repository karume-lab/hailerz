<div class="bg-surface-muted min-h-screen py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($isSubmitted)
            <x-card padding="p-16" class="text-center shadow-2xl mt-12">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
                    <x-lucide-check class="h-12 w-12 text-brand-primary" stroke-width="2" />
                </div>
                <h2 class="text-4xl font-bold text-text-primary mb-6 font-serif">Application Received!</h2>
                <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
                    We've sent a confirmation email to your inbox with a PDF summary of your application. We will review your portfolio and reach out if your act is a fit for our exclusive network.
                </p>
                <x-button variant="primary" size="lg" href="/" wire:navigate>
                    Return to the Agency
                </x-button>
            </x-card>
        @else
            <x-section-heading 
                align="center" 
                subtitle="Join the Roster" 
                title='Join the <span class="text-brand-secondary">Hailerz Roster</span>' 
                class="mb-16"
            />
            <p class="mt--12 mb-16 text-center text-lg text-text-secondary">Become part of a premier network of performers, musicians, and creatives.</p>

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

            <x-card padding="p-10 sm:p-16" class="shadow-2xl">
                <form wire:submit.prevent="submit">
                    <!-- Step 1: Artist Information -->
                    <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Artist Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <x-input wire:model="artist_name" name="artist_name" label="Artist/Stage Name *" autocomplete="nickname" />
                            <x-input wire:model="real_name" name="real_name" label="Real Name *" autocomplete="name" />
                            <x-input wire:model="email" name="email" type="email" label="Email Address *" autocomplete="email" />
                            <x-input wire:model="phone" name="phone" label="Phone Number *" autocomplete="tel" />
                            <x-input wire:model="location" name="location" label="Location (City, State) *" />
                            <x-input wire:model="profile_photo_url" name="profile_photo_url" label="Profile Photo URL *" placeholder="https://..." />
                        </div>
                    </div>

                    <!-- Step 2: Professional Details -->
                    <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Professional Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <x-select wire:model="category" name="category" label="Talent Category *">
                                <option value="">-- Select Category --</option>
                                <option value="Musicians">Musicians</option>
                                <option value="Speakers">Speakers</option>
                                <option value="DJs">DJs</option>
                                <option value="Comedians">Comedians</option>
                                <option value="Other">Other</option>
                            </x-select>
                            <x-input wire:model="genre" name="genre" label="Primary Genre/Style" />
                            <x-input wire:model="years_active" name="years_active" label="Years Active *" />
                            <div class="grid grid-cols-2 gap-4">
                                <x-input wire:model="min_rate" name="min_rate" type="number" label="Min Rate (₦) *" />
                                <x-input wire:model="max_rate" name="max_rate" type="number" label="Max Rate (₦) *" />
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Online Presence -->
                    <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Online Presence</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <x-input wire:model="website_url" name="website_url" type="url" label="Website Link" placeholder="https://..." />
                            <x-input wire:model="instagram_handle" name="instagram_handle" type="url" label="Instagram Link" placeholder="https://instagram.com/..." />
                            <x-input wire:model="facebook_url" name="facebook_url" type="url" label="Facebook Page Link" placeholder="https://..." />
                            <x-input wire:model="youtube_channel" name="youtube_channel" type="url" label="YouTube Channel Link" placeholder="https://..." />
                            <x-input wire:model="tiktok_handle" name="tiktok_handle" type="url" label="TikTok Link" placeholder="https://tiktok.com/@..." />
                        </div>
                    </div>

                    <!-- Step 4: Experience & Gallery -->
                    <div class="{{ $currentStep != 4 ? 'hidden' : 'block' }} space-y-10">
                        <h3 class="text-2xl font-bold text-text-primary font-serif">Experience & Portfolio</h3>
                        <div class="grid grid-cols-1 gap-8">
                            <x-textarea wire:model="notable_venues" name="notable_venues" label="Notable Venues Performed" rows="3" />
                            <x-textarea wire:model="notable_clients" name="notable_clients" label="Notable Events/Clients" rows="3" />
                            <x-textarea wire:model="press_features" name="press_features" label="Press Features/Awards" rows="3" />
                        </div>

                        <!-- Gallery (PRESERVED) -->
                        <div class="pt-10 border-t border-subtle">
                            <div class="flex items-center justify-between mb-8">
                                <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest">Media Gallery</h4>
                                <button type="button" wire:click="addGalleryItem" class="px-5 py-2.5 bg-brand-primary/10 text-brand-primary text-xs font-bold uppercase tracking-widest rounded-full flex items-center gap-2 hover:bg-brand-primary hover:text-text-inverse transition-all">
                                    <x-lucide-plus class="w-4 h-4" stroke-width="2" />
                                    Add Media
                                </button>
                            </div>

                            <div class="space-y-6">
                                @foreach($gallery as $index => $item)
                                    <div class="bg-surface-muted p-8 rounded-3xl border border-subtle relative group">
                                        <button type="button" wire:click="removeGalleryItem({{ $index }})" class="absolute top-6 right-6 text-text-muted hover:text-red-500 transition-colors">
                                            <x-lucide-x class="w-5 h-5" stroke-width="2" />
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
                            <x-textarea wire:model="bio" name="bio" label="Artist Bio (Min 200 Characters) *" rows="6" />
                            <x-textarea wire:model="motivation" name="motivation" label="Why do you want to join Hailerz? *" rows="4" />
                            <x-select wire:model="source" name="source" label="How did you hear about us?">
                                <option value="">-- Select Option --</option>
                                <option value="Search Engine">Search Engine</option>
                                <option value="Social Media">Social Media</option>
                                <option value="Word of Mouth">Word of Mouth</option>
                                <option value="Advertisement">Advertisement</option>
                                <option value="Other">Other</option>
                            </x-select>
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
                            <x-button variant="primary" size="lg" type="submit" wire:loading.attr="disabled" wire:target="submit">
                                <span wire:loading.remove wire:target="submit">Submit Talent Application</span>
                                <span wire:loading wire:target="submit" class="flex items-center justify-center">
                                    <x-lucide-loader-2 class="animate-spin h-5 w-5 text-white" stroke-width="2" />
                                </span>
                            </x-button>
                        @endif
                    </div>
                </form>
            </x-card>
        @endif
    </div>
</div>
