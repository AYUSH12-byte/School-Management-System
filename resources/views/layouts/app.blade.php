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
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#1e40af',
                            600: '#1e3a8a',
                            700: '#1a2f6d',
                            800: '#152554',
                            900: '#0f172a',
                        },
                        accent: {
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        :root{
            --bg: #ffffff;
            --bg-subtle: #f8fafc;
            --text: #1e293b;
            --text-muted: #64748b;
            --primary-400: #60a5fa;
            --primary-500: #1e40af;
            --primary-600: #1e3a8a;
            --primary-700: #1a2f6d;
            --accent-400: #fbbf24;
            --accent-500: #f59e0b;
        }
        * { font-family: 'Outfit', sans-serif; }
        body { background: var(--bg); color: var(--text); overflow-x: hidden; }

        /* Glass cards — light mode */
        .glass {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }
        .glass-dark {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary-500), var(--accent-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .gradient-text-gold {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animated background — light */
        .animated-bg {
            background: var(--bg);
        }

        /* Glow effects — subtle for light mode */
        .glow-blue { box-shadow: 0 4px 14px rgba(30,64,175,0.15); }
        .glow-accent { box-shadow: 0 4px 14px rgba(245,158,11,0.12); }

        /* Card hover */
        .card-hover {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(30,64,175,0.1), 0 4px 12px rgba(0,0,0,0.05);
            border-color: #bfdbfe;
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
            background: linear-gradient(90deg, var(--primary-500), var(--accent-500));
            transition: width 0.3s;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500), #2563eb);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-primary:hover::before { left: 100%; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30,64,175,0.3); }

        .btn-outline {
            border: 1px solid #cbd5e1;
            color: var(--text);
            transition: all 0.3s;
        }
        .btn-outline:hover {
            background: #f1f5f9;
            border-color: var(--primary-500);
            color: var(--primary-500);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-500); }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeInUp 0.6s ease forwards; }

        /* Stats counter */
        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
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
            background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
        }

        /* Input focus */
        .form-input {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
            color: #1e293b;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(30,64,175,0.1);
        }
        .form-input::placeholder { color: #94a3b8; }

        /* Lightbox overlay */
        #lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.85);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        #lightbox.active { display: flex; }
    </style>

    @stack('styles')
</head>
<body class="animated-bg min-h-screen bg-white">

    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-slate-200" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-lg font-bold gradient-text">EduManage</span>
                        <span class="block text-xs text-slate-500 leading-none">School</span>
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
                        <a href="{{ $url }}" class="nav-link text-sm font-medium text-slate-600 hover:text-primary-600 {{ request()->routeIs($name.'*') ? 'text-primary-600 active' : '' }}">
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
                <button id="mobile-toggle" class="md:hidden p-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 pb-4 bg-white">
            <div class="px-4 pt-4 space-y-2">
                @foreach($navLinks as [$label, $url, $name])
                    <a href="{{ $url }}" class="block py-2.5 px-4 rounded-lg text-slate-600 hover:text-primary-600 hover:bg-primary-50 transition-all text-sm font-medium {{ request()->routeIs($name.'*') ? 'bg-primary-50 text-primary-600' : '' }}">
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
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center space-x-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-400 to-accent-500 flex items-center justify-center">
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
                            <a href="#" class="w-9 h-9 rounded-lg border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-slate-100 font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        @foreach([['About Us', 'about'], ['Courses', 'courses.index'], ['Teachers', 'teachers.index'], ['Admission', 'admission.index'], ['Contact', 'contact.index']] as [$label, $route])
                            <li>
                                <a href="{{ route($route) }}" class="text-slate-400 text-sm hover:text-primary-300 transition-colors flex items-center space-x-2">
                                    <span class="w-1 h-1 rounded-full bg-primary-400"></span>
                                    <span>{{ $label }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-slate-100 font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3 text-slate-400 text-sm">
                            <svg class="w-4 h-4 mt-0.5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Birtamod, Jhapa Nepal</span>
                        </li>
                        <li class="flex items-center space-x-3 text-slate-400 text-sm">
                            <svg class="w-4 h-4 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>ayu93858@gmail.com</span>
                        </li>
                        <li class="flex items-center space-x-3 text-slate-400 text-sm">
                            <svg class="w-4 h-4 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+977-9702837012</span>
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
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
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
