<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\Student;
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
        return view('teacher.profil');
    }

    public function groups()
    {
        return view('teacher.groups');
    }
}
