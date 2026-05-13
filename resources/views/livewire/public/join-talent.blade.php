<div class="min-h-screen flex flex-col">
    @if($isSubmitted)
        <div class="flex-1 flex items-center justify-center py-24 bg-surface-muted">
            <x-card padding="p-16" class="text-center shadow-2xl max-w-2xl mx-auto">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
                    <x-lucide-check class="h-12 w-12 text-brand-primary" stroke-width="2" />
                </div>
                <x-heading level="h2" title="Application Submitted!" align="center" class="text-text-primary mb-6" />
                <p class="text-lg text-text-secondary mb-12 max-w-xl mx-auto">
                    Thanks for sharing your talent with us! We've successfully received your application. 
                    Our team will review your portfolio and reach out within 5-7 business days if there's a potential fit for our roster.
                </p>
                <x-button variant="primary" size="lg" href="/" wire:navigate>
                    Back to Home
                </x-button>
            </x-card>
        </div>
    @else
        <!-- Hero Section -->
        <section class="relative py-20 md:py-32 bg-linear-to-br from-surface-light via-surface-light to-brand-primary/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <x-heading level="h1" title="Join the Hailerz Roster" align="center" class="mb-6" />
                    <p class="text-xl text-text-secondary mb-8">
                        Are you a talented performer looking to take your career to the next level?
                        Join our exclusive roster of premium talent and get booked for high-profile events across Nigeria.
                    </p>
                </div>
            </div>
        </section>

        <!-- Why Join Section -->
        <section class="py-16 bg-surface-muted/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-5xl mx-auto">
                    <x-heading level="h2" title="Why Join Hailerz?" align="center" class="mb-12" />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Premium Events -->
                        <div class="rounded-2xl border border-subtle bg-surface-light p-8 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="bg-brand-primary/10 p-3 rounded-xl">
                                    <x-lucide-star class="h-6 w-6 text-brand-primary" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-text-primary">Premium Events</h3>
                                    <p class="text-text-secondary text-sm leading-relaxed">Get booked for high-end weddings, corporate events, festivals, and exclusive private parties with top-tier clients.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Career Growth -->
                        <div class="rounded-2xl border border-subtle bg-surface-light p-8 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="bg-brand-primary/10 p-3 rounded-xl">
                                    <x-lucide-trending-up class="h-6 w-6 text-brand-primary" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-text-primary">Career Growth</h3>
                                    <p class="text-text-secondary text-sm leading-relaxed">Expand your reach, build your reputation, and increase your earning potential with consistent, quality bookings.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Professional Support -->
                        <div class="rounded-2xl border border-subtle bg-surface-light p-8 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="bg-brand-primary/10 p-3 rounded-xl">
                                    <x-lucide-users class="h-6 w-6 text-brand-primary" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-text-primary">Professional Support</h3>
                                    <p class="text-text-secondary text-sm leading-relaxed">Our team handles contracts, negotiations, logistics, and client communications so you can focus on performing.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Marketing & Exposure -->
                        <div class="rounded-2xl border border-subtle bg-surface-light p-8 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="bg-brand-primary/10 p-3 rounded-xl">
                                    <x-lucide-music class="h-6 w-6 text-brand-primary" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-text-primary">Marketing & Exposure</h3>
                                    <p class="text-text-secondary text-sm leading-relaxed">Featured placement on our platform, social media promotion, and access to our network of event planners.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Who We're Looking For -->
        <section class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <x-heading level="h2" title="Who We're Looking For" align="center" class="mb-12" />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
                        <div>
                            <h3 class="text-xl font-bold mb-6 flex items-center gap-3 text-text-primary">
                                <x-lucide-mic class="h-6 w-6 text-brand-primary" />
                                Talent Categories
                            </h3>
                            <ul class="space-y-4 text-text-secondary">
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Solo Musicians (Vocalists, Instrumentalists)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Variety Artists (All genres)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    DJs (Wedding, Corporate, Club)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Speakers & Entertainers
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Specialty Acts
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-6 flex items-center gap-3 text-text-primary">
                                <x-lucide-radio class="h-6 w-6 text-brand-primary" />
                                Requirements
                            </h3>
                            <ul class="space-y-4 text-text-secondary">
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Professional performance experience
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    High-quality performance videos/recordings
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Reliable and professional demeanor
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Own equipment (where applicable)
                                </li>
                                <li class="flex items-center gap-3">
                                    <x-lucide-circle-check class="h-5 w-5 text-brand-primary" />
                                    Available for events in Nigeria
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-brand-primary/20 bg-brand-primary/5 p-8">
                        <div class="flex items-start gap-4">
                            <x-lucide-message-square class="h-6 w-6 text-brand-primary shrink-0 mt-1" />
                            <div>
                                <h3 class="text-lg font-bold mb-2 text-text-primary">Selection Process</h3>
                                <p class="text-text-secondary leading-relaxed">
                                    We carefully review every application. Our team evaluates your experience,
                                    performance quality, professionalism, and fit with our client base. Due
                                    to high volume, we can only accept a limited number of new artists each
                                    month. If selected, you'll be contacted within 5-7 business days.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section class="py-24 bg-surface-muted/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <x-heading level="h2" title="Submit Your Application" align="center" class="mb-12" />
                    
                    <!-- Progress Indicator -->
                    <div class="mb-16">
                        <div class="relative">
                            <div class="overflow-hidden h-1.5 mb-6 text-xs flex rounded-full bg-subtle">
                                <div style="width: {{ ($currentStep / 4) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-text-inverse justify-center bg-brand-primary transition-all duration-700"></div>
                            </div>
                            <div class="grid grid-cols-4 text-[10px] font-bold text-text-muted uppercase tracking-[0.2em]">
                                <span class="{{ $currentStep >= 1 ? 'text-brand-primary' : '' }} text-left">Basics</span>
                                <span class="{{ $currentStep >= 2 ? 'text-brand-primary' : '' }} text-center">Professional</span>
                                <span class="{{ $currentStep >= 3 ? 'text-brand-primary' : '' }} text-center">Portfolio</span>
                                <span class="{{ $currentStep >= 4 ? 'text-brand-primary' : '' }} text-right">Review</span>
                            </div>
                        </div>
                    </div>

                    <x-card padding="p-8 sm:p-12" class="shadow-xl">
                        <form wire:submit.prevent="submit" class="space-y-12">
                            <!-- Step 1: Artist Information -->
                            <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }} space-y-10">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Act Information</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-bold text-text-muted uppercase tracking-widest mb-4">Talent Type *</label>
                                        <div class="grid grid-cols-2 gap-4">
                                            <button type="button" wire:click="$set('talent_type', 'individual')" class="flex items-center justify-center gap-3 p-4 rounded-xl border {{ $talent_type === 'individual' ? 'border-brand-primary bg-brand-primary/5 text-brand-primary' : 'border-subtle bg-surface-light text-text-secondary hover:border-brand-primary/30' }} transition-all">
                                                <x-lucide-user class="w-5 h-5" />
                                                <span class="font-bold">Individual</span>
                                            </button>
                                            <button type="button" wire:click="$set('talent_type', 'group')" class="flex items-center justify-center gap-3 p-4 rounded-xl border {{ $talent_type === 'group' ? 'border-brand-primary bg-brand-primary/5 text-brand-primary' : 'border-subtle bg-surface-light text-text-secondary hover:border-brand-primary/30' }} transition-all">
                                                <x-lucide-users class="w-5 h-5" />
                                                <span class="font-bold">Group / Band</span>
                                            </button>
                                        </div>
                                    </div>

                                    @if($talent_type === 'group')
                                        <div class="md:col-span-2">
                                            <x-input wire:model="member_count" type="number" label="Number of Members *" placeholder="e.g. 4" />
                                        </div>
                                    @endif

                                    <x-input wire:model="artist_name" label="Act / Group Name *" placeholder="Your stage or band name" />
                                    <x-input wire:model="real_name" label="Contact Person Name *" placeholder="Your legal name" />
                                    <x-input wire:model="email" type="email" label="Email Address *" placeholder="your@email.com" />
                                    <x-input wire:model="phone" type="tel" label="Phone Number *" placeholder="+234 XXX XXX XXXX" />
                                    <div class="md:col-span-2">
                                        <x-input wire:model="location" label="Location (City, State) *" placeholder="Lagos, Nigeria" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input wire:model="profile_photo_url" label="Profile Photo URL *" placeholder="https://... (direct link to image)" />
                                        <p class="text-xs text-text-muted mt-2">Provide a high-quality link to your official promotional photo or logo.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Professional Details -->
                            <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }} space-y-10">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Professional Details</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <x-select wire:model="category" label="Talent Category *">
                                        <option value="">Select category</option>
                                        <option value="Musicians">Musicians</option>
                                        <option value="DJs">DJs</option>
                                        <option value="Speakers">Speakers</option>
                                        <option value="Dancers">Dancers</option>
                                        <option value="Artists">Artists</option>
                                        <option value="Poets">Poets</option>
                                        <option value="Content Creators">Content Creators</option>
                                        <option value="Comedians">Comedians</option>
                                        <option value="MCs">MCs</option>
                                        <option value="Variety Artists">Variety Artists</option>
                                    </x-select>
                                    <x-input wire:model="genre" label="Primary Genre/Style (Optional)" placeholder="e.g., Afrobeats, Jazz, Hip-Hop" />
                                    <x-input wire:model="years_active" label="Years Active *" placeholder="e.g., 5 years" />
                                    <div class="grid grid-cols-2 gap-4">
                                        <x-input wire:model="min_rate" type="number" label="Min Rate (₦) *" placeholder="e.g. 50000" />
                                        <x-input wire:model="max_rate" type="number" label="Max Rate (₦) *" placeholder="e.g. 150000" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-textarea wire:model="bio" label="Artist Bio *" rows="5" placeholder="Tell us about yourself, your style, and what makes you unique as a performer (min 200 characters)" />
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Portfolio & Socials -->
                            <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }} space-y-10">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Portfolio & Socials</h3>
                                <div class="space-y-10">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <x-input wire:model="instagram_handle" label="Instagram Handle" placeholder="@yourusername" />
                                        <x-input wire:model="youtube_channel" label="YouTube Channel" placeholder="youtube.com/@yourchannel" />
                                        <x-input wire:model="website_url" type="url" label="Website" placeholder="https://yourwebsite.com" class="md:col-span-2" />
                                    </div>

                                    <div class="space-y-6">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-lg font-bold text-text-primary">Media Portfolio</h4>
                                            <x-button type="button" variant="ghost" size="sm" wire:click="addGalleryItem" class="text-brand-primary border-brand-primary/20">
                                                <x-lucide-plus class="w-4 h-4 mr-2" />
                                                Add Media Link
                                            </x-button>
                                        </div>
                                        <div class="space-y-4">
                                            @foreach($gallery as $index => $item)
                                                <div class="bg-surface-muted/50 p-6 rounded-2xl border border-subtle relative">
                                                    <button type="button" wire:click="removeGalleryItem({{ $index }})" class="absolute top-4 right-4 text-text-muted hover:text-red-500 transition-colors">
                                                        <x-lucide-x class="w-4 h-4" />
                                                    </button>
                                                    <x-input wire:model="gallery.{{ $index }}.url" label="Media Link *" placeholder="YouTube, SoundCloud, or Drive link" />
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Final Review & Next Steps -->
                            <div class="{{ $currentStep != 4 ? 'hidden' : 'block' }} space-y-10">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Final Review & Next Steps</h3>
                                
                                <div class="bg-surface-muted rounded-2xl p-8 border border-subtle">
                                    <h4 class="text-sm font-bold text-text-primary uppercase tracking-widest mb-6">Application Process</h4>
                                    <ul class="space-y-4">
                                        <li class="flex items-start gap-4 text-sm text-text-secondary">
                                            <div class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                                <span class="text-[10px] font-bold text-brand-primary">1</span>
                                            </div>
                                            <p>Our talent scouts will review your portfolio and credentials (5-7 business days).</p>
                                        </li>
                                        <li class="flex items-start gap-4 text-sm text-text-secondary">
                                            <div class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                                <span class="text-[10px] font-bold text-brand-primary">2</span>
                                            </div>
                                            <p>If your act fits our roster, we'll schedule a brief virtual discovery call.</p>
                                        </li>
                                        <li class="flex items-start gap-4 text-sm text-text-secondary">
                                            <div class="h-6 w-6 rounded-full bg-brand-primary/10 flex items-center justify-center shrink-0">
                                                <span class="text-[10px] font-bold text-brand-primary">3</span>
                                            </div>
                                            <p>Upon approval, you'll be onboarded and made available to our premium clients.</p>
                                        </li>
                                    </ul>
                                </div>

                                <div class="space-y-6">
                                    <x-select wire:model="source" label="How did you hear about us?">
                                        <option value="">Select an option</option>
                                        <option value="social">Social Media</option>
                                        <option value="referral">Artist Referral</option>
                                        <option value="search">Search Engine</option>
                                        <option value="other">Other</option>
                                    </x-select>

                                    <div class="relative flex items-start p-6 bg-brand-primary/5 rounded-xl border border-brand-primary/10">
                                        <div class="flex h-6 items-center">
                                            <input wire:model="is_accurate" id="is_accurate" name="is_accurate" type="checkbox" class="h-4 w-4 rounded border-brand-primary/30 text-brand-primary focus:ring-brand-primary">
                                        </div>
                                        <div class="ml-4 text-sm leading-6">
                                            <label for="is_accurate" class="font-bold text-text-primary">Information Accuracy *</label>
                                            <p class="text-text-secondary text-xs">I confirm that all professional information and media provided are accurate and my own work.</p>
                                            @error('is_accurate') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <p class="text-[10px] text-text-muted leading-relaxed text-center italic">
                                        By submitting, you agree to our <a href="{{ route('legal.privacy') }}" wire:navigate class="underline">Privacy Policy</a>. 
                                        Your data is used strictly for recruitment and contact purposes.
                                    </p>
                                </div>
                            </div>

                            <!-- Navigation -->
                            <div class="flex items-center justify-end gap-4 mt-16 pt-10 border-t border-subtle">
                                @if($currentStep > 1)
                                    <x-button type="button" variant="outline" wire:click="previousStep">
                                        Back
                                    </x-button>
                                @endif

                                @if($currentStep < 4)
                                    <x-button type="button" variant="primary" wire:click="nextStep">
                                        Next Step
                                    </x-button>
                                @else
                                    <x-button variant="accent" size="lg" type="submit" class="px-10 h-14" wire:loading.attr="disabled">
                                        Submit Application
                                    </x-button>
                                @endif
                            </div>
                        </form>
                    </x-card>
                </div>
            </div>
        </section>
    @endif
</div>