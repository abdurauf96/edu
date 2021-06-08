<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       
        $students = Student::latest()->get();
    
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $group=Group::select('id')->find($id);
        $group_id=$group->id;
        $ids=$group->students->pluck('id')->all();
        $students=Student::whereNotIn('id', $ids)->get();
        return view('admin.students.create', compact('group_id', 'students'));
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
			'phone' => 'required',
			'year' => 'required',
			'address' => 'required',
			'passport' => 'required'
		]);
        $requestData = $request->except(['group_id']);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;
           
        }
        $student=Student::create($requestData);
        $student->groups()->attach($request->group_id);
        return redirect('admin/groups/'.$request->group_id)->with('flash_message', 'O`quvchi qo`shildi!');
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
        $student = Student::findOrFail($id);

        return view('admin.students.show', compact('student'));
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
        $student = Student::findOrFail($id);
        $group_id=request()->get('group_id');
        return view('admin.students.edit', compact('student', 'group_id'));
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
			'phone' => 'required',
			'year' => 'required',
			'address' => 'required',
			'passport' => 'required'
		]);
        $requestData = $request->except('group_id');
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;   
        }
        $student = Student::findOrFail($id);
        $student->update($requestData);
        if(!empty($request->group_id)){
            return redirect('admin/groups/'.$request->group_id)->with('flash_message', 'O`quvchi yangilandi!');
        }else{
            return redirect('admin/students')->with('flash_message', 'O`quvchi yangilandi!');
        }
        
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
        Student::destroy($id);

        return redirect('admin/students')->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

    public function removeFromGroup($group_id, $student_id)
    {
        $group=Group::find($group_id);
        $group->students()->detach($student_id); 
        return back()->with('flash_message', 'Student guruhdan o`chirib yuborildi!');
    }

    public function addStudentToGroup(Request $request)
    {
        $group=Group::find($request->group_id);
        $group->students()->attach($request->student_id);
        return redirect('admin/groups/'.$request->group_id)->with('flash_message', 'O`quvchi qo`shildi!');
    }
}
