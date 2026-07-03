@extends('layouts.app')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with EduManage School. We are happy to answer your questions about admissions, courses, and more.')

@section('content')

{{-- Page Header --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-cyan-950 to-slate-900"></div>
    <div class="absolute top-20 right-1/4 w-72 h-72 bg-cyan-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
    <div class="relative max-w-4xl mx-auto text-center">
        <span class="inline-block bg-cyan-500/20 text-cyan-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-cyan-500/30">Get In Touch</span>
        <h1 class="text-5xl font-bold text-white mb-4">Contact <span class="gradient-text">Our Team</span></h1>
        <p class="text-slate-400 max-w-xl mx-auto">We're here to help. Send us a message and we'll respond within 24 hours.</p>
    </div>
</section>

<section class="relative py-16 px-4">
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950 to-slate-900"></div>
    <div class="relative max-w-6xl mx-auto grid lg:grid-cols-3 gap-10">

        {{-- Contact Info Cards --}}
        <div class="lg:col-span-1 flex flex-col gap-6">
            <div class="card p-6 rounded-2xl group hover:scale-[1.02] transition-all duration-300">
                <div class="w-12 h-12 bg-purple-600/20 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600/30 transition-colors">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-white font-bold mb-1">Our Location</h3>
                <p class="text-slate-400 text-sm leading-relaxed">EduManage School, Jhapa, Nepal<br>Near Central Park, Ward No. 5</p>
            </div>

            <div class="card p-6 rounded-2xl group hover:scale-[1.02] transition-all duration-300">
                <div class="w-12 h-12 bg-cyan-600/20 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600/30 transition-colors">
                    <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-white font-bold mb-1">Phone</h3>
                <p class="text-slate-400 text-sm">+977-01-4567890</p>
                <p class="text-slate-400 text-sm">+977-9800000000</p>
            </div>

            <div class="card p-6 rounded-2xl group hover:scale-[1.02] transition-all duration-300">
                <div class="w-12 h-12 bg-emerald-600/20 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600/30 transition-colors">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-white font-bold mb-1">Email</h3>
                <p class="text-slate-400 text-sm">info@edumanage.com</p>
                <p class="text-slate-400 text-sm">admin@edumanage.com</p>
            </div>

            <div class="card p-6 rounded-2xl group hover:scale-[1.02] transition-all duration-300">
                <div class="w-12 h-12 bg-amber-600/20 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-600/30 transition-colors">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-white font-bold mb-1">Office Hours</h3>
                <p class="text-slate-400 text-sm">Sun – Fri: 7:00 AM – 5:00 PM</p>
                <p class="text-slate-400 text-sm">Saturday: Closed</p>
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="lg:col-span-2">
            <div class="card p-8 rounded-2xl">
                <h2 class="text-2xl font-bold text-white mb-2">Send a Message</h2>
                <p class="text-slate-400 mb-8">Fill out the form below and we'll get back to you as soon as possible.</p>

                {{-- Flash Success --}}
                @if(session('success'))
                    <div class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl p-4 mb-6 flex items-start gap-3">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" id="contact-form">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-5 mb-5">
                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-300 mb-1.5">Full Name <span class="text-red-400">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   placeholder="Your full name"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm @error('name') border-red-500/50 @enderror">
                            @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">Email Address <span class="text-red-400">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   placeholder="your@email.com"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm @error('email') border-red-500/50 @enderror">
                            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5 mb-5">
                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-300 mb-1.5">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="+977 98XXXXXXXX"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-300 mb-1.5">Subject <span class="text-red-400">*</span></label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                   placeholder="What is this regarding?"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm @error('subject') border-red-500/50 @enderror">
                            @error('subject') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Message --}}
                    <div class="mb-7">
                        <label for="message" class="block text-sm font-medium text-slate-300 mb-1.5">Message <span class="text-red-400">*</span></label>
                        <textarea id="message" name="message" rows="6"
                                  placeholder="Write your message here..."
                                  class="form-input w-full px-4 py-3 rounded-xl text-sm resize-none @error('message') border-red-500/50 @enderror">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" id="contact-submit"
                            class="btn-primary w-full text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 hover:gap-3 transition-all">
                        <span>Send Message</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
