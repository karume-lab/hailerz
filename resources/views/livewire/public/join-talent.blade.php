<div class="min-h-screen flex flex-col">
    @if($isSubmitted)
        <div class="flex-1 flex items-center justify-center py-24 bg-surface-muted">
            <x-card padding="p-16" class="text-center shadow-2xl max-w-2xl mx-auto">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-brand-primary/10 mb-10">
                    <x-lucide-check class="h-12 w-12 text-brand-primary" stroke-width="2" />
                </div>
                <x-heading level="h2" title="Application Submitted!" class="text-text-primary mb-6" />
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
                    
                    <x-card padding="p-8 sm:p-12" class="shadow-xl">
                        <form wire:submit.prevent="submit" class="space-y-12">
                            <!-- Artist Information -->
                            <div class="space-y-8">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Artist Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <x-input wire:model="artist_name" label="Artist/Stage Name *" placeholder="Your stage name" />
                                    <x-input wire:model="real_name" label="Real Name *" placeholder="Your legal name" />
                                    <x-input wire:model="email" type="email" label="Email Address *" placeholder="your@email.com" />
                                    <x-input wire:model="phone" type="tel" label="Phone Number *" placeholder="+234 XXX XXX XXXX" />
                                    <div class="md:col-span-2">
                                        <x-input wire:model="location" label="Location (City, State) *" placeholder="Lagos, Nigeria" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input wire:model="profile_photo_url" label="Profile Photo URL *" placeholder="https://... (direct link to image)" />
                                        <p class="text-xs text-text-muted mt-2">JPEG, PNG or WebP, max 5MB.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Details -->
                            <div class="space-y-8">
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
                                </div>
                            </div>

                            <!-- Online Presence -->
                            <div class="space-y-8">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Online Presence</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <x-input wire:model="website_url" type="url" label="Website" placeholder="https://yourwebsite.com" />
                                    </div>
                                    <x-input wire:model="instagram_handle" label="Instagram Handle" placeholder="@yourusername" />
                                    <x-input wire:model="facebook_url" label="Facebook Page" placeholder="facebook.com/yourpage" />
                                    <x-input wire:model="youtube_channel" label="YouTube Channel" placeholder="youtube.com/@yourchannel" />
                                    <x-input wire:model="tiktok_handle" label="TikTok" placeholder="@yourusername" />
                                </div>
                            </div>

                            <!-- Experience & Credentials -->
                            <div class="space-y-8">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Experience & Credentials</h3>
                                <div class="space-y-6">

                                    <x-textarea wire:model="notable_clients" label="Notable Events/Clients" rows="3" placeholder="Describe significant events or high-profile clients you've worked with" />
                                    <x-textarea wire:model="press_features" label="Press Features/Awards" rows="3" placeholder="Any media features, awards, or recognition you've received" />
                                </div>
                            </div>

                            <!-- Media Portfolio -->
                            <div class="space-y-8">
                                <div class="flex items-center justify-between border-b border-subtle pb-4">
                                    <h3 class="text-2xl font-bold text-text-primary">Media Portfolio</h3>
                                    <x-button type="button" variant="ghost" size="sm" wire:click="addGalleryItem" class="text-brand-primary border-brand-primary/20 hover:bg-brand-primary/5">
                                        <x-lucide-plus class="w-4 h-4 mr-2" />
                                        Add Media Item
                                    </x-button>
                                </div>
                                <p class="text-sm text-text-secondary">Add links to your performance videos (YouTube/Vimeo), audio samples (SoundCloud), or portfolio images.</p>
                                
                                <div class="space-y-6">
                                    @foreach($gallery as $index => $item)
                                        <div class="bg-surface-muted/50 p-6 rounded-2xl border border-subtle relative group">
                                            <button type="button" wire:click="removeGalleryItem({{ $index }})" class="absolute top-4 right-4 text-text-muted hover:text-red-500 transition-colors">
                                                <x-lucide-x class="w-5 h-5" />
                                            </button>
                                            <div class="grid grid-cols-1 gap-6">
                                                <x-input wire:model="gallery.{{ $index }}.url" label="Media Link *" placeholder="https://youtube.com/watch?v=..." />
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    <x-input wire:model="gallery.{{ $index }}.title" label="Title" placeholder="e.g. Live Performance at Eko Hotel" />
                                                    <x-input wire:model="gallery.{{ $index }}.description" label="Short Description" placeholder="e.g. Vocal performance with live band" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if(count($gallery) === 0)
                                        <div class="text-center py-12 border-2 border-dashed border-subtle rounded-2xl">
                                            <x-lucide-image class="w-12 h-12 text-text-muted mx-auto mb-4 opacity-20" />
                                            <p class="text-text-secondary text-sm">No media items added yet. Click "Add Media Item" to showcase your work.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="space-y-8">
                                <h3 class="text-2xl font-bold text-text-primary border-b border-subtle pb-4">Additional Information</h3>
                                <div class="space-y-6">
                                    <x-textarea wire:model="bio" label="Artist Bio *" rows="5" placeholder="Tell us about yourself, your style, and what makes you unique as a performer (200-500 words)" />

                                    <x-select wire:model="source" label="How did you hear about us?">
                                        <option value="">Select an option</option>
                                        <option value="google">Google Search</option>
                                        <option value="social">Social Media</option>
                                        <option value="referral">Referral from another artist</option>
                                        <option value="event">Saw you at an event</option>
                                        <option value="other">Other</option>
                                    </x-select>
                                </div>
                            </div>

                            <div class="bg-surface-muted rounded-xl p-6">
                                <p class="text-sm text-text-secondary leading-relaxed">
                                    <strong>Note:</strong> By submitting this application, you confirm that all information 
                                    provided is accurate and that you have the legal right to perform the 
                                    material in your repertoire. We'll review your application and contact 
                                    you if there's a potential fit for our roster.
                                </p>
                            </div>

                            <x-button variant="accent" size="lg" type="submit" class="w-full h-14 text-lg" wire:loading.attr="disabled">
                                <span wire:loading.remove>Submit Application</span>
                                <span wire:loading class="flex items-center gap-2">
                                    <x-lucide-loader-2 class="animate-spin h-5 w-5" />
                                    Submitting...
                                </span>
                            </x-button>
                        </form>
                    </x-card>
                </div>
            </div>
        </section>
    @endif
</div>