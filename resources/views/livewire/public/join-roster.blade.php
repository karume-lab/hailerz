<div class="bg-canvas min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($isSubmitted)
            <div class="bg-surface rounded-3xl p-12 text-center shadow-sm border border-border mt-12">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-500/10 mb-8">
                    <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-3xl font-extrabold text-text-main mb-4">Application Received</h2>
                <p class="text-lg text-text-muted mb-8">
                    Thank you for applying to join the Hailerz roster. Our A&R team reviews all submissions. Due to high volume, we only contact candidates that are a fit for our current booking needs.
                </p>
                <a href="/" wire:navigate class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-full text-white bg-primary hover:bg-primary-dark transition-colors">
                    Return to Homepage
                </a>
            </div>
        @else
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-text-main tracking-tight">Become a Hailerz Talent</h1>
                <p class="mt-4 text-xl text-text-muted">Access exclusive booking opportunities, seamless contracting, and global exposure.</p>
            </div>

            <!-- Progress Bar -->
            <div class="mb-12 max-w-2xl mx-auto">
                <div class="relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-border">
                        <div style="width: {{ ($currentStep / 3) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary transition-all duration-500"></div>
                    </div>
                    <div class="flex justify-between text-xs font-semibold text-text-muted uppercase tracking-wider">
                        <span class="{{ $currentStep >= 1 ? 'text-primary font-bold' : '' }}">Identity</span>
                        <span class="{{ $currentStep >= 2 ? 'text-primary font-bold' : '' }}">Media</span>
                        <span class="{{ $currentStep >= 3 ? 'text-primary font-bold' : '' }}">Background</span>
                    </div>
                </div>
            </div>

            <div class="w-full bg-surface p-8 sm:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-border">
                <form wire:submit.prevent="submit">
                    
                    <!-- Step 1: Identity -->
                    <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }}">
                        <h3 class="text-2xl font-bold text-text-main mb-6">Identity & Contact</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="artist_name" class="block text-sm font-semibold text-text-main mb-2">Stage Name / Act Name</label>
                                <input type="text" id="artist_name" wire:model="artist_name" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="e.g. The Midnight Echo">
                                @error('artist_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-text-main mb-2">Contact Email</label>
                                <input type="email" id="email" wire:model="email" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="contact@example.com">
                                @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-text-main mb-2">Phone Number</label>
                                <input type="tel" id="phone" wire:model="phone" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="(555) 123-4567">
                                @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-semibold text-text-main mb-2">Primary Location / City</label>
                                <input type="text" id="location" wire:model="location" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="e.g. Los Angeles, CA">
                                @error('location') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-semibold text-text-main mb-2">Primary Category</label>
                                <input type="text" id="category" wire:model="category" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="e.g. Live Band, DJ, Speaker">
                                @error('category') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="genre" class="block text-sm font-semibold text-text-main mb-2">Genre / Style</label>
                                <input type="text" id="genre" wire:model="genre" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="e.g. Electronic, Jazz, Corporate">
                                @error('genre') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Media & Presence -->
                    <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }}">
                        <h3 class="text-2xl font-bold text-text-main mb-6">Media & Presence</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="epk_link" class="block text-sm font-semibold text-text-main mb-2">Electronic Press Kit (EPK) Link</label>
                                <input type="url" id="epk_link" wire:model="epk_link" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="https://website.com/epk">
                                <p class="text-xs text-text-muted mt-1">Must include high-quality live performance footage, branding, and rider details if applicable.</p>
                                @error('epk_link') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="instagram_url" class="block text-sm font-semibold text-text-main mb-2">Instagram Profile (Optional)</label>
                                    <input type="url" id="instagram_url" wire:model="instagram_url" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="https://instagram.com/...">
                                    @error('instagram_url') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="youtube_url" class="block text-sm font-semibold text-text-main mb-2">YouTube Channel (Optional)</label>
                                    <input type="url" id="youtube_url" wire:model="youtube_url" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="https://youtube.com/...">
                                    @error('youtube_url') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="spotify_url" class="block text-sm font-semibold text-text-main mb-2">Spotify Artist Page (Optional)</label>
                                    <input type="url" id="spotify_url" wire:model="spotify_url" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="https://open.spotify.com/artist/...">
                                    @error('spotify_url') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Background & Fees -->
                    <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }}">
                        <h3 class="text-2xl font-bold text-text-main mb-6">Background & Booking Info</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="bio" class="block text-sm font-semibold text-text-main mb-2">Short Bio & Career Highlights</label>
                                <textarea id="bio" wire:model="bio" rows="4" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="Briefly detail your experience, notable performances, and style..."></textarea>
                                @error('bio') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="years_experience" class="block text-sm font-semibold text-text-main mb-2">Years of Live Experience</label>
                                    <input type="number" id="years_experience" wire:model="years_experience" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="e.g. 5">
                                    @error('years_experience') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="minimum_fee" class="block text-sm font-semibold text-text-main mb-2">Minimum Booking Fee (USD)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="text-text-muted sm:text-lg font-medium">$</span>
                                        </div>
                                        <input type="number" id="minimum_fee" wire:model="minimum_fee" class="block w-full pl-8 pr-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="1000">
                                    </div>
                                    @error('minimum_fee') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                                <div class="bg-canvas p-4 rounded-xl border border-border">
                                    <div class="flex items-center">
                                        <input id="has_management" wire:model="has_management" type="checkbox" class="w-4 h-4 text-primary border-border rounded focus:ring-primary">
                                        <label for="has_management" class="ml-3 font-semibold text-text-main text-sm cursor-pointer mb-0">I have exclusive representation</label>
                                    </div>
                                    <p class="text-xs text-text-muted mt-2 ml-7">Check this if an agency or manager handles your bookings exclusively.</p>
                                </div>

                                @if($has_management)
                                    <div>
                                        <label for="management_contact" class="block text-sm font-semibold text-text-main mb-2">Management Contact Details</label>
                                        <input type="text" id="management_contact" wire:model="management_contact" class="block w-full px-4 py-3 border border-border rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-canvas text-text-main" placeholder="Name / Email / Phone">
                                        @error('management_contact') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex items-center justify-between mt-12 pt-8 border-t border-border">
                        @if($currentStep > 1)
                            <button type="button" wire:click="previousStep" class="inline-flex items-center px-6 py-3 border border-border text-base font-semibold rounded-xl text-text-main bg-canvas hover:bg-surface focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                Back
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($currentStep < 3)
                            <button type="button" wire:click="nextStep" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-semibold rounded-xl text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-sm transition-colors group">
                                Continue
                                <svg class="ml-2 -mr-1 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        @else
                            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-black rounded-xl text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-md hover:shadow-lg transition-all group">
                                Submit Application
                                <svg class="ml-2 -mr-1 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
