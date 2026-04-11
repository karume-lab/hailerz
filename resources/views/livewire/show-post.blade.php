<div class="py-24 bg-white min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-12">
            <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-slate-950 transition-colors group">
                <x-heroicon-o-arrow-long-left class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform" />
                Back to News
            </a>
        </div>

        <!-- Article Header -->
        <header class="mb-16">
            <div class="flex items-center gap-3 mb-8">
                <span class="px-3 py-1 bg-primary-100 text-primary-600 text-[10px] font-black uppercase tracking-widest rounded-full">
                    Industry Deep Dive
                </span>
                <time class="text-sm text-slate-400 font-medium" datetime="{{ $post->created_at->toW3cString() }}">
                    Published on {{ $post->created_at->format('M d, Y') }}
                </time>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-serif font-black text-slate-950 mb-0 tracking-tighter leading-none">
                {{ $post->title }}
            </h1>
        </header>

        <!-- Article Content -->
        <article class="prose prose-xl prose-slate max-w-none">
            {!! nl2br(e($post->content)) !!}
        </article>

        <!-- Footer / CTA -->
        <div class="mt-24 py-24 border-t border-slate-100 text-center">
            <h3 class="text-3xl font-serif font-black text-slate-950 mb-8">Have a similar event in mind?</h3>
            <a href="{{ route('booking.wizard') }}" class="inline-flex items-center justify-center px-10 py-5 bg-primary-600 text-white font-black rounded-2xl hover:bg-primary-700 transition-all shadow-xl shadow-primary-200/50 hover:-translate-y-1">
                Book Elite Talent Now
                <x-heroicon-o-sparkles class="w-5 h-5 ml-2" />
            </a>
        </div>
    </div>
</div>
