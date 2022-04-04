<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Group;
use App\Models\Course;
use App\Models\Student;
use App\Models\BotStudent;
use App\Models\WaitingStudent;
use App\Models\StudentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\StudentService;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public $studentRepo;
    public $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService=$studentService;
    }
    public function index(Request $request)
    {
      
        $students = $this->studentService->getAll($request);
        return view('school.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function createStudentToGroup($id)
    {
        $group=Group::school()->with('course')->findOrFail($id);
        $waitingStudents=WaitingStudent::all();
        $groups=Group::school()->get();
        return view('school.students.create', compact('group', 'waitingStudents', 'groups'));
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
        $this->studentService->create($request);
        return redirect('school/groups/'.$request->group_id)->with('flash_message', 'O`quvchi qo`shildi!');
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
        $student = $this->studentService->findOne($id);

        return view('school.students.show', compact('student'));
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

        $student = $this->studentService->findOne($id);
        $groups=Group::school()->get();
        return view('school.students.edit', compact('student', 'groups'));
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
        $this->studentService->update($request, $id);
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
        $student = $this->studentService->delete($id);
        return redirect('school/students?year='.date('Y'))->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

     public function addStudentToGroup(Request $request)
     {

         $waitingStudent=WaitingStudent::findOrFail($request->waiting_student_id);

         $this->studentService->addWaitingStudentToGroup($waitingStudent, $request->group_id);
         $waitingStudent->delete();
         return redirect('school/groups/'.$request->group_id)->with('flash_message', 'O`quvchi qo`shildi!');
     }

     /* attendance routes for websocket, now not using 
    public function studentEvent($id)
    {
        $student=Student::findOrFail($id);
        return view('school.students.event', compact('student'));
    } */

    public function botStudents()
    {
        $botStudents=BotStudent::school()->latest()->get();
        return view('school.students.botStudents', compact('botStudents'));
    }


    public function downloadQrcode($code){
        if(!file_exists('admin/images/qrcodes/'.$code)){
            return back()->with('error', 'QRCode topilmadi !');
        }
        return response()->download('admin/images/qrcodes/'.$code);
    }

    public function downloadCard($idcard){
        if(file_exists('admin/images/idcards/'.$idcard)){
            return response()->download(public_path('admin/images/idcards/'.$idcard));
        }
    }

    public function changeGroup(Request $request){
        if($request->isMethod('post')){
            $this->studentService->changeGroup($request);
            return back()->with('flash_message', 'O`quvchi yangi guruhga ko`chirildi');
        }else{
            $students = $this->studentService->getAll();
            $groups=Group::school()->get();
            $courses=Course::school()->get();
            return view('school.students.changeGroup', compact('students', 'groups', 'courses'));
        }

    }

    public function generateCard($id)
    {
        $student=$this->studentService->findOne($id);
        $this->studentService->generateIdCard($student);
           
        return back()->with('flash_message', 'Ushbu o\'quvchi uchun ID card yaratildi!  ');
    }

    

}
