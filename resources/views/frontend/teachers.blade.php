@extends('layouts.app')

@section('title', 'Our Teachers')
@section('meta_description', 'Meet the passionate and experienced educators at EduManage School who inspire students every day.')

@section('content')

{{-- Page Header --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-purple-950 to-slate-900"></div>
    <div class="absolute top-20 left-1/4 w-72 h-72 bg-purple-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl"></div>
    <div class="relative max-w-4xl mx-auto text-center">
        <span class="inline-block bg-purple-500/20 text-purple-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-purple-500/30">Our Faculty</span>
        <h1 class="text-5xl font-bold text-white mb-4">Meet Our <span class="gradient-text">Expert Teachers</span></h1>
        <p class="text-slate-400 max-w-xl mx-auto">Passionate educators dedicated to shaping the future, one student at a time.</p>
    </div>
</section>

<section class="relative py-16 px-4 min-h-screen">
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950 to-slate-900"></div>
    <div class="relative max-w-7xl mx-auto">

        {{-- Filter by Department --}}
        <div class="glass rounded-2xl p-6 mb-10">
            <form method="GET" action="{{ route('teachers.index') }}" class="flex flex-col md:flex-row gap-4 items-center">
                <span class="text-slate-400 text-sm font-medium whitespace-nowrap">Filter by Department:</span>
                <div class="flex flex-wrap gap-3 flex-1">
                    <a href="{{ route('teachers.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ !$selectedDept ? 'btn-primary text-white' : 'glass text-slate-300 hover:text-white' }}">
                        All
                    </a>
                    @foreach($departments as $dept)
                        <a href="{{ route('teachers.index', ['department' => $dept->id]) }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ $selectedDept == $dept->id ? 'btn-primary text-white' : 'glass text-slate-300 hover:text-white' }}">
                            {{ $dept->name }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        {{-- Teachers Grid --}}
        @if($teachers->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($teachers as $teacher)
                    <div class="card group relative overflow-hidden rounded-2xl hover:scale-105 transition-all duration-300">
                        {{-- Photo --}}
                        <div class="relative h-64 overflow-hidden">
                            @if($teacher->image)
                                <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-700 to-indigo-800 flex items-center justify-center">
                                    <span class="text-6xl font-bold text-white/30">{{ substr($teacher->name, 0, 1) }}</span>
                                </div>
                            @endif
                            {{-- Overlay on hover --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent opacity-60 group-hover:opacity-80 transition-all duration-300"></div>

                            {{-- Department badge --}}
                            @if($teacher->department)
                                <div class="absolute top-3 left-3">
                                    <span class="bg-purple-600/90 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $teacher->department->name }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-1 group-hover:text-purple-300 transition-colors">{{ $teacher->name }}</h3>

                            @if($teacher->qualification)
                                <p class="text-purple-400 text-sm font-medium mb-2">{{ $teacher->qualification }}</p>
                            @endif

                            @if($teacher->bio)
                                <p class="text-slate-400 text-sm line-clamp-2 mb-4">{{ $teacher->bio }}</p>
                            @endif

                            {{-- Contact info --}}
                            <div class="flex flex-col gap-1.5 border-t border-slate-700 pt-4">
                                @if($teacher->email)
                                    <a href="mailto:{{ $teacher->email }}" class="flex items-center gap-2 text-slate-400 hover:text-purple-300 text-xs transition-colors">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $teacher->email }}
                                    </a>
                                @endif
                                @if($teacher->phone)
                                    <a href="tel:{{ $teacher->phone }}" class="flex items-center gap-2 text-slate-400 hover:text-purple-300 text-xs transition-colors">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ $teacher->phone }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center">
                {{ $teachers->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-400 mb-2">No teachers found</h3>
                <p class="text-slate-500 mb-6">Try selecting a different department.</p>
                <a href="{{ route('teachers.index') }}" class="btn-primary text-white font-semibold px-6 py-3 rounded-xl">View All Teachers</a>
            </div>
        @endif

    </div>
</section>

@endsection
