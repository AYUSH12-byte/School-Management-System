@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', $news->excerpt ?? Str::limit(strip_tags($news->body), 160))

@section('content')

{{-- Article Hero --}}
<section class="relative overflow-hidden py-24 px-4">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900"></div>
    @if($news->image)
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-full w-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-transparent"></div>
    @endif
    <div class="relative mx-auto max-w-4xl text-center">
        <nav class="mb-6 flex flex-wrap items-center justify-center gap-2 text-sm text-slate-400">
            <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('news.index') }}" class="transition-colors hover:text-white">News</a>
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="line-clamp-1 text-slate-300">{{ $news->title }}</span>
        </nav>

        @if($news->published_at)
            <span class="mb-4 inline-block rounded-full border border-blue-500/30 bg-blue-500/20 px-4 py-1.5 text-sm font-semibold text-blue-300">
                {{ $news->published_at->format('F d, Y') }}
            </span>
        @endif
        <h1 class="text-4xl font-bold leading-tight text-white lg:text-5xl">{{ $news->title }}</h1>
        @if($news->excerpt)
            <p class="mx-auto mt-4 max-w-2xl text-lg text-slate-300">{{ $news->excerpt }}</p>
        @endif
    </div>
</section>

<section class="relative px-4 py-16">
    <div class="absolute inset-0 bg-slate-950"></div>
    <div class="relative mx-auto grid max-w-7xl gap-10 lg:grid-cols-3">

        {{-- Article Body --}}
        <div class="lg:col-span-2">
            @if($news->image)
                <div class="mb-10 overflow-hidden rounded-3xl shadow-2xl shadow-blue-950/30">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-80 w-full object-cover">
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
            <div class="mt-10 border-t border-slate-800 pt-8">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 font-semibold text-blue-400 transition-colors hover:text-blue-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Back to News
                </a>
            </div>
        </div>

        {{-- Sidebar: Related News --}}
        <aside class="lg:col-span-1">
            <div class="sticky top-24 rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-black/20">
                <h3 class="mb-6 flex items-center gap-2 text-lg font-bold text-white">
                    <div class="h-6 w-1 rounded-full bg-blue-500"></div>
                    Related Articles
                </h3>

                @if($related->count())
                    <div class="space-y-4">
                        @foreach($related as $item)
                            <a href="{{ route('news.show', $item->slug) }}"
                               class="group flex gap-4 rounded-2xl border border-slate-800 bg-slate-950/70 p-4 transition-all duration-200 hover:-translate-y-1 hover:border-blue-500/40 hover:bg-slate-900 block">
                                <div class="h-16 w-16 shrink-0 overflow-hidden rounded-xl">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-slate-700">
                                            <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="mb-1 text-xs text-slate-500">{{ $item->published_at ? $item->published_at->format('M d, Y') : '' }}</p>
                                    <h4 class="text-sm font-semibold leading-snug text-white transition-colors group-hover:text-blue-300 line-clamp-2">{{ $item->title }}</h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500">No related articles found.</p>
                @endif

                {{-- CTA --}}
                <div class="mt-8 rounded-2xl border border-blue-500/20 bg-gradient-to-br from-blue-500/10 to-purple-500/10 p-6 text-center">
                    <h4 class="mb-2 font-bold text-white">Stay Updated</h4>
                    <p class="mb-4 text-sm text-slate-400">Get the latest news and events from EduManage School.</p>
                    <a href="{{ route('contact.index') }}" class="btn-primary inline-block rounded-xl px-5 py-2.5 text-sm font-semibold text-white">
                        Contact Us
                    </a>
                </div>
            </div>
        </aside>
    </div>
</section>

@endsection
