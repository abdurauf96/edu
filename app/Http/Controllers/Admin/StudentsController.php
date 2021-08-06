<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo)
    {
        $this->studentRepo=$studentRepo;
    }
    public function index(Request $request)
    {
       
        $students = $this->studentRepo->getAll();
    
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
    public function store(AddStudentRequest $request)
    {
       
        $this->studentRepo->create($request);
    
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
        $student = $this->studentRepo->findOne($id);
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
        $student = $this->studentRepo->findOne($id);
        //$group_id=request()->get('group_id');
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $this->studentRepo->update($request, $id);
        
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

    // public function removeFromGroup($group_id, $student_id)
    // {
    //     $this->studentRepo->removeFromGroup($group_id, $student_id);

    //     return back()->with('flash_message', 'o`quvchi guruhdan o`chirib yuborildi!');
    // }

    // public function addStudentToGroup(Request $request)
    // {
    //     $this->studentRepo->addStudentToGroup($request->group_id, $request->student_id);
    //     return redirect('admin/groups/'.$request->group_id)->with('flash_message', 'O`quvchi qo`shildi!');
    // }

    public function studentEvent($id)
    {
        $student=Student::findOrFail($id);
        return view('admin.students.event', compact('student'));
    }

    
}
