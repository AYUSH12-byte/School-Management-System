@extends('layouts.app')

@section('title', 'Apply for Admission')
@section('meta_description', 'Apply for admission at EduManage School. Fill out the online application form to begin your journey.')

@section('content')

{{-- Page Header --}}
<section class="relative py-24 px-4 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-violet-950 to-slate-900"></div>
    <div class="absolute top-20 left-1/4 w-72 h-72 bg-violet-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="relative max-w-4xl mx-auto text-center">
        <span class="inline-block bg-violet-500/20 text-violet-300 text-sm font-semibold px-4 py-1.5 rounded-full mb-4 border border-violet-500/30">Join Our School</span>
        <h1 class="text-5xl font-bold text-white mb-4">Apply for <span class="gradient-text">Admission</span></h1>
        <p class="text-slate-400 max-w-xl mx-auto">Start your educational journey at EduManage School. Fill out the form below and our team will contact you.</p>
    </div>
</section>

<section class="relative py-16 px-4">
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950 to-slate-900"></div>
    <div class="relative max-w-5xl mx-auto">

        {{-- Steps Info --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
            @foreach([
                ['step' => '01', 'title' => 'Fill the Form', 'desc' => 'Complete the online application form with your details.', 'color' => 'violet'],
                ['step' => '02', 'title' => 'Get Reviewed', 'desc' => 'Our admissions team reviews your application.', 'color' => 'purple'],
                ['step' => '03', 'title' => 'Confirmation', 'desc' => 'Receive confirmation and start your journey!', 'color' => 'indigo'],
            ] as $s)
                <div class="card p-6 rounded-2xl text-center">
                    <span class="text-4xl font-black text-{{ $s['color'] }}-500/30">{{ $s['step'] }}</span>
                    <h3 class="text-white font-bold mt-2 mb-1">{{ $s['title'] }}</h3>
                    <p class="text-slate-400 text-sm">{{ $s['desc'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Application Form --}}
        <div class="card p-8 lg:p-10 rounded-2xl">
            <h2 class="text-2xl font-bold text-white mb-2">Admission Application Form</h2>
            <p class="text-slate-400 mb-8">All fields marked with <span class="text-red-400">*</span> are required.</p>

            {{-- Flash Success --}}
            @if(session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl p-5 mb-8 flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="font-semibold mb-1">Application Submitted Successfully!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admission.store') }}" id="admission-form">
                @csrf

                {{-- Section: Personal Info --}}
                <div class="mb-8">
                    <h3 class="text-white font-semibold text-lg mb-5 flex items-center gap-2">
                        <div class="w-7 h-7 bg-violet-600/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        Personal Information
                    </h3>
                    <div class="grid md:grid-cols-2 gap-5">
                        {{-- Name --}}
                        <div>
                            <label for="adm_name" class="block text-sm font-medium text-slate-300 mb-1.5">Full Name <span class="text-red-400">*</span></label>
                            <input type="text" id="adm_name" name="name" value="{{ old('name') }}"
                                   placeholder="Your full name"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm @error('name') border-red-500/50 @enderror">
                            @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="adm_email" class="block text-sm font-medium text-slate-300 mb-1.5">Email Address <span class="text-red-400">*</span></label>
                            <input type="email" id="adm_email" name="email" value="{{ old('email') }}"
                                   placeholder="your@email.com"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm @error('email') border-red-500/50 @enderror">
                            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="adm_phone" class="block text-sm font-medium text-slate-300 mb-1.5">Phone Number <span class="text-red-400">*</span></label>
                            <input type="tel" id="adm_phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="+977 98XXXXXXXX"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm @error('phone') border-red-500/50 @enderror">
                            @error('phone') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- DOB --}}
                        <div>
                            <label for="adm_dob" class="block text-sm font-medium text-slate-300 mb-1.5">Date of Birth</label>
                            <input type="date" id="adm_dob" name="dob" value="{{ old('dob') }}"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label for="adm_gender" class="block text-sm font-medium text-slate-300 mb-1.5">Gender</label>
                            <select id="adm_gender" name="gender" class="form-input w-full px-4 py-3 rounded-xl text-sm">
                                <option value="">Select gender</option>
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        {{-- Address --}}
                        <div>
                            <label for="adm_address" class="block text-sm font-medium text-slate-300 mb-1.5">Address</label>
                            <input type="text" id="adm_address" name="address" value="{{ old('address') }}"
                                   placeholder="Your current address"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>
                    </div>
                </div>

                {{-- Section: Academic Info --}}
                <div class="mb-8 pt-6 border-t border-slate-800">
                    <h3 class="text-white font-semibold text-lg mb-5 flex items-center gap-2">
                        <div class="w-7 h-7 bg-purple-600/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        Academic Information
                    </h3>
                    <div class="grid md:grid-cols-2 gap-5">
                        {{-- Course --}}
                        <div class="md:col-span-2">
                            <label for="adm_course" class="block text-sm font-medium text-slate-300 mb-1.5">Desired Course <span class="text-red-400">*</span></label>
                            <select id="adm_course" name="course_id"
                                    class="form-input w-full px-4 py-3 rounded-xl text-sm @error('course_id') border-red-500/50 @enderror">
                                <option value="">Select a course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }} @if($course->department) — {{ $course->department->name }} @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Previous School --}}
                        <div>
                            <label for="adm_school" class="block text-sm font-medium text-slate-300 mb-1.5">Previous School / Institution</label>
                            <input type="text" id="adm_school" name="previous_school" value="{{ old('previous_school') }}"
                                   placeholder="Name of your previous school"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        {{-- Qualification --}}
                        <div>
                            <label for="adm_qual" class="block text-sm font-medium text-slate-300 mb-1.5">Highest Qualification</label>
                            <input type="text" id="adm_qual" name="qualification" value="{{ old('qualification') }}"
                                   placeholder="e.g. SEE, +2, Bachelor's"
                                   class="form-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>
                    </div>
                </div>

                {{-- Message --}}
                <div class="mb-8 pt-6 border-t border-slate-800">
                    <label for="adm_message" class="block text-sm font-medium text-slate-300 mb-1.5">Additional Message / Note</label>
                    <textarea id="adm_message" name="message" rows="4"
                              placeholder="Any additional information you'd like to share..."
                              class="form-input w-full px-4 py-3 rounded-xl text-sm resize-none">{{ old('message') }}</textarea>
                </div>

                <button type="submit" id="admission-submit"
                        class="btn-primary w-full text-white font-bold py-4 rounded-xl flex items-center justify-center gap-2 hover:gap-3 transition-all text-lg">
                    <span>Submit Application</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>

                <p class="text-center text-slate-500 text-sm mt-4">
                    By submitting this form, you agree to our terms and conditions.
                </p>
            </form>
        </div>

    </div>
</section>

@endsection
