@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', $news->excerpt ?? Str::limit(strip_tags($news->body), 160))

@section('content')

{{-- Article Hero --}}
<section class="relative overflow-hidden py-24 px-4 bg-gradient-to-br from-slate-900 via-primary-900 to-primary-800">
    @if($news->image)
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-full w-full object-cover">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent"></div>
    @endif
    <div class="relative mx-auto max-w-4xl text-center">
        <nav class="mb-6 flex flex-wrap items-center justify-center gap-2 text-sm text-blue-200">
            <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('news.index') }}" class="transition-colors hover:text-white">News</a>
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="line-clamp-1 text-slate-300">{{ $news->title }}</span>
        </nav>

        @if($news->published_at)
            <span class="mb-4 inline-block rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-sm font-semibold text-blue-200">
                {{ $news->published_at->format('F d, Y') }}
            </span>
        @endif
        <h1 class="text-4xl font-bold leading-tight text-white lg:text-5xl">{{ $news->title }}</h1>
        @if($news->excerpt)
            <p class="mx-auto mt-4 max-w-2xl text-lg text-blue-100/80">{{ $news->excerpt }}</p>
        @endif
    </div>
</section>

<section class="relative px-4 py-16 bg-white">
    <div class="relative mx-auto grid max-w-7xl gap-10 lg:grid-cols-3">

        {{-- Article Body --}}
        <div class="lg:col-span-2">
            @if($news->image)
                <div class="mb-10 overflow-hidden rounded-3xl shadow-sm border border-slate-200">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-80 w-full object-cover">
                </div>
            @endif

            <article class="prose prose-lg max-w-none
                prose-headings:text-slate-900 prose-headings:font-bold
                prose-p:text-slate-600 prose-p:leading-relaxed
                prose-a:text-primary-600 prose-a:no-underline hover:prose-a:text-primary-700
                prose-strong:text-slate-900
                prose-blockquote:border-primary-500 prose-blockquote:text-slate-500
                prose-img:rounded-xl
                prose-li:text-slate-600">
                {!! $news->body !!}
            </article>

            {{-- Back Link --}}
            <div class="mt-10 border-t border-slate-200 pt-8">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 font-semibold text-primary-600 transition-colors hover:text-primary-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Back to News
                </a>
            </div>
        </div>

        {{-- Sidebar: Related News --}}
        <aside class="lg:col-span-1">
            <div class="sticky top-24 rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                <h3 class="mb-6 flex items-center gap-2 text-lg font-bold text-slate-900">
                    <div class="h-6 w-1 rounded-full bg-primary-500"></div>
                    Related Articles
                </h3>

                @if($related->count())
                    <div class="space-y-4">
                        @foreach($related as $item)
                            <a href="{{ route('news.show', $item->slug) }}"
                               class="group flex gap-4 rounded-2xl border border-slate-200 bg-white p-4 transition-all duration-200 hover:-translate-y-1 hover:border-primary-500/40 hover:shadow-md block">
                                <div class="h-16 w-16 shrink-0 overflow-hidden rounded-xl">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center bg-slate-100">
                                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="mb-1 text-xs text-slate-400">{{ $item->published_at ? $item->published_at->format('M d, Y') : '' }}</p>
                                    <h4 class="text-sm font-semibold leading-snug text-slate-900 transition-colors group-hover:text-primary-500 line-clamp-2">{{ $item->title }}</h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500">No related articles found.</p>
                @endif

                {{-- CTA --}}
                <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 text-center">
                    <h4 class="mb-2 font-bold text-slate-900">Stay Updated</h4>
                    <p class="mb-4 text-sm text-slate-500 font-medium">Get the latest news and events from EduManage School.</p>
                    <a href="{{ route('contact.index') }}" class="btn-primary inline-block rounded-xl px-5 py-2.5 text-sm font-semibold text-white">
                        Contact Us
                    </a>
                </div>
            </div>
        </aside>
    </div>
</section>

@endsection
