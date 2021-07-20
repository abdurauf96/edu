<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $num_students=\App\Models\Student::all()->count();
        $num_groups=\App\Models\Group::all()->count();
        
        $girls=\App\Models\Student::whereSex('0')->count();
        $boys=\App\Models\Student::whereSex(1)->count();
        $grant_students=\App\Models\Student::whereType(1)->count();
        $active_students=\App\Models\Student::whereStatus(1)->count();
        
        $teachers=\App\Models\Teacher::with('students')->get();
        $courses=\App\Models\Course::with('students')->get();
        return view('admin.dashboard', compact('num_students', 'courses', 'num_groups', 'teachers', 'boys', 'girls', 'grant_students', 'active_students'));
    }

}
