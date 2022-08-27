<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePlan;
use App\Models\Course;
class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function plans($course_id)
    {
        $course=Course::with('plans')->findOrFail($course_id);
        return view('school.plans.index', compact('course',));
    }

}
