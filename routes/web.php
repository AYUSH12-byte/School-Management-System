<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Frontend Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn() => view('frontend.about'))->name('about');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admission', [AdmissionController::class, 'index'])->name('admission.index');
Route::post('/admission', [AdmissionController::class, 'store'])->name('admission.store');
