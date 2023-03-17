<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\WaitingStudent;
use App\Models\District;
use Illuminate\Http\Request;

class WaitingStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $courses=Course::school()->withCount('waitingStudents')->get();
        $all=WaitingStudent::all()->count();
        return view('school.waiting-students.index', compact('courses', 'all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $courses=Course::school()->get();
        $districts=District::all();
        return view('school.waiting-students.create', compact('courses', 'districts'));
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
        $requestData = $request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time() . $file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image'] = $image;
        }
        WaitingStudent::create($requestData);

        return redirect('school/waiting-students')->with('flash_message', 'O`quvchi qo`shildi!');
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
        $waitingstudent = WaitingStudent::findOrFail($id);

        return view('school.waiting-students.show', compact('waitingstudent'));
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
        $waitingstudent = WaitingStudent::findOrFail($id);
        $courses=Course::school()->get();
        $districts=District::all();
        return view('school.waiting-students.edit', compact('waitingstudent', 'courses', 'districts'));
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

        $requestData = $request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;
        }
        $waitingstudent = WaitingStudent::findOrFail($id);
        $waitingstudent->update($requestData);

        return redirect('school/waiting-students')->with('flash_message', 'O`quvchi yangilandi!');
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
        WaitingStudent::destroy($id);

        return redirect('school/waiting-students')->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }
    public function archive()
    {
        return view('school.waiting-students.archive');
    }
}
