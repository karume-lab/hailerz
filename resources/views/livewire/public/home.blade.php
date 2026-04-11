<div class="bg-canvas">
    <!-- Hero Section -->
    <section class="relative bg-dark text-white overflow-hidden py-32 lg:py-48">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1540039155733-d76e6c4849ec?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center opacity-30 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-linear-to-t from-dark via-dark/80 to-transparent"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8">
                Secure the perfect act.<br />
                <span class="text-transparent bg-clip-text bg-linear-to-r from-primary-400 to-indigo-500">Leave nothing to chance.</span>
            </h1>
            <p class="mt-4 max-w-2xl text-xl text-gray-300 mx-auto mb-10">
                Access an exclusive roster of world-class performers, speakers, and artists. Seamless booking, transparent pricing, guaranteed excellence.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="/talent" wire:navigate class="px-8 py-4 border border-transparent text-lg font-medium rounded-full text-white bg-primary hover:bg-primary-dark shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all w-full sm:w-auto text-center">
                    Explore Roster
                </a>
                <a href="/book" wire:navigate class="px-8 py-4 border border-dark-muted/20 text-lg font-medium rounded-full text-white bg-transparent hover:bg-dark-muted/10 transition-all w-full sm:w-auto text-center">
                    Request a Quote
                </a>
            </div>
        </div>
    </section>

    <!-- Trusted By / Social Proof -->
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm font-semibold uppercase text-gray-500 tracking-wide mb-8">Trusted by Top Event Producers & Brands</p>
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <svg class="h-8 text-gray-900" viewBox="0 0 100 30" fill="currentColor"><path d="M10,25 h15 v-20 h-15 z M35,25 h15 v-20 h-15 z M60,25 h15 v-20 h-15 z M85,25 h15 v-20 h-20"/></svg>
                <svg class="h-8 text-gray-900" viewBox="0 0 100 30" fill="currentColor"><circle cx="15" cy="15" r="10"/><rect x="35" y="5" width="20" height="20"/><polygon points="75,5 95,5 85,25"/></svg>
                <svg class="h-8 text-gray-900" viewBox="0 0 100 30" fill="currentColor"><path d="M5,15 Q25,5 45,15 T85,15"/></svg>
                <svg class="h-8 text-gray-900 hidden sm:block" viewBox="0 0 100 30" fill="currentColor"><rect x="10" y="5" width="80" height="20" rx="10"/></svg>
            </div>
        </div>
    </section>

    <!-- Categories Quick Browse -->
    <section class="py-20 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-dark-muted">Explore by Category</h2>
                <p class="mt-4 text-lg text-gray-600">Find exactly what you need for your specific event type.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category Card -->
                <a href="/talent?category=musicians" class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Live Musicians" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-t from-gray-950 via-gray-900/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">Live Bands</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=speakers" class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="https://images.unsplash.com/photo-1475721028070-2051152a4687?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Keynote Speakers" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-t from-gray-950 via-gray-900/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">Speakers</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=djs" class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="https://images.unsplash.com/photo-1571266028243-3716f02d2d2e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="DJs & Electronics" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-t from-gray-950 via-gray-900/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">DJs</h3>
                    </div>
                </a>
                <!-- Category Card -->
                <a href="/talent?category=specialty" class="group relative h-64 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <img src="https://images.unsplash.com/photo-1541844053589-346841d0b34c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Specialty Acts" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-linear-to-t from-gray-950 via-gray-900/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">Specialty</h3>
                    </div>
                </a>
            </div>
            
            <div class="mt-12 text-center">
                <a href="/talent" wire:navigate class="inline-flex items-center text-primary font-bold hover:text-primary-dark transition">
                    View Entire Roster <svg class="w-5 h-5 ml-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Us (Former Trust Bar) -->
    <section class="py-20 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Seamless Talent Procurement</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div class="flex flex-col items-center p-4">
                    <div class="h-12 w-12 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Vetted Professionals</h3>
                    <p class="mt-2 text-sm text-gray-500">Every talent on our roster undergoes a rigorous screening process for reliability and excellence.</p>
                </div>
                <div class="flex flex-col items-center p-4">
                    <div class="h-12 w-12 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Transparent Pricing</h3>
                    <p class="mt-2 text-sm text-gray-500">No hidden fees or surprise costs. Clear, upfront pricing tailored to your specific event needs.</p>
                </div>
                <div class="flex flex-col items-center p-4">
                    <div class="h-12 w-12 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Secure Contracts</h3>
                    <p class="mt-2 text-sm text-gray-500">Ironclad legal agreements protect both you and the talent, ensuring a frictionless process.</p>
                </div>
            </div>
        </div>
    </section>
</div>
