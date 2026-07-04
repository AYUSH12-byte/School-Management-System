@extends('layouts.app')

@section('title', 'Photo Gallery')
@section('meta_description', 'Explore the photo gallery of EduManage School — capturing moments of learning, events, and campus life.')

@section('content')

{{-- Page Header --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-emerald-950 to-slate-900"></div>
    <div class="absolute top-20 left-1/4 w-72 h-72 bg-emerald-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-teal-600/10 rounded-full blur-3xl"></div>
    <div class="relative max-w-4xl mx-auto text-center">
        <span class="inline-block bg-emerald-500/20 text-emerald-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-emerald-500/30">School Life</span>
        <h1 class="text-5xl font-bold text-white mb-4">Our <span class="gradient-text">Photo Gallery</span></h1>
        <p class="text-slate-400 max-w-xl mx-auto">Moments from classrooms, events, sports, and campus life at EduManage School.</p>
    </div>
</section>

<section class="relative py-16 px-4 min-h-screen">
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950 to-slate-900"></div>
    <div class="relative max-w-7xl mx-auto">

        {{-- Category Filter --}}
        @if($categories->count())
            <div class="glass rounded-2xl p-5 mb-10">
                <div class="flex flex-wrap gap-3 items-center">
                    <span class="text-slate-400 text-sm font-medium">Filter:</span>
                    <a href="{{ route('gallery.index') }}"
                       class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ !$selectedCategory ? 'btn-primary text-white' : 'glass text-slate-300 hover:text-white' }}">
                        All Photos
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('gallery.index', ['category' => $cat]) }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold capitalize transition-all duration-200 {{ $selectedCategory === $cat ? 'btn-primary text-white' : 'glass text-slate-300 hover:text-white' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Image Grid with Lightbox --}}
        @if($images->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-12" id="gallery-grid">
                @foreach($images as $index => $image)
                    <div class="gallery-item group relative overflow-hidden rounded-2xl cursor-pointer aspect-square"
                         onclick="openLightbox({{ $index }}, '{{ asset('storage/' . $image->image) }}', '{{ addslashes($image->title ?? '') }}')">
                        @if($image->image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->title ?? 'Gallery image' }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-4">
                            @if($image->title)
                                <p class="text-white font-semibold text-sm leading-snug">{{ $image->title }}</p>
                            @endif
                            @if($image->category)
                                <span class="text-emerald-400 text-xs mt-1 capitalize">{{ $image->category }}</span>
                            @endif
                            <div class="mt-2">
                                <div class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center">
                {{ $images->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-400 mb-2">No images is found</h3>
                <p class="text-slate-500">Gallery images will appear here once uploaded.</p>
            </div>
        @endif

    </div>
</section>

{{-- Lightbox Modal --}}
<div id="lightbox" class="fixed inset-0 z-[9999] flex items-center justify-center hidden" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/90 backdrop-blur-md" onclick="closeLightbox()"></div>
    <div class="relative z-10 max-w-5xl w-full mx-4">
        {{-- Close Button --}}
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white/70 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="bg-slate-900 rounded-2xl overflow-hidden shadow-2xl">
            <img id="lightbox-img" src="" alt="" class="w-full max-h-[75vh] object-contain">
            <div class="p-4 flex items-center justify-between">
                <p id="lightbox-caption" class="text-white font-semibold"></p>
                <div class="flex gap-3">
                    <button onclick="prevImage()" class="glass text-white px-4 py-2 rounded-xl text-sm hover:text-emerald-300 transition-colors">
                        ← Prev
                    </button>
                    <button onclick="nextImage()" class="glass text-white px-4 py-2 rounded-xl text-sm hover:text-emerald-300 transition-colors">
                        Next →
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const galleryItems = document.querySelectorAll('.gallery-item');
    const images = [
        @foreach($images as $image)
            { src: '{{ asset('storage/' . $image->image) }}', title: '{{ addslashes($image->title ?? '') }}' },
        @endforeach
    ];
    let currentIndex = 0;

    function openLightbox(index, src, title) {
        currentIndex = index;
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').textContent = title;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateLightbox();
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        updateLightbox();
    }

    function updateLightbox() {
        const img = images[currentIndex];
        document.getElementById('lightbox-img').src = img.src;
        document.getElementById('lightbox-caption').textContent = img.title;
    }

    document.addEventListener('keydown', (e) => {
        if (document.getElementById('lightbox').classList.contains('hidden')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });
</script>
@endpush

@endsection
