<?php
namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Sertificate;
use App\Models\Student;
use App\Models\User;
use App\Models\Group;
use App\Models\Course;
use App\Models\District;
use App\Models\BotStudent;
use Illuminate\Http\Request;
use App\Models\WaitingStudent;
use App\Services\StudentService;
use App\Http\Requests\AddStudentRequest;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function __construct(public StudentService $studentService) {}

    public function index(Request $request)
    {
        return view('school.students.index');
    }

    public function create()
    {
        $groups=Group::school()->type('active')->get();
        $districts=District::all();
        $waitingStudents=WaitingStudent::all();
        return view('school.students.create', compact('groups','districts', 'waitingStudents'));
    }

    public function store(AddStudentRequest $request)
    {
        try {
            $this->studentService->create($request);
        }catch (\Exception $e){
            return back()->with('error_message', $e->getMessage());
        }
        return redirect('school/students')->with('flash_message', 'O`quvchi qo`shildi!');
    }

    public function show($id)
    {
        $student = $this->studentService->findOne($id);
        $events=$student->events()->paginate(10);
        $groups=Group::school()->with('course')->select('id', 'course_id', 'name')->type('active')->get();
        $courses=Course::school()->select('id','name')->get();
        return view('school.students.show', compact('student', 'events', 'groups', 'courses'));
    }

    public function edit($id)
    {
        $student = $this->studentService->findOne($id);
        $groups=Group::school()->type('active')->get();
        $districts=District::all();

        return view('school.students.edit', compact('student', 'groups', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name'=>'required']);
        if($request->status==Student::OUT){
            $request->validate(['outed_date'=>'required']);
        }
        $this->studentService->update($request, $id);

        return redirect('school/students')->with('flash_message', 'O`quvchi yangilandi!');
    }

    public function destroy($id)
    {
        $this->studentService->delete($id);
        return redirect()->route('students.index')->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

     public function addStudentToGroup(Request $request)
     {
         try {
             DB::transaction(function () use ($request){
                 $waitingStudent=WaitingStudent::findOrFail($request->waiting_student_id);
                 $this->studentService->addWaitingStudentToGroup($waitingStudent, $request);
                 $waitingStudent->delete();
             });
         }catch (\Exception $e){
             return back()->with('error_message', $e->getMessage());
         }
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

    public function changeGroup(Request $request){
        $this->studentService->changeGroup($request);
        return back()->with('flash_message', 'O`quvchi yangi guruhga ko`chirildi');
    }

    public function event($id)
    {
        $student=$this->studentService->findOne($id);
        $lastEventStatus = $student->getLastEventStatus();
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

    public function createSertificate(Request $request, $id)
    {
        $student=$this->studentService->findOne($id);
        $courses=Course::school()->where('is_for_bot',true)->get();
        if($request->isMethod('POST')){
            $request->validate([
                'name'=>'required',
                'surname'=>'required',
                'date'=>'required',
                'course'=>'required',
                'type'=>'required',
            ]);
            try {
                $sertificateId=$this->studentService->generateSertificate($request->all());
                return redirect('/admin/sertificats/students/'.$sertificateId.'.jpg');
            }catch (\Exception $e){
                return redirect()->back()->with('error_message', $e->getMessage());
            }
        }
        return view('school.students.create-sertificate', compact('student','courses'));
    }

    public function statistics()
    {
        $students=$this->studentService->countByTypes();
        $courses=$this->studentService->countByCourses();
        $districts=District::withCount('students')->get();
        return view('school.students.statistics',compact('students', 'districts', 'courses'));
    }

    public function storeMessage(Request $request)
    {
        $validatedData=$request->validate(['message'=>'required', 'student_id'=>'required']);
        $this->studentService->storeMessage($validatedData);
        return back()->with('flash_message', 'Ushbu o\'quvchi uchun izoh qoldirildi!');
    }

    public function downloadContract($id)
    {
        return $this->studentService->downloadContract($id);
    }

    public function downloadSertificate($id)
    {
        $sertificateId=Sertificate::findOrFail($id)->sertificate_id;
        return redirect('/admin/sertificats/students/'.$sertificateId.'.jpg');
    }

    public function deleteSertificate($sertificateId)
    {
        Sertificate::where('sertificate_id', $sertificateId)->first()->delete();
        return back()->with('flash_message', 'Sertifikat o`chirib yuborildi!');
    }

}
