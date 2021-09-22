<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Events\SchoolUserCreated;
class SchoolController extends Controller
{
    public function index()
    {
        $schools=School::all();
        return view('admin.schools.index', compact('schools'));
    }

    public function activate($id)
    {
        $school=School::find($id);
        $school->status=1;
        $school->save();
        event(new SchoolUserCreated($school));
        return back();
    }
}
