@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', $news->excerpt ?? Str::limit(strip_tags($news->body), 160))

@section('content')

{{-- Article Hero --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900"></div>
    @if($news->image)
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-transparent"></div>
    @endif
    <div class="relative max-w-4xl mx-auto text-center">
        <nav class="flex justify-center items-center gap-2 text-sm text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('news.index') }}" class="hover:text-white transition-colors">News</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-300 line-clamp-1">{{ $news->title }}</span>
        </nav>

        @if($news->published_at)
            <span class="inline-block bg-blue-500/20 text-blue-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-blue-500/30">
                {{ $news->published_at->format('F d, Y') }}
            </span>
        @endif
        <h1 class="text-4xl lg:text-5xl font-bold text-white leading-tight">{{ $news->title }}</h1>
    </div>
</section>

<section class="relative py-16 px-4">
    <div class="absolute inset-0 bg-slate-950"></div>
    <div class="relative max-w-7xl mx-auto grid lg:grid-cols-3 gap-10">

        {{-- Article Body --}}
        <div class="lg:col-span-2">
            @if($news->image)
                <div class="rounded-2xl overflow-hidden mb-10 shadow-2xl">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-80 object-cover">
                </div>
            @endif

            <article class="prose prose-invert prose-lg max-w-none
                prose-headings:text-white prose-headings:font-bold
                prose-p:text-slate-300 prose-p:leading-relaxed
                prose-a:text-blue-400 prose-a:no-underline hover:prose-a:text-blue-300
                prose-strong:text-white
                prose-blockquote:border-blue-500 prose-blockquote:text-slate-400
                prose-img:rounded-xl
                prose-li:text-slate-300">
                {!! $news->body !!}
            </article>

            {{-- Back Link --}}
            <div class="mt-10 pt-8 border-t border-slate-800">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Back to News
                </a>
            </div>
        </div>

        {{-- Sidebar: Related News --}}
        <aside class="lg:col-span-1">
            <div class="sticky top-24">
                <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <div class="w-1 h-6 bg-blue-500 rounded-full"></div>
                    Related Articles
                </h3>

                @if($related->count())
                    <div class="space-y-4">
                        @foreach($related as $item)
                            <a href="{{ route('news.show', $item->slug) }}"
                               class="card group flex gap-4 p-4 rounded-xl hover:scale-[1.02] transition-all duration-200 block">
                                <div class="w-16 h-16 rounded-lg overflow-hidden shrink-0">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-slate-700 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-slate-500 text-xs mb-1">{{ $item->published_at ? $item->published_at->format('M d, Y') : '' }}</p>
                                    <h4 class="text-white text-sm font-semibold group-hover:text-blue-300 transition-colors line-clamp-2 leading-snug">{{ $item->title }}</h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-slate-500 text-sm">No related articles found.</p>
                @endif

                {{-- CTA --}}
                <div class="mt-8 glass rounded-2xl p-6 text-center">
                    <h4 class="text-white font-bold mb-2">Stay Updated</h4>
                    <p class="text-slate-400 text-sm mb-4">Get the latest news and events from EduManage School.</p>
                    <a href="{{ route('contact.index') }}" class="btn-primary text-white font-semibold px-5 py-2.5 rounded-xl text-sm inline-block">
                        Contact Us
                    </a>
                </div>
            </div>
        </aside>
    </div>
</section>

@endsection
