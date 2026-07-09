<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

//GalleryController handles the logic for displaying gallery images in the school management system.

class GalleryController extends Controller
{
    public function index()
    {
        $categories = Gallery::where('is_active', true)
            ->distinct()
            ->pluck('category')
            ->filter();

        $selectedCategory = request('category');

        $images = Gallery::where('is_active', true)
            ->when($selectedCategory, fn($q) => $q->where('category', $selectedCategory))
            ->orderBy('sort_order')
            ->paginate(12);

        return view('frontend.gallery', compact('images', 'categories', 'selectedCategory'));
    }
}
