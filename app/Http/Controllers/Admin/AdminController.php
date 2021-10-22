<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $number_schools=School::all()->count();
        $number_students=Student::all()->count();
        return view('admin.dashboard', compact('number_schools', 'number_students'));
    }
}
