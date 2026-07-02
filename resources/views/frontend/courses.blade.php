@extends('layouts.app')

@section('title', 'Our Courses')
@section('meta_description', 'Browse all courses offered at EduManage School — filter by department, level, and more.')

@section('content')
<section class="relative py-20 px-4 overflow-hidden">
    <div class="absolute top-0 left-1/3 w-80 h-80 bg-blue-600/8 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="badge glass border border-blue-500/30 text-blue-300 mb-4 inline-block">All Programs</span>
            <h1 class="text-5xl font-bold text-white mb-4">Explore Our <span class="gradient-text">Courses</span></h1>
            <p class="text-slate-400 max-w-xl mx-auto">Find the perfect program to kickstart or advance your career.</p>
        </div>

        {{-- Search & Filter --}}
        <div class="glass rounded-2xl p-6 mb-8">
            <form method="GET" action="{{ route('courses.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search courses..."
                           class="form-input w-full pl-10 pr-4 py-3 rounded-xl text-sm">
                </div>
                <select name="department" class="form-input px-4 py-3 rounded-xl text-sm md:w-56">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $selectedDept == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary text-white font-semibold px-6 py-3 rounded-xl text-sm whitespace-nowrap">
                    Search
                </button>
                @if($search || $selectedDept)
                    <a href="{{ route('courses.index') }}" class="btn-outline text-white font-semibold px-4 py-3 rounded-xl text-sm whitespace-nowrap text-center">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- Courses Grid --}}
        @if($courses->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="glass rounded-2xl overflow-hidden card-hover group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.src='https://via.placeholder.com/400x200/1e3a8a/60a5fa?text={{ urlencode($course->title) }}'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute top-3 left-3">
                                <span class="badge {{ match($course->level) { 'beginner'=>'bg-green-500/20 border border-green-500/40 text-green-300', 'intermediate'=>'bg-yellow-500/20 border border-yellow-500/40 text-yellow-300', default=>'bg-red-500/20 border border-red-500/40 text-red-300' } }}">
                                    {{ ucfirst($course->level) }}
                                </span>
                            </div>
                            <div class="absolute bottom-3 right-3">
                                <span class="glass text-white text-sm font-semibold px-3 py-1 rounded-lg">
                                    {{ $course->fee > 0 ? 'NPR '.number_format($course->fee) : 'Free' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            @if($course->department)
                                <span class="text-xs text-blue-400 font-medium">{{ $course->department->name }}</span>
                            @endif
                            <h3 class="font-bold text-white text-lg mt-1 mb-2 group-hover:text-blue-400 transition-colors">
                                {{ $course->title }}
                            </h3>
                            <p class="text-slate-400 text-sm line-clamp-2 mb-4">{{ $course->description }}</p>
                            <div class="flex items-center justify-between border-t border-white/10 pt-4">
                                <div class="flex items-center space-x-3 text-xs text-slate-500">
                                    @if($course->duration) <span>⏱️ {{ $course->duration }}</span> @endif
                                    @if($course->seats) <span>• 👥 {{ $course->seats }} seats</span> @endif
                                </div>
                                <a href="{{ route('courses.show', $course) }}" class="btn-primary text-white text-xs font-semibold px-4 py-2 rounded-lg">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">{{ $courses->links() }}</div>
        @else
            <div class="text-center py-20">
                <div class="text-6xl mb-4">📚</div>
                <h3 class="text-xl font-bold text-white mb-2">No courses found</h3>
                <p class="text-slate-400">Try adjusting your search or filter.</p>
            </div>
        @endif
    </div>
</section>
@endsection
