<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       
        $teachers = Teacher::latest()->get();
    
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses = Course::latest()->get();
        return view('admin.teachers.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'course_id' => 'required',
			'phone' => 'required'
		]);
        $requestData = $request->except(['course_id']);
        
        $teacher=Teacher::create($requestData);
        
        $teacher->courses()->attach($request->course_id);
        return redirect('admin/teachers')->with('flash_message', 'O`qituvchi qo`shildi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $course_ids=$teacher->courses->pluck('id')->toArray();
        $courses = Course::latest()->get();
        return view('admin.teachers.edit', compact('teacher', 'courses', 'course_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required',
			'course_id' => 'required',
			'phone' => 'required'
		]);
        $requestData = $request->except(['course_id']);
        
        $teacher = Teacher::findOrFail($id);
        $teacher->update($requestData);
        $teacher->courses()->sync($request->course_id);
        return redirect('admin/teachers')->with('flash_message', 'O`qituvchi yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Teacher::destroy($id);

        return redirect('admin/teachers')->with('flash_message', 'O`qituvchi o`chirib yuborildi!');
    }
}
