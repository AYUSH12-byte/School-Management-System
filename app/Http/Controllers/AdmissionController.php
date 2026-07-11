<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Course;
use Illuminate\Http\Request;

//AdmissionController handles the logic for managing admission applications in the school management system.

class AdmissionController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)->orderBy('title')->get();
        return view('frontend.admission', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|max:150',
            'phone'           => 'required|string|max:20',
            'address'         => 'nullable|string|max:250',
            'dob'             => 'nullable|date',
            'gender'          => 'nullable|in:male,female,other',
            'course_id'       => 'required|exists:courses,id',
            'previous_school' => 'nullable|string|max:200',
            'qualification'   => 'nullable|string|max:150',
            'message'         => 'nullable|string',
        ]);

        Admission::create($validated);

        return back()->with('success', 'Your admission application has been submitted! We will review and contact you shortly.');
    }
}
