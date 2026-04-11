<div class="bg-canvas min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($isSubmitted)
            <div class="bg-surface rounded-3xl p-12 text-center shadow-sm border border-dark/5 mt-12">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-8">
                    <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-3xl font-extrabold text-dark mb-4">Application Received</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Thank you for applying to join the Hailerz roster. Our A&R team reviews all submissions. Due to high volume, we only contact candidates that are a fit for our current booking needs.
                </p>
                <a href="/" wire:navigate class="font-semibold text-primary hover:text-primary-dark transition">
                    Return to Homepage
                </a>
            </div>
        @else
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-dark tracking-tight">Become a Hailerz Talent</h1>
                <p class="mt-4 text-xl text-gray-600">Access exclusive booking opportunities, seamless contracting, and global exposure.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-8">
                <!-- Info Panel -->
                <div class="w-full md:w-1/3 space-y-6">
                    <div class="bg-dark p-6 rounded-2xl text-white">
                        <h3 class="font-bold text-lg mb-2">Exclusive Network</h3>
                        <p class="text-sm text-gray-400">Join a curated list of top-tier talent performing at premier global events.</p>
                    </div>
                    <div class="bg-surface p-6 rounded-2xl shadow-sm border border-dark/5">
                        <h3 class="font-bold text-lg mb-2 text-dark">Zero Upfront Fees</h3>
                        <p class="text-sm text-gray-600">We operate on a transparent commission structure based purely on secured bookings.</p>
                    </div>
                    <div class="bg-surface p-6 rounded-2xl shadow-sm border border-dark/5">
                        <h3 class="font-bold text-lg mb-2 text-dark">Dedicated Agents</h3>
                        <p class="text-sm text-gray-600">Our agents handle the stressful negotiations, logistics, and riders.</p>
                    </div>
                </div>

                <!-- Form Panel -->
                <div class="w-full md:w-2/3 bg-surface p-8 sm:p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-dark/5">
                    <h3 class="text-2xl font-bold text-dark mb-6">Application Form</h3>
                    <form wire:submit.prevent="submit" class="space-y-6">
                        
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Stage or Act Name</label>
                            <input type="text" id="name" wire:model="name" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm" placeholder="e.g. The Midnight Echo">
                            @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Contact Email</label>
                            <input type="email" id="email" wire:model="email" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                            @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="portfolio_url" class="block text-sm font-semibold text-gray-700 mb-2">Media / EPK Link</label>
                            <input type="url" id="portfolio_url" wire:model="portfolio_url" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm" placeholder="https://youtube.com/...">
                            <p class="text-xs text-gray-500 mt-1">Must include high-quality live performance footage.</p>
                            @error('portfolio_url') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">Short Bio & Career Highlights</label>
                            <textarea id="bio" wire:model="bio" rows="4" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm" placeholder="Briefly detail your experience..."></textarea>
                            @error('bio') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full flex justify-center py-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-dark hover:bg-dark-muted focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark transition">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
