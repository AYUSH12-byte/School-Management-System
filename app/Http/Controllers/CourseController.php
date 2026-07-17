<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;

//courseController handles the logic for displaying courses in the school management system.

class CourseController extends Controller
{
    public function index()
    {
        $departments = Department::where('is_active', true)->get();
        $selectedDept = request('department');
        $search = request('search');

        $courses = Course::with(['department', 'teacher'])
            ->where('is_active', true)
            ->when($selectedDept, fn($q) => $q->where('department_id', $selectedDept))
            ->when($search, fn($q) => $q->where(fn($subQuery) => $subQuery->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")))
            ->paginate(9);

        return view('frontend.courses', compact('courses', 'departments', 'selectedDept', 'search'));
    }

    public function show(Course $course)
    {
        $course->load(['department', 'teacher']);
        $related = Course::where('department_id', $course->department_id)
            ->where('id', '!=', $course->id)
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('frontend.course-detail', compact('course', 'related'));
    }
}
