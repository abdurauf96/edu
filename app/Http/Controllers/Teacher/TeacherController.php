<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function students()
    {
        return view('teacher.students');
    }

    public function profil()
    {
        $courses=Course::all();
        $course_ids=auth()->guard('teacher')->user()->courses->pluck('id')->toArray();
        return view('teacher.profil', compact('courses', 'course_ids'));
    }
}
