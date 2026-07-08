<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $departments = Department::where('is_active', true)->get();
        $selectedDept = request('department');

        $teachers = Teacher::with('department')
            ->where('is_active', true)
            ->when($selectedDept, fn($q) => $q->where('department_id', $selectedDept))
            ->paginate(12);

        return view('frontend.teachers', compact('teachers', 'departments', 'selectedDept'));
    }
}
