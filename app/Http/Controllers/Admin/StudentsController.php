<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Group;
use App\Models\Student;
use App\Models\BotStudent;
use App\Models\WaitingStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
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

    public function createStudentToGroup($id)
    {
        $group=Group::with('course')->findOrFail($id);
        $waitingStudents=WaitingStudent::all();

        return view('admin.students.create', compact('group', 'waitingStudents'));
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
        $groups=Group::all();
        return view('admin.students.edit', compact('student', 'groups'));
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
        $last_route=$request->last_route;
        return redirect($last_route)->with('flash_message', 'O`quvchi yangilandi!');        

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
        $student = $this->studentRepo->findOne($id);
        File::delete(public_path()."/admin/images/students/".$student->image);
        File::delete(public_path()."/admin/images/qrcodes/".$student->code);

        $student->destroy($id);

        return redirect('admin/students')->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

     public function addStudentToGroup(Request $request)
     {

         $waitingStudent=WaitingStudent::findOrFail($request->waiting_student_id);

         $this->studentRepo->addWaitingStudentToGroup($waitingStudent, $request->group_id);
         $waitingStudent->delete();
         return redirect('admin/groups/'.$request->group_id)->with('flash_message', 'O`quvchi qo`shildi!');
     }

    public function studentEvent($id)
    {
        $student=Student::findOrFail($id);
        return view('admin.students.event', compact('student'));
    }

    public function botStudents()
    {
        $botStudents=BotStudent::latest()->get();
        return view('admin.students.botStudents', compact('botStudents'));
    }

}
