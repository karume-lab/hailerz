<div class="space-y-24 pb-24">
    <!-- Hero Section -->
    <section class="relative pt-20 pb-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-primary-100 text-primary-700 mb-8">
                    Premium Talent Management
                </span>
                <h1 class="text-5xl md:text-7xl font-serif font-extrabold text-slate-950 tracking-tight mb-8 leading-[1.1]">
                    Book Elite Talent for <br class="hidden md:block"> 
                    <span class="text-primary-600">Unforgettable</span> Events
                </h1>
                <p class="text-xl text-slate-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Access an exclusive roster of world-class musicians, keynote speakers, and comedians. 
                    Streamlined booking to elevate your next experience.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="/talent" class="w-full sm:w-auto px-8 py-4 bg-primary-600 text-white font-bold rounded-full hover:bg-primary-700 transition-all shadow-xl shadow-primary-200 hover:-translate-y-0.5">
                        Browse Full Roster
                    </a>
                    <a href="/book" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-900 border border-slate-200 font-bold rounded-full hover:bg-slate-50 transition-all shadow-sm">
                        Submit General Inquiry
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Background Accents -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-200/20 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl opacity-50"></div>
        </div>
    </section>

    <!-- Featured Talent -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-serif font-bold text-slate-950 mb-3">Featured Roster</h2>
                <p class="text-slate-500">Our most requested performers and experts this season.</p>
            </div>
            <a href="/talent" class="hidden sm:flex items-center gap-2 text-sm font-bold text-primary-600 hover:text-primary-700 transition-colors group">
                View All Talent 
                <x-heroicon-o-arrow-right class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" />
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredTalent as $talent)
                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 hover:-translate-y-1">
                    <div class="relative h-80 overflow-hidden">
                        <img 
                            src="{{ $talent->getFirstMediaUrl('primary_image') ?: 'https://images.unsplash.com/photo-1514525253361-bee8a187499b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                            alt="{{ $talent->name }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                        >
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur text-[10px] font-black uppercase tracking-widest text-slate-900 rounded-full shadow-sm">
                                {{ $talent->category?->name }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-slate-950 mb-1 leading-none">{{ $talent->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $talent->location }}</p>
                            </div>
                            <p class="text-sm font-bold text-slate-900">
                                <span class="text-[10px] text-slate-400 font-normal uppercase block">Starting from</span>
                                ${{ number_format($talent->starting_price, 0) }}
                            </p>
                        </div>
                        
                        <p class="text-slate-500 text-sm line-clamp-2 mb-8 leading-relaxed">
                            {{ strip_tags($talent->bio) }}
                        </p>
                        
                        <a href="/talent/{{ $talent->slug }}" class="w-full inline-flex items-center justify-center px-6 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-900 group-hover:bg-primary-600 group-hover:text-white group-hover:border-primary-600 transition-all duration-300">
                            View Profile
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                    <p class="text-slate-400">No featured talent found at the moment.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Call to Action -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900 rounded-[3rem] p-12 md:p-24 overflow-hidden relative">
            <div class="relative z-10 max-w-2xl">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-8 leading-[1.2]">
                    Ready to book <br> your next headliner?
                </h2>
                <p class="text-slate-300 text-lg mb-12 leading-relaxed">
                    Our dedicated booking agents handle all the logistics, 
                    from contracting to technical riders, ensuring a seamless experience.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/book" class="px-8 py-4 bg-primary-600 text-white font-bold rounded-full hover:bg-primary-700 transition-all shadow-lg shadow-primary-900/40">
                        Get Started
                    </a>
                    <a href="/about" class="px-8 py-4 bg-white/10 text-white font-bold rounded-full hover:bg-white/20 transition-all backdrop-blur-sm">
                        Our Process
                    </a>
                </div>
            </div>
            
            <!-- Abstract Graphic -->
            <div class="absolute top-0 right-0 w-1/2 h-full z-0 opacity-20 pointer-events-none hidden md:block">
                <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg" class="w-full h-full scale-110">
                    <path fill="#3b82f6" d="M47.7,-64.2C61.4,-56.3,71.7,-41.8,76.5,-26.1C81.3,-10.3,80.5,6.7,74.5,21.6C68.5,36.5,57.3,49.2,43.7,58.7C30.1,68.2,14.1,74.5,-2.6,78.1C-19.3,81.7,-38.5,82.5,-52.8,73.5C-67.1,64.5,-76.4,45.7,-80.4,26.7C-84.4,7.7,-83.1,-11.5,-74.8,-27.2C-66.5,-42.9,-51.2,-55.1,-35.3,-61.9C-19.4,-68.8,-2.9,-70.3,13.8,-70.3C30.5,-70.3,34.1,-72.1,47.7,-64.2Z" transform="translate(200 200)" />
                </svg>
            </div>
        </div>
    </section>
</div>
