<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools=School::withCount('students')->get();
        return view('admin.schools.index', compact('schools'));
    }
    public function detail(School $school)
    {
        $school->loadCount('students', 'teachers', 'courses');
        return view('admin.schools.detail', compact('school'));
    }


    public function activate($id)
    {
        $school=School::find($id);
        $school->status=$school->status==1 ? 0 : 1;
        $school->save();

        return back()->with('message', 'Status yangilandi!');
    }
}
