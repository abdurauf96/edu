<?php

namespace App\Http\Controllers\School;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\User;
use App\Models\Clas;
use App\Models\Group;
use App\Models\Course;
use App\Models\Student;
use App\Models\District;
use App\Models\BotStudent;
use Illuminate\Http\Request;
use App\Models\WaitingStudent;
use App\Models\StudentActivity;
use App\Services\StudentService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    public function index(Request $request)
    {
        return view('school.students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        $groups=Group::school()->type('active')->get();
        $districts=District::all();
        $waitingStudents=WaitingStudent::all();
        return view('school.students.create', compact('groups','districts', 'waitingStudents'));
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
        return redirect('school/students')->with('flash_message', 'O`quvchi qo`shildi!');
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
        $events=$student->events()->paginate(10);
        $groups=Group::school()->with('course')->select('id', 'course_id', 'name')->type('active')->get();
        $courses=Course::school()->select('id','name')->get();
        return view('school.students.show', compact('student', 'events', 'groups', 'courses'));
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
        $groups=Group::school()->type('active')->get();
        $districts=District::all();
       
        return view('school.students.edit', compact('student', 'groups', 'districts'));
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
        $request->validate(['name'=>'required']);

        if($request->status==2){
            $request->validate(['outed_date'=>'required']);
        }
        if($request->status==0){
            $request->validate(['finished_date'=>'required']);
        }
        $this->studentService->update($request, $id);

        return redirect('school/students')->with('flash_message', 'O`quvchi yangilandi!');
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
        return redirect()->route('students.index')->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

     public function addStudentToGroup(Request $request)
     {
        $waitingStudent=WaitingStudent::findOrFail($request->waiting_student_id);
        $this->studentService->addWaitingStudentToGroup($waitingStudent, $request);
        $waitingStudent->delete();
        return redirect('school/students')->with('flash_message', 'O`quvchi qo`shildi!');
     }

    public function botStudents()
    {
        $botStudents=BotStudent::school()->latest()->get();
        return view('school.students.botStudents', compact('botStudents'));
    }


    public function downloadQrcode($id){
        $student=$this->studentService->findOne($id);
        if(!file_exists('admin/images/qrcodes/'.$student->qrcode)){
            generateQrcode($student->id, $student->qrcode, 'student');
        }
        return response()->download('admin/images/qrcodes/'.$student->qrcode);
    }

    public function downloadCard($idcard){
        if(file_exists('admin/images/idcards/'.$idcard)){
            return response()->download(public_path('admin/images/idcards/'.$idcard));
        }
    }

    public function changeGroup(Request $request){
        $this->studentService->changeGroup($request);
        return back()->with('flash_message', 'O`quvchi yangi guruhga ko`chirildi');
    }

    public function generateCard($id)
    {
        $student=$this->studentService->findOne($id);
        $this->studentService->generateIdCard($student);

        return back()->with('flash_message', 'Ushbu o\'quvchi uchun ID card yaratildi!  ');
    }

    public function sertificatedStudents()
    {
        return view('school.students.sertificats');
    }

    public function statistics()
    {
        $students=$this->studentService->countByTypes();

        $courses=$this->studentService->countByCourses();
    
        $districts=District::withCount('students')->get();

        return view('school.students.statistics',compact('students', 'districts', 'courses'));
    }

}
