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
        //$plans=CoursePlan::where('course_id', $course_id)->orderBy('order')->get();
        return view('school.plans.index', compact('course',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id)
    {
        $course=Course::findOrFail($course_id);
        return view('school.plans.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title'=>'required', 'duration'=>'required', 'order'=>'required']);
        CoursePlan::create($request->all());
        return redirect()->route('coursePlans', $request->course_id)->with('flash_message', 'Kurs rejasi kiritildi!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CoursePlan $plan)
    {
        return view('school.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoursePlan $plan)
    {
        $plan->update($request->all());
        return redirect()->route('coursePlans', $request->course_id)->with('flash_message', 'Kurs rejasi kiritildi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoursePlan $plan)
    {
        $plan->delete();
        return redirect()->back()->with('flash_message', 'Kurs rejasi o\'chirildi!');
    }
}
