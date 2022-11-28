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
use App\Exports\SchoolStudentsExport;
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
        if(is_academy()){

            return view('school.students.index');

        }else{

            $students = $this->studentService->getAll($request);

            if($request->has('export')){
                $data=$this->studentService->exportDataToSchool($students);
                return Excel::download(new  SchoolStudentsExport($data), 'students.xlsx');
            }
            return view('school.students.school.index', compact('students'));
        }
    }

    public function creatorStatistics(Request $request)
    {
        $creators = User::role('creator')->get();
        $students = Student::all();
        return view('school.students.creator-statistics', compact('creators', 'students'));
    }

    public function addCreatorId(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $students = $this->studentService->getByIds($request->student_ids)
            ->toQuery()
            ->update(['creator_id'=>auth()->guard('user')->id()]);
            return redirect()->route('school.students.addCreatorId');
        }else{
            $students=Student::active()->whereNull('creator_id')->get();
            return view('school.students.creator', compact('students'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        $groups=Group::school()->where('status', '!=', Group::GRADUATED)->get();
        $districts=District::all();
        $classes=Clas::all();
        $waitingStudents=WaitingStudent::all();
        return view('school.students.create', compact('groups','districts','classes', 'waitingStudents'));
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
        $districts=District::all();
        $classes=Clas::all();
        return view('school.students.edit', compact('student', 'groups', 'districts','classes'));
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
        return redirect()->route('school.students.index')->with('flash_message', 'O`quvchi o`chirib yuborildi!');
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

    public function event($id)
    {
        $student=$this->studentService->findOne($id);
        $lastEventStatus = $student->getLastEventStatus($id);
        \App\Models\Event::create([
            'person_id'=>$id,
            'type'=>'student',
            'name'=>$student->name,
            'status'=>!$lastEventStatus,
            'time'=>date('H:i'),
            'school_id'=>$student->school_id,
        ]);
        return back()->with('flash_message', 'Natija kiritildi !');
    }

    public function debtStudents()
    {
        $students=$this->studentService->debtStudents();
        $groups=Group::all();
        $courses=Course::all();
        return view('school.students.debtStudents', compact('students', 'groups', 'courses'));
    }

    public function getStudentsByGroup(Request $request)
    {
        $students=$this->studentService->getAll()->where('debt', '>', 0)->where('group_id', $request->group_id);
        return view('school.ajax.getStudentsByGroup', compact('students'));
    }

    public function sertificatedStudents()
    {
        return view('school.students.sertificats');
    }

    public function statistics()
    {
        $districts=District::all();
        $courses=Course::all();

        $studentsByAges = Student::active()->get()->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->year)->format('Y');
        });

        $studentsBySex = Student::active()->select('sex', DB::raw('count(*) as total'))
        ->groupBy('sex')
        ->get();

        $studentsBySchool = Student::active()->select('study_type', DB::raw('count(*) as total'))
        ->groupBy('study_type')
        ->orderBy('study_type')
        ->get();

        $school=Student::active()->where('study_type', 1)->get()->count();
        $collegue=Student::active()->where('study_type', 2)->get()->count();
        $university=Student::active()->where('study_type', 3)->get()->count();
        $worker=Student::active()->where('study_type', 4)->get()->count();
        $types['school']=$school;
        $types['collegue']=$collegue;
        $types['university']=$university;
        $types['worker']=$worker;

        $grant_students=Student::school()->grant()->count();
        $active_students=Student::active()->count();
        return view('school.students.statistics',compact('districts', 'studentsBySex', 'studentsByAges','grant_students', 'active_students','types', 'courses'));
    }

}
