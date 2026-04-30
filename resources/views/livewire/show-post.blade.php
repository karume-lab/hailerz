<div class="py-24 bg-canvas min-h-screen">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Back Button -->
    <div class="mb-12">
      <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-bold text-text-muted hover:text-text-main transition-colors group">
        <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
        Back to News
      </a>
    </div>

    <!-- Article Header -->
    <header class="mb-16">
      <div class="flex items-center gap-3 mb-8">
        <span class="px-3 py-1 bg-brand-primary/10 text-primary text-[10px] font-black uppercase tracking-widest rounded-full">
          Industry Deep Dive
        </span>
        <time class="text-sm text-text-muted font-medium" datetime="{{ $post->created_at->toW3cString() }}">
          Published on {{ $post->created_at->format('M d, Y') }}
        </time>
      </div>
      
      <h1 class="text-5xl md:text-6xl font-bold text-text-main mb-0 tracking-tight leading-none">
        {{ $post->title }}
      </h1>
    </header>

    <!-- Article Content -->
    <article class="prose prose-xl prose-indigo max-w-none text-text-muted">
      {!! nl2br(e($post->content)) !!}
    </article>

    <!-- Footer / CTA -->
    <div class="mt-24 py-24 border-t border-border text-center">
      <h3 class="text-3xl font-bold text-text-main mb-8">Have a similar event in mind?</h3>
      <a href="{{ route('booking.wizard') }}" class="inline-flex items-center justify-center px-10 py-5 bg-brand-primary text-white font-black rounded-2xl hover:bg-brand-primary transition-all shadow-xl shadow-primary/20 hover:-translate-y-1">
        Book Elite Talent Now
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
      </a>
    </div>
  </div>
</div>

