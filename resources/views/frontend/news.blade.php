@extends('layouts.app')

@section('title', 'Latest News')
@section('meta_description', 'Stay updated with the latest news, events, and announcements from EduManage School.')

@section('content')

{{-- Page Header --}}
<section class="relative py-24 px-4 overflow-hidden bg-gradient-to-br from-slate-900 via-primary-900 to-primary-800">
    <div class="relative max-w-4xl mx-auto text-center">
        <span class="inline-block bg-white/10 text-blue-200 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-white/20">School News</span>
        <h1 class="text-5xl font-bold text-white mb-4">Latest <span class="text-accent-400">News & Events</span></h1>
        <p class="text-blue-100/70 max-w-xl mx-auto">Stay informed about what's happening at EduManage School — announcements, events, and achievements.</p>
    </div>
</section>

<section class="relative py-16 px-4 min-h-screen">
    <div class="relative max-w-7xl mx-auto">

        {{-- Featured Article --}}
        @if($featured)
            <div class="mb-14">
                <h2 class="text-sm font-semibold text-primary-500 uppercase tracking-widest mb-5">Featured Story</h2>
                <a href="{{ route('news.show', $featured->slug) }}" class="block group">
                    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden grid lg:grid-cols-2 gap-0 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        {{-- Featured Image --}}
                        <div class="relative h-64 lg:h-auto overflow-hidden">
                            @if($featured->image)
                                <img src="{{ asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center min-h-60">
                                    <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-black/30 lg:block hidden"></div>
                            <span class="absolute top-4 left-4 bg-primary-600 text-white text-xs font-bold px-3 py-1 rounded-full">Featured</span>
                        </div>
                        {{-- Featured Content --}}
                        <div class="p-8 flex flex-col justify-center">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-slate-400 text-sm">{{ $featured->published_at ? $featured->published_at->format('M d, Y') : '' }}</span>
                            </div>
                            <h2 class="text-2xl lg:text-3xl font-bold text-slate-900 mb-4 group-hover:text-primary-500 transition-colors leading-snug">
                                {{ $featured->title }}
                            </h2>
                            @if($featured->excerpt)
                                <p class="text-slate-500 leading-relaxed mb-6">{{ $featured->excerpt }}</p>
                            @else
                                <p class="text-slate-500 leading-relaxed mb-6">{{ Str::limit(strip_tags($featured->body), 180) }}</p>
                            @endif
                            <span class="inline-flex items-center gap-2 text-primary-500 font-semibold text-sm group-hover:gap-3 transition-all">
                                Read Full Story
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        {{-- News Grid --}}
        @if($news->count())
            <h2 class="text-sm font-semibold text-slate-400 uppercase tracking-widest mb-6">All Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($news as $article)
                    @if($article->id !== ($featured?->id))
                        <a href="{{ route('news.show', $article->slug) }}" class="bg-white border border-slate-200 shadow-sm group rounded-2xl overflow-hidden block hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            {{-- Article Image --}}
                            <div class="relative h-48 overflow-hidden">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/55 to-transparent"></div>
                            </div>
                            {{-- Article Content --}}
                            <div class="p-5">
                                <p class="text-slate-400 text-xs mb-2">{{ $article->published_at ? $article->published_at->format('M d, Y') : '' }}</p>
                                <h3 class="text-slate-900 font-bold text-lg mb-2 group-hover:text-primary-500 transition-colors line-clamp-2 leading-snug">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-slate-500 text-sm line-clamp-3 leading-relaxed mb-4">
                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->body), 120) }}
                                </p>
                                <span class="text-primary-500 text-sm font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Read More
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center">
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-500 mb-2">No articles published yet</h3>
                <p class="text-slate-400">Check back soon for update!</p>
            </div>
        @endif

    </div>
</section>

@endsection
