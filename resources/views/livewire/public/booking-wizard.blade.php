<div class="bg-canvas min-h-screen py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($isComplete)
            <div class="bg-surface rounded-3xl p-12 text-center shadow-sm border border-dark/5">
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-8">
                    <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-3xl font-extrabold text-dark mb-4">Inquiry Received</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Thank you for your interest. A dedicated Hailerz agent will review your event details and budget, and get back to you within 24 hours.
                </p>
                <a href="/talent" wire:navigate class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-full text-white bg-dark hover:bg-dark-muted transition-colors">
                    Return to Directory
                </a>
            </div>
        @else
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-dark tracking-tight">Request a Quote</h1>
                <p class="mt-4 text-lg text-gray-600">Secure the perfect act for your next event.</p>
            </div>

            <!-- Progress Bar -->
            <div class="mb-12">
                <div class="relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-gray-200">
                        <div style="width: {{ ($currentStep / 3) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary transition-all duration-500"></div>
                    </div>
                    <div class="flex justify-between text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <span class="{{ $currentStep >= 1 ? 'text-primary font-bold' : '' }}">Event Details</span>
                        <span class="{{ $currentStep >= 2 ? 'text-primary font-bold' : '' }}">Budget</span>
                        <span class="{{ $currentStep >= 3 ? 'text-primary font-bold' : '' }}">Contact</span>
                    </div>
                </div>
            </div>

            <div class="bg-surface shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-3xl p-8 sm:p-12 border border-dark/5">
                <form wire:submit.prevent="submit">
                    
                    <!-- Step 1 -->
                    <div class="{{ $currentStep != 1 ? 'hidden' : 'block' }}">
                        <h3 class="text-2xl font-bold text-dark mb-8">Event Details</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="talent_id" class="block text-sm font-semibold text-gray-700 mb-2">Requested Talent</label>
                                <select id="talent_id" wire:model="talent_id" class="block w-full px-4 py-3 border border-dark/10 rounded-xl focus:ring-primary focus:border-primary shadow-sm bg-surface form-select">
                                    <option value="">-- Select a Talent --</option>
                                    @foreach($talents as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                                @error('talent_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="event_date" class="block text-sm font-semibold text-gray-700 mb-2">Event Date</label>
                                    <input type="date" id="event_date" wire:model="event_date" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                                    @error('event_date') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="event_location" class="block text-sm font-semibold text-gray-700 mb-2">Event City / Venue</label>
                                    <input type="text" id="event_location" wire:model="event_location" placeholder="e.g. Madison Square Garden, NYC" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                                    @error('event_location') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label for="event_description" class="block text-sm font-semibold text-gray-700 mb-2">Event Concept & Scale</label>
                                <textarea id="event_description" wire:model="event_description" rows="4" placeholder="Briefly describe the event, expected attendance, and what you expect from the talent..." class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm"></textarea>
                                @error('event_description') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="{{ $currentStep != 2 ? 'hidden' : 'block' }}">
                        <h3 class="text-2xl font-bold text-dark mb-8">Financial Commitment</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="proposed_budget" class="block text-sm font-semibold text-gray-700 mb-2">Proposed Talent Budget (USD)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-lg font-medium">$</span>
                                    </div>
                                    <input type="number" id="proposed_budget" wire:model="proposed_budget" class="block w-full pl-8 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm text-lg" placeholder="0.00">
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Providing an accurate budget helps our agents negotiate on your behalf and determine if the booking is viable. Minimum budget is $500.
                                </p>
                                @error('proposed_budget') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="{{ $currentStep != 3 ? 'hidden' : 'block' }}">
                        <h3 class="text-2xl font-bold text-dark mb-8">Your Information</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="client_name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name / Company</label>
                                <input type="text" id="client_name" wire:model="client_name" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                                @error('client_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="client_email" class="block text-sm font-semibold text-gray-700 mb-2">Professional Email</label>
                                    <input type="email" id="client_email" wire:model="client_email" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                                    @error('client_email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="client_phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" id="client_phone" wire:model="client_phone" class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                                    @error('client_phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex items-center justify-between mt-12 pt-8 border-t border-dark/10">
                        @if($currentStep > 1)
                            <button type="button" wire:click="previousStep" class="inline-flex items-center px-6 py-3 border border-gray-200 text-base font-semibold rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                                Back
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($currentStep < 3)
                            <button type="button" wire:click="nextStep" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-semibold rounded-xl text-white bg-dark hover:bg-dark-muted focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark shadow-sm transition-colors group">
                                Continue
                                <svg class="ml-2 -mr-1 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        @else
                            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-black rounded-xl text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-md hover:shadow-lg transition-all group">
                                Submit Request
                                <svg class="ml-2 -mr-1 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
