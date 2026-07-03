@extends('layouts.app')

@section('title', $course->title)
@section('meta_description', $course->description)

@section('content')
<section class="py-20 px-4">
    <div class="max-w-5xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="flex items-center space-x-2 text-sm text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('courses.index') }}" class="hover:text-white transition-colors">Courses</a>
            <span>/</span>
            <span class="text-slate-300">{{ $course->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                <div class="relative h-72 rounded-2xl overflow-hidden mb-8">
                    <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='https://via.placeholder.com/800x300/1e3a8a/60a5fa?text={{ urlencode($course->title) }}'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <span class="badge {{ match($course->level) { 'beginner'=>'bg-green-500/20 border border-green-500/40 text-green-300', 'intermediate'=>'bg-yellow-500/20 border border-yellow-500/40 text-yellow-300', default=>'bg-red-500/20 border border-red-500/40 text-red-300' } }} mb-2">
                            {{ ucfirst($course->level) }}
                        </span>
                        <h1 class="text-3xl font-bold text-white">{{ $course->title }}</h1>
                    </div>
                </div>

                @if($course->description)
                    <div class="glass rounded-2xl p-6 mb-6">
                        <h2 class="text-xl font-bold text-white mb-3">Course Overview</h2>
                        <p class="text-slate-300 leading-relaxed">{{ $course->description }}</p>
                    </div>
                @endif

                @if($course->content)
                    <div class="glass rounded-2xl p-6 prose prose-invert max-w-none">
                        {!! $course->content !!}
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Course Info --}}
                <div class="glass rounded-2xl p-6 sticky top-24">
                    <div class="text-3xl font-bold gradient-text mb-4">
                        {{ $course->fee > 0 ? 'NPR '.number_format($course->fee) : 'Free' }}
                    </div>
                    <a href="{{ route('admission.index') }}" class="btn-primary text-white font-bold px-6 py-4 rounded-xl w-full block text-center mb-6">
                        Apply for This Course
                    </a>
                    <div class="space-y-4">
                        @if($course->duration)
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-blue-400"></span>
                                <div><span class="text-slate-500">Duration:</span> <span class="text-white ml-1">{{ $course->duration }}</span></div>
                            </div>
                        @endif
                        @if($course->level)
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-blue-400"></span>
                                <div><span class="text-slate-500">Level:</span> <span class="text-white ml-1">{{ ucfirst($course->level) }}</span></div>
                            </div>
                        @endif
                        @if($course->seats)
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-blue-400"></span>
                                <div><span class="text-slate-500">Seats:</span> <span class="text-white ml-1">{{ $course->seats }}</span></div>
                            </div>
                        @endif
                        @if($course->department)
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-blue-400"></span>
                                <div><span class="text-slate-500">Dept:</span> <span class="text-white ml-1">{{ $course->department->name }}</span></div>
                            </div>
                        @endif
                        @if($course->teacher)
                            <div class="flex items-center space-x-3 text-sm">
                                <span class="text-blue-400"></span>
                                <div><span class="text-slate-500">Instructor:</span> <span class="text-white ml-1">{{ $course->teacher->name }}</span></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Courses --}}
        @if($related->count())
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-white mb-6">Related <span class="gradient-text">Courses</span></h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($related as $r)
                        <a href="{{ route('courses.show', $r) }}" class="glass rounded-2xl p-5 card-hover group block">
                            <h3 class="font-bold text-white group-hover:text-blue-400 transition-colors mb-2">{{ $r->title }}</h3>
                            <p class="text-slate-400 text-sm line-clamp-2">{{ $r->description }}</p>
                            <div class="text-blue-400 text-sm mt-3 font-medium">View details →</div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
