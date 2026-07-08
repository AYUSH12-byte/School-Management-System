<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Teacher;

 //HomeController handles the logic for the home page of the school management system.
 
class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::with(['department', 'teacher'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $featuredTeachers = Teacher::with('department')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(4)
            ->get();

        $latestNews = News::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $stats = [
            'students'    => \App\Models\Student::count(),
            'teachers'    => Teacher::where('is_active', true)->count(),
            'courses'     => Course::where('is_active', true)->count(),
            'departments' => Department::where('is_active', true)->count(),
        ];

        $galleryImages = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        return view('frontend.home', compact(
            'featuredCourses', 'featuredTeachers', 'latestNews', 'stats', 'galleryImages'
        ));
    }
}
