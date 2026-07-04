<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'EduManage School – Quality Education for a Better Future')">
    <title>@yield('title', 'Home') | EduManage School</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        outfit: ['Outfit', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eef5ff',
                            100: '#d9e8ff',
                            200: '#bbd4ff',
                            300: '#8ab6ff',
                            400: '#518fff',
                            500: '#2563eb',
                            600: '#1d4ed8',
                            700: '#1e40af',
                            800: '#1e3a8a',
                            900: '#1e3463',
                        },
                        accent: {
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        * { font-family: 'Outfit', sans-serif; }
        body { background: #0a0f1e; color: #e2e8f0; overflow-x: hidden; }

        /* Glassmorphism */
        .glass {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .glass-dark {
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.06);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #60a5fa, #a78bfa, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .gradient-text-gold {
            background: linear-gradient(135deg, #fbbf24, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animated background */
        .animated-bg {
            background: linear-gradient(135deg, #0a0f1e 0%, #0f1a35 50%, #0a0f1e 100%);
        }
        .animated-bg::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200vw;
            height: 200vh;
            z-index: -1;
            pointer-events: none;
            background: radial-gradient(ellipse at center, rgba(37,99,235,0.08) 0%, transparent 60%);
            animation: pulse-bg 8s ease-in-out infinite;
        }
        @keyframes pulse-bg {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
        }

        /* Glow effects */
        .glow-blue { box-shadow: 0 0 30px rgba(37,99,235,0.3); }
        .glow-accent { box-shadow: 0 0 30px rgba(249,115,22,0.3); }

        /* Card hover */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(37,99,235,0.25), 0 0 20px rgba(167, 139, 250, 0.1) inset;
            border-color: rgba(96, 165, 250, 0.3);
        }

        /* Nav */
        .nav-link {
            position: relative;
            transition: color 0.3s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #60a5fa, #a78bfa);
            transition: width 0.3s;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }
        .btn-primary:hover::before { left: 100%; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(37,99,235,0.4); }

        .btn-outline {
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.4);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0f1e; }
        ::-webkit-scrollbar-thumb { background: #2563eb; border-radius: 3px; }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-fade-up { animation: fadeInUp 0.6s ease forwards; }
        .animate-float { animation: float 4s ease-in-out infinite; }

        /* Stats counter */
        .stat-card {
            background: linear-gradient(135deg, rgba(37,99,235,0.15), rgba(124,58,237,0.1));
            border: 1px solid rgba(37,99,235,0.2);
        }

        /* Badge */
        .badge {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 100px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* Divider */
        .divider-gradient {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99,102,241,0.5), transparent);
        }

        /* Input focus */
        .form-input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s;
            color: #e2e8f0;
        }
        .form-input:focus {
            outline: none;
            border-color: #2563eb;
            background: rgba(37,99,235,0.08);
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }
        .form-input::placeholder { color: rgba(255,255,255,0.3); }

        /* Lightbox overlay */
        #lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.92);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        #lightbox.active { display: flex; }
    </style>

    @stack('styles')
</head>
<body class="animated-bg min-h-screen">

    <!-- Navigation -->
    <nav class="glass-dark fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center glow-blue transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-lg font-bold gradient-text">EduManage</span>
                        <span class="block text-xs text-slate-400 leading-none">School</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center space-x-8">
                    @php
                        $navLinks = [
                            ['Home', route('home'), 'home'],
                            ['About', route('about'), 'about'],
                            ['Courses', route('courses.index'), 'courses'],
                            ['Teachers', route('teachers.index'), 'teachers'],
                            ['News', route('news.index'), 'news'],
                            ['Gallery', route('gallery.index'), 'gallery'],
                            ['Contact', route('contact.index'), 'contact'],
                        ];
                    @endphp
                    @foreach($navLinks as [$label, $url, $name])
                        <a href="{{ $url }}" class="nav-link text-sm font-medium text-slate-300 hover:text-white {{ request()->routeIs($name.'*') ? 'text-white active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <!-- CTA -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('admission.index') }}" class="btn-primary text-white text-sm font-semibold px-5 py-2.5 rounded-xl">
                        Apply Now
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button id="mobile-toggle" class="md:hidden p-2 rounded-lg glass text-slate-300">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/10 pb-4">
            <div class="px-4 pt-4 space-y-2">
                @foreach($navLinks as [$label, $url, $name])
                    <a href="{{ $url }}" class="block py-2.5 px-4 rounded-lg text-slate-300 hover:text-white hover:bg-white/10 transition-all text-sm font-medium {{ request()->routeIs($name.'*') ? 'bg-blue-600/20 text-white' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
                <a href="{{ route('admission.index') }}" class="block btn-primary text-white text-sm font-semibold px-4 py-3 rounded-xl text-center mt-2">
                    Apply Now
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16 md:pt-20">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 pt-4">
                <div class="glass border border-green-500/30 bg-green-500/10 rounded-xl p-4 flex items-center space-x-3">
                    <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-300 text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="glass-dark border-t border-white/10 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold gradient-text">EduManage School</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                        Empowering students with quality education, modern curriculum, and experienced faculty. Building tomorrow's leaders today.
                    </p>
                    <div class="flex space-x-3 mt-6">
                        @foreach(['M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z', 'M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z', 'M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z M4 6a2 2 0 100-4 2 2 0 000 4z'] as $path)
                            <a href="#" class="w-9 h-9 glass rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600/30 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        @foreach([['About Us', 'about'], ['Courses', 'courses.index'], ['Teachers', 'teachers.index'], ['Admission', 'admission.index'], ['Contact', 'contact.index']] as [$label, $route])
                            <li>
                                <a href="{{ route($route) }}" class="text-slate-400 text-sm hover:text-blue-400 transition-colors flex items-center space-x-2">
                                    <span class="w-1 h-1 rounded-full bg-blue-500"></span>
                                    <span>{{ $label }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3 text-slate-400 text-sm">
                            <svg class="w-4 h-4 mt-0.5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Birtamod, Jhapa Nepal</span>
                        </li>
                        <li class="flex items-center space-x-3 text-slate-400 text-sm">
                            <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>ayu93858@gmail.com</span>
                        </li>
                        <li class="flex items-center space-x-3 text-slate-400 text-sm">
                            <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+977 9702837012</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="divider-gradient my-10"></div>
            <div class="flex flex-col md:flex-row items-center justify-between text-slate-500 text-sm">
                <p>© {{ date('Y') }} EduManage School. All rights reserved.</p>
                <p class="mt-2 md:mt-0">Built with ❤️ using Laravel & Filament</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const toggle = document.getElementById('mobile-toggle');
        const menu = document.getElementById('mobile-menu');
        toggle.addEventListener('click', () => menu.classList.toggle('hidden'));

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(10,15,30,0.95)';
                navbar.classList.add('shadow-lg', 'shadow-blue-500/10');
            } else {
                navbar.style.background = '';
                navbar.classList.remove('shadow-lg', 'shadow-blue-500/10');
            }
        });
    </script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    </script>

    @stack('scripts')
</body>
</html>
