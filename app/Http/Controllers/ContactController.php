<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

//ContactController handles the logic for managing contact form submissions in the school management system.
class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Thank you! Your message has been sent. We will get back to you soon.');
    }
}
