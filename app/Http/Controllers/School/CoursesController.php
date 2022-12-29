<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $courses = Course::school()->latest()->get();

        return view('school.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('school.courses.create');
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
			'duration' => 'required'
		]);

        $requestData = $request->all();

        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=time().$file->getClientOriginalName();
            $path='admin/images/courses';
            $file->move(public_path($path), $filename);
            $requestData['image']=$path.'/'.$filename;
        }

        Course::create($requestData);

        return redirect('school/courses')->with('flash_message', 'Kurs qo`shildi!');
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
        $course = Course::findOrFail($id);

        return view('school.courses.show', compact('course'));
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
        $course = Course::findOrFail($id);

        return view('school.courses.edit', compact('course'));
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
			'duration' => 'required'
		]);
        $requestData = $request->all();
        
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=time().$file->getClientOriginalName();
            $path='admin/images/courses';
            $file->move(public_path($path), $filename);
            $requestData['image']=$path.'/'.$filename;
        }

        $requestData['is_for_bot'] = isset($request['is_for_bot']) ? 1 : 0;
        $course = Course::findOrFail($id);
        $course->update($requestData);

        return redirect('school/courses')->with('flash_message', 'Kurs yangilandi!');
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
        Course::destroy($id);

        return redirect('school/courses')->with('flash_message', 'Kurs o`chirib yuborildi!');
    }
}
