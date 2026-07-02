@extends('layouts.app')

@section('title', 'About Us')
@section('meta_description', 'Learn about EduManage School — our mission, vision, values and history of excellence in education.')

@section('content')
{{-- Page Header --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-80 h-80 bg-blue-600/8 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-purple-600/8 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto text-center">
        <span class="badge glass border border-blue-500/30 text-blue-300 mb-4 inline-block">About Us</span>
        <h1 class="text-5xl font-bold text-white mb-6">Our <span class="gradient-text">Story & Mission</span></h1>
        <p class="text-xl text-slate-400 leading-relaxed">
            Founded with a vision to provide world-class education, EduManage School has been shaping futures and building leaders for over two decades.
        </p>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="glass rounded-2xl p-8 card-hover">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white mb-4">Our Mission</h2>
            <p class="text-slate-400 leading-relaxed">
                To provide high-quality, accessible education that empowers every student to discover their potential, develop critical thinking skills, and contribute meaningfully to society. We believe education is the most powerful tool for personal and societal transformation.
            </p>
        </div>
        <div class="glass rounded-2xl p-8 card-hover">
            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-pink-600 rounded-xl flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white mb-4">Our Vision</h2>
            <p class="text-slate-400 leading-relaxed">
                To be the region's leading institution of excellence — recognized for innovative pedagogy, inclusive learning environments, and graduates who lead with integrity, creativity, and compassion in every sector of society.
            </p>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white">Our Core <span class="gradient-text">Values</span></h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['🎯', 'Excellence', 'We set high standards and strive for excellence in everything we do.', 'from-blue-500 to-cyan-500'],
                ['🤝', 'Integrity', 'Honesty and transparency guide all our actions and decisions.', 'from-purple-500 to-pink-500'],
                ['💡', 'Innovation', 'We embrace new ideas and technologies to enhance learning.', 'from-orange-500 to-red-500'],
                ['🌍', 'Inclusivity', 'Every student deserves equal opportunity and support to thrive.', 'from-green-500 to-teal-500'],
            ] as [$icon, $title, $desc, $gradient])
                <div class="glass rounded-2xl p-6 text-center card-hover">
                    <div class="w-14 h-14 bg-gradient-to-br {{ $gradient }} rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl">
                        {{ $icon }}
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">{{ $title }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="glass rounded-3xl p-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-purple-600/5"></div>
            <div class="relative grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="badge glass border border-blue-500/30 text-blue-300 mb-4 inline-block">Why EduManage</span>
                    <h2 class="text-3xl font-bold text-white mb-6">Why Choose <span class="gradient-text">Our School?</span></h2>
                    <ul class="space-y-4">
                        @foreach([
                            'Experienced faculty with industry expertise',
                            'Modern labs, library, and digital resources',
                            'Scholarship and financial aid programs',
                            'Strong alumni network and career support',
                            'Extracurricular activities and sports',
                            'Safe, inclusive campus environment',
                        ] as $point)
                            <li class="flex items-center space-x-3 text-slate-300">
                                <div class="w-5 h-5 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admission.index') }}" class="btn-primary text-white font-semibold px-8 py-3 rounded-xl inline-block mt-8">
                        Apply Today
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['20+', 'Years of Excellence'],
                        ['98%', 'Student Satisfaction'],
                        ['500+', 'Graduates Placed'],
                        ['15+', 'Industry Partners'],
                    ] as [$num, $label])
                        <div class="stat-card rounded-2xl p-6 text-center">
                            <div class="text-3xl font-bold gradient-text">{{ $num }}</div>
                            <div class="text-slate-400 text-sm mt-2">{{ $label }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
