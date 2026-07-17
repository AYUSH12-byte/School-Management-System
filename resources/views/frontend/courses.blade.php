@extends('layouts.app')

@section('title', 'Our Courses')
@section('meta_description', 'Browse all courses offered at EduManage School — filter by department, level, and more.')

@section('content')
<section class="relative py-20 px-4 overflow-visible">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="inline-block mb-4 text-xs font-semibold uppercase tracking-widest text-primary-500 bg-primary-50 border border-primary-200 px-4 py-1.5 rounded-full">All Programs</span>
            <h1 class="text-5xl font-bold text-slate-900 mb-4">Explore Our <span class="gradient-text">Courses</span></h1>
            <p class="text-slate-500 max-w-xl mx-auto">Find the perfect program to kickstart or advance your career.</p>
        </div>

        {{-- Search & Filter --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('courses.index') }}" class="flex flex-col gap-5">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search courses..."
                               class="form-input w-full pl-10 pr-4 py-3 rounded-xl text-sm">
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="btn-primary text-white font-semibold px-6 py-3 rounded-xl text-sm whitespace-nowrap flex-1 md:flex-none">
                            Search
                        </button>
                        @if($search || $selectedDept)
                            <a href="{{ route('courses.index') }}" class="btn-outline font-semibold px-4 py-3 rounded-xl text-sm whitespace-nowrap text-center">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Department Filters --}}
                <div class="flex flex-col md:flex-row md:items-center gap-3 pt-4 border-t border-slate-200">
                    <span class="text-slate-500 text-sm font-semibold whitespace-nowrap">Filter by Department:</span>
                    <input type="hidden" name="department" id="department-input" value="{{ $selectedDept }}">
                    <div class="flex flex-wrap gap-2.5">
                        <button type="button" data-dept-id=""
                                class="dept-filter-btn px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 {{ !$selectedDept ? 'btn-primary text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                            All
                        </button>
                        @foreach($departments as $dept)
                            <button type="button" data-dept-id="{{ $dept->id }}"
                                    class="dept-filter-btn px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 {{ $selectedDept == $dept->id ? 'btn-primary text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                                {{ $dept->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        {{-- Courses Grid --}}
        @if($courses->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm card-hover group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.src='https://via.placeholder.com/400x200/1e3a8a/60a5fa?text={{ urlencode($course->title) }}'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute top-3 left-3">
                                <span class="badge {{ match($course->level) { 'beginner'=>'bg-green-100 border border-green-300 text-green-700', 'intermediate'=>'bg-yellow-100 border border-yellow-300 text-yellow-700', default=>'bg-red-100 border border-red-300 text-red-700' } }}">
                                    {{ ucfirst($course->level) }}
                                </span>
                            </div>
                            <div class="absolute bottom-3 right-3">
                                <span class="bg-white/90 backdrop-blur-sm text-slate-800 text-sm font-semibold px-3 py-1 rounded-lg">
                                    {{ $course->fee > 0 ? 'NPR '.number_format($course->fee) : 'Free' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            @if($course->department)
                                <span class="text-xs text-primary-500 font-medium">{{ $course->department->name }}</span>
                            @endif
                            <h3 class="font-bold text-slate-900 text-lg mt-1 mb-2 group-hover:text-primary-500 transition-colors">
                                {{ $course->title }}
                            </h3>
                            <p class="text-slate-500 text-sm line-clamp-2 mb-4">{{ $course->description }}</p>
                            <div class="flex items-center justify-between border-t border-slate-200 pt-4">
                                <div class="flex items-center space-x-3 text-xs text-slate-400">
                                    @if($course->duration) <span> {{ $course->duration }}</span> @endif
                                    @if($course->seats) <span> {{ $course->seats }} seats</span> @endif
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
                <div class="text-6xl mb-4"></div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No courses found</h3>
                <p class="text-slate-500">Try adjusting your search or filter.</p>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    (function(){
        const deptButtons = document.querySelectorAll('.dept-filter-btn');
        const input = document.getElementById('department-input');
        const form = input ? input.closest('form') : null;

        if(!input || !form) return;

        deptButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                input.value = btn.getAttribute('data-dept-id');
                form.submit();
            });
        });
    })();
</script>
@endpush
