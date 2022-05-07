<?php

namespace App\Services;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Jobs\StudentOutedCourseJob;
use App\Jobs\StudentStartedCourseJob;
use App\Jobs\StudentFinishedCourseJob;
use App\Jobs\StudentChangeCourseJob;

class StudentService{

    protected $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo){
        $this->studentRepo=$studentRepo;
    }

    public function getAll($request=null){
        return $this->studentRepo->getAll($request);
    }

    public function findOne($id)
    {
        return $this->studentRepo->findOne($id);
    }

    public function create($request){
        
        $student=$this->studentRepo->create($request);
        dispatch(new StudentStartedCourseJob($student));
        generateQrcode($student->id, $student->qrcode, 'student');
        $this->generateIdCard($student);
    }

    public function update($request, $id)
    {
        $s=$this->studentRepo->findOne($id);
        $student=$this->studentRepo->update($request, $id);
        if($request->status==2 && $s->status!=$request->status){ //if student outed course
            dispatch(new StudentOutedCourseJob($student));
        }
    }
    
    public function generateIdCard($student)
    {
        $circled_image=circleImage($student->image, 'students');
       
        if(!file_exists(public_path().'/admin/images/qrcodes/'.$student->qrcode)){
            generateQrcode($student->id, $student->qrcode, 'student');
        }
        if(makeCard($student, $circled_image, 'student')){
            $student->idcard=$student->name.'.jpg';
            $student->save();
        }
        return true;  
    }

    public function delete($id)
    {
        $student = $this->studentRepo->findOne($id);
        \File::delete(public_path()."/admin/images/students/".$student->image);
        \File::delete(public_path()."/admin/images/qrcodes/".$student->qrcode);
        $student->destroy($id);
        return redirect('school/students?year='.date('Y'))->with('flash_message', 'O`quvchi o`chirib yuborildi!');
    }

    public function changeGroup($request)
    {
        $student=$this->studentRepo->findOne($request->student_id);
        $new_group=\App\Models\Group::find($request->new_group_id);
        dispatch(new StudentChangeCourseJob($student,$request->start_date, $new_group->course->price));
        $student->group_id=$request->new_group_id;
        $student->save();
        
        $description=<<<TEXT
        {$student->name}  {$student->group->course->name} kursi {$student->group->name} guruhidan {$new_group->course->name} kursi {$new_group->name} guruhiga o'tdi
TEXT;
        \App\Models\StudentActivity::create(['student_id'=>$request->student_id, 'description'=>$description ]);
        
    }

    public function addWaitingStudentToGroup($waitingStudent, $request)
    {
        $student=$this->studentRepo->addWaitingStudentToGroup($waitingStudent, $request);
        dispatch(new StudentStartedCourseJob($student));
        generateQrcode($student->id, $student->qrcode, 'student');
        $this->generateIdCard($student);
    }

}