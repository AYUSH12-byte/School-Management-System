@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', 'EduManage School – Quality Education for a Better Future. Explore our courses, meet our teachers, and apply for admission.')

@section('content')

{{-- HERO SECTION --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Background Orbs --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-purple-600/10 rounded-full blur-3xl animate-float" style="animation-delay:2s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <div class="animate-fade-up">
            <span class="badge glass border border-blue-500/30 text-blue-300 mb-6 inline-block">
                Welcome to EduManage School
            </span>
            <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight mb-6">
                Shaping <span class="gradient-text">Future</span><br>Leaders of Tomorrow
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed">
                World-class education with experienced faculty, modern curriculum, and a vibrant campus environment that empowers every student to excel.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('admission.index') }}" class="btn-primary text-white font-semibold px-8 py-4 rounded-xl text-base">
                    Apply for Admission →
                </a>
                <a href="{{ route('courses.index') }}" class="btn-outline text-white font-semibold px-8 py-4 rounded-xl text-base">
                    Explore Courses
                </a>
            </div>
        </div>

        {{-- Floating Stats --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-20">
            @foreach([
                ['', $stats['students'], 'Students Enrolled'],
                ['', $stats['teachers'], 'Expert Teachers'],
                ['', $stats['courses'], 'Courses Offered'],
                ['', $stats['departments'], 'Departments'],
            ] as [$icon, $count, $label])
                <div class="stat-card rounded-2xl p-6 text-center card-hover">
                    <div class="text-3xl mb-2">{{ $icon }}</div>
                    <div class="text-3xl font-bold gradient-text">{{ number_format($count) }}+</div>
                    <div class="text-slate-400 text-sm mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FEATURED COURSES --}}
@if($featuredCourses->count())
<section class="py-24 px-4" data-aos="fade-up">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="badge glass border border-blue-500/30 text-blue-300 mb-4 inline-block" data-aos="zoom-in" data-aos-delay="100">Our Programs</span>
            <h2 class="text-4xl font-bold text-white" data-aos="fade-up" data-aos-delay="200">Featured <span class="gradient-text">Courses</span></h2>
            <p class="text-slate-400 mt-4 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="300">Discover our most popular programs designed to prepare you for real-world success.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredCourses as $index => $course)
                <div class="glass rounded-2xl overflow-hidden card-hover group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.src='https://via.placeholder.com/400x200/1e40af/ffffff?text=Course'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute top-3 left-3">
                            <span class="badge {{ match($course->level) { 'beginner'=>'bg-green-500/20 border border-green-500/40 text-green-300', 'intermediate'=>'bg-yellow-500/20 border border-yellow-500/40 text-yellow-300', default=>'bg-red-500/20 border border-red-500/40 text-red-300' } }}">
                                {{ ucfirst($course->level) }}
                            </span>
                        </div>
                        @if($course->fee > 0)
                            <div class="absolute bottom-3 right-3">
                                <span class="glass text-white text-sm font-semibold px-3 py-1 rounded-lg">
                                    NPR {{ number_format($course->fee) }}
                                </span>
                            </div>
                        @else
                            <div class="absolute bottom-3 right-3">
                                <span class="glass text-green-300 text-sm font-semibold px-3 py-1 rounded-lg">Free</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <div class="flex items-center space-x-2 mb-2">
                            @if($course->department)
                                <span class="text-xs text-blue-400 font-medium">{{ $course->department->name }}</span>
                            @endif
                        </div>
                        <h3 class="font-bold text-white text-lg mb-2 group-hover:text-blue-400 transition-colors">
                            {{ $course->title }}
                        </h3>
                        <p class="text-slate-400 text-sm line-clamp-2 mb-4">{{ $course->description }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-xs text-slate-500">
                                @if($course->duration)
                                    <span>⏱️ {{ $course->duration }}</span>
                                @endif
                                @if($course->teacher)
                                    <span>• {{ $course->teacher->name }}</span>
                                @endif
                            </div>
                            <a href="{{ route('courses.show', $course) }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">
                                Learn more →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('courses.index') }}" class="btn-outline text-white font-semibold px-8 py-3 rounded-xl inline-block">
                View All Courses
            </a>
        </div>
    </div>
</section>
@endif

{{-- FEATURED TEACHERS --}}
@if($featuredTeachers->count())
<section class="py-24 px-4" data-aos="fade-up">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="badge glass border border-purple-500/30 text-purple-300 mb-4 inline-block" data-aos="zoom-in" data-aos-delay="100">Our Faculty</span>
            <h2 class="text-4xl font-bold text-white" data-aos="fade-up" data-aos-delay="200">Meet Our <span class="gradient-text">Expert Teachers</span></h2>
            <p class="text-slate-400 mt-4 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="300">Learn from the best — our faculty brings years of industry experience and academic excellence.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredTeachers as $index => $teacher)
                <div class="glass rounded-2xl p-6 text-center card-hover group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <img src="{{ $teacher->image_url }}" alt="{{ $teacher->name }}"
                             class="w-24 h-24 rounded-full object-cover border-2 border-blue-500/30 group-hover:border-blue-400 transition-colors"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}&background=1e40af&color=fff&size=96'">
                        <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full border-2 border-slate-900"></div>
                    </div>
                    <h3 class="font-bold text-white mb-1">{{ $teacher->name }}</h3>
                    <p class="text-blue-400 text-sm">{{ $teacher->designation ?? 'Instructor' }}</p>
                    @if($teacher->department)
                        <p class="text-slate-500 text-xs mt-1">{{ $teacher->department->name }}</p>
                    @endif
                    @if($teacher->experience_years > 0)
                        <div class="mt-3 glass rounded-lg px-3 py-1.5 inline-block">
                            <span class="text-xs text-slate-400">{{ $teacher->experience_years }} yrs experience</span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('teachers.index') }}" class="btn-outline text-white font-semibold px-8 py-3 rounded-xl inline-block">
                View All Teachers
            </a>
        </div>
    </div>
</section>
@endif

{{-- LATEST NEWS --}}
@if($latestNews->count())
<section class="py-24 px-4" data-aos="fade-up">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="badge glass border border-orange-500/30 text-orange-300 mb-4 inline-block" data-aos="zoom-in" data-aos-delay="100">Latest Updates</span>
            <h2 class="text-4xl font-bold text-white" data-aos="fade-up" data-aos-delay="200">School <span class="gradient-text-gold">News</span> & Events</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestNews as $index => $item)
                <article class="glass rounded-2xl overflow-hidden card-hover group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="relative h-44 overflow-hidden">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.src='https://via.placeholder.com/400x180/0f172a/60a5fa?text=News'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                    <div class="p-5">
                        <div class="text-xs text-slate-500 mb-2">
                            {{ $item->published_at?->format('M d, Y') ?? $item->created_at->format('M d, Y') }}
                            @if($item->author) • {{ $item->author }} @endif
                        </div>
                        <h3 class="font-bold text-white mb-2 group-hover:text-orange-400 transition-colors line-clamp-2">
                            {{ $item->title }}
                        </h3>
                        <p class="text-slate-400 text-sm line-clamp-2 mb-4">{{ $item->excerpt }}</p>
                        <a href="{{ route('news.show', $item) }}" class="text-orange-400 hover:text-orange-300 text-sm font-medium transition-colors">
                            Read more →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('news.index') }}" class="btn-outline text-white font-semibold px-8 py-3 rounded-xl inline-block">
                All News & Events
            </a>
        </div>
    </div>
</section>
@endif

{{-- GALLERY PREVIEW --}}
@if($galleryImages->count())
<section class="py-24 px-4" data-aos="fade-up">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="badge glass border border-pink-500/30 text-pink-300 mb-4 inline-block" data-aos="zoom-in" data-aos-delay="100">Campus Life</span>
            <h2 class="text-4xl font-bold text-white" data-aos="fade-up" data-aos-delay="200">Our <span class="gradient-text">Gallery</span></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galleryImages->take(8) as $index => $img)
                <div class="relative group overflow-hidden rounded-xl cursor-pointer aspect-square card-hover border border-white/5"
                     data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}"
                     onclick="openLightbox('{{ $img->image_url }}', '{{ $img->title }}')">
                    <img src="{{ $img->image_url }}" alt="{{ $img->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 group-hover:rotate-1 transition-all duration-700"
                         onerror="this.src='https://via.placeholder.com/300x300/1e3a8a/60a5fa?text=Photo'">
                    
                    {{-- Fixed Gallery Title Visibility --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <p class="text-white text-sm md:text-base font-semibold truncate drop-shadow-md">{{ $img->title }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('gallery.index') }}" class="btn-outline text-white font-semibold px-8 py-3 rounded-xl inline-block">
                View Full Gallery
            </a>
        </div>
    </div>
</section>
@endif

{{-- CTA SECTION --}}
<section class="py-24 px-4" data-aos="fade-up">
    <div class="max-w-4xl mx-auto text-center">
        <div class="glass rounded-3xl p-12 relative overflow-hidden card-hover">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-purple-600/20 mix-blend-overlay"></div>
            <div class="relative z-10">
                <h2 class="text-4xl font-bold text-white mb-4" data-aos="fade-up" data-aos-delay="100">Ready to Start Your <span class="gradient-text">Journey?</span></h2>
                <p class="text-slate-300 mb-8 text-lg" data-aos="fade-up" data-aos-delay="200">Join thousands of students who have transformed their lives through quality education at EduManage School.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('admission.index') }}" class="btn-primary text-white font-semibold px-8 py-4 rounded-xl text-base">
                        Apply Now — It's Free
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn-outline text-white font-semibold px-8 py-4 rounded-xl text-base">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox" onclick="closeLightbox()">
    <div class="relative max-w-4xl mx-auto px-4" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute -top-10 right-4 text-white text-2xl hover:text-gray-300">✕</button>
        <img id="lightbox-img" src="" alt="" class="max-h-[80vh] max-w-full rounded-2xl mx-auto">
        <p id="lightbox-title" class="text-white text-center mt-4 font-medium"></p>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openLightbox(src, title) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => e.key === 'Escape' && closeLightbox());
</script>
@endpush
