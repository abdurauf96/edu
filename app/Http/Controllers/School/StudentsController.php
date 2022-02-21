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
        $students = $this->studentRepo->getAll($request->year);
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
        $this->studentRepo->create($request);
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
        $student = $this->studentRepo->findOne($id);

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

        $student = $this->studentRepo->findOne($id);
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

        return redirect('school/students?year='.date('Y'))->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

     public function addStudentToGroup(Request $request)
     {

         $waitingStudent=WaitingStudent::findOrFail($request->waiting_student_id);

         $this->studentRepo->addWaitingStudentToGroup($waitingStudent, $request->group_id);
         $waitingStudent->delete();
         return redirect('school/groups/'.$request->group_id)->with('flash_message', 'O`quvchi qo`shildi!');
     }

    public function studentEvent($id)
    {
        $student=Student::findOrFail($id);
        return view('school.students.event', compact('student'));
    }

    public function botStudents()
    {
        $botStudents=BotStudent::school()->latest()->get();
        return view('school.students.botStudents', compact('botStudents'));
    }

    public function studentQrcodes(Request $request)
    {
        if(!empty($request->q)){
            $students=Student::school()->where('name', 'LIKE', '%'.$request->q.'%')->with('group')->paginate(10);
        }else{
            $students=Student::school()->latest()->with('group')->paginate(10);
        }
        
        return view('school.students.qrcodes', compact('students'));
    }

    public function downloadQrcode($id){
        $headers = array('Content-Type: application/jpg',);
        $student = $this->studentRepo->findOne($id);
        $student->qrcode_status=1;
        $student->save();
        return response()->download('admin/images/qrcodes/'.$student->code, $student->code, $headers);
    }

    public function downloadImage($image){
        return response()->download(public_path('admin/images/students/'.$image));
    }

    public function changeGroup(Request $request){
        if($request->isMethod('post')){
            $student=$this->studentRepo->findOne($request->student_id);
            $new_group=Group::find($request->new_group_id);
            $description=<<<TEXT
{$student->name}  {$student->group->course->name} kursi {$student->group->name} guruhidan {$new_group->course->name} kursi {$new_group->name} guruhiga o'tdi
TEXT;

            StudentActivity::create(['student_id'=>$request->student_id, 'description'=>$description ]);
            $student->group_id=$request->new_group_id;
            $student->save();
            return back()->with('flash_message', 'O`quvchi '.$new_group->name. '  ga ko`chirildi');
        }else{
            $students = $this->studentRepo->getAll();
            $groups=Group::school()->get();
            $courses=Course::school()->get();
            return view('school.students.changeGroup', compact('students', 'groups', 'courses'));
        }

    }

    public function generateCard($id)
    {
        $student = $this->studentRepo->findOne($id);
        $img = \Image::make(public_path('admin/images/idcard.jpg'));
        $img->text(strtoupper($student->name), 370, 700, function($font) {  
            $font->file(public_path('admin/assets/fonts/nunito-v9-latin-800.ttf'));  
            $font->size(34);  
            $font->color('#000f48');  
            $font->align('center');   
        });
        $img->text($student->username, 410, 740, function($font) {  
            $font->file(public_path('admin/assets/fonts/nunito-v9-latin-600.ttf'));  
            $font->size(32);  
            $font->color('#041f94');  
            $font->align('center');     
        });  
         $img->save(public_path('admin/images/idcards/'.$student->name.'.jpg'));

    }

}
