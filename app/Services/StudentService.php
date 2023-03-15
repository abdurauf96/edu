<?php

namespace App\Services;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Jobs\StudentOutedCourseJob;
use App\Jobs\StudentStartedCourseJob;
use App\Jobs\StudentChangeCourseJob;
use App\Traits\Sertificate;
use App\Traits\StudentContract;

class StudentService{
    use Sertificate, StudentContract;
    protected $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo){
        $this->studentRepo=$studentRepo;
    }

    public function getAll(){
        return $this->studentRepo->getAll();
    }

    public function findOne($id)
    {
        return $this->studentRepo->findOne($id);
    }

    public function create($request){
        DB::transaction(function () use ($request): void {
            $student=$this->studentRepo->create($request);
            dispatch(new StudentStartedCourseJob($student, $request->first_month_debt));
            generateQrcode($student->id, $student->qrcode, 'student');
        });
    }

    public function update($request, $id)
    {
        $student=$this->studentRepo->update($request, $id);
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
        $new_group=Group::find($request->new_group_id);
        dispatch(new StudentChangeCourseJob($student,$new_group));
        $student->update(['group_id'=>$request->new_group_id]);
    }

    public function addWaitingStudentToGroup($waitingStudent, $request)
    {
        $student=$this->studentRepo->addWaitingStudentToGroup($waitingStudent, $request);
        dispatch(new StudentStartedCourseJob($student,$request->first_month_debt));
        generateQrcode($student->id, $student->qrcode, 'student');
    }

    public function exportDataToAcademy($students){
        $data=[]; $i=1;
        foreach ($students as $student){
            $item['N']=$i;
            $item['name']=$student->name;
            $item['group']=$student->group->name;
            $item['course']=$student->group->course->name;
            $item['phone']=$student->phone;
            $item['region']=$student->district->name ?? ' ';
            $item['addres']=$student->address;
            $item['status']=$student->statusText();
            $item['teacher']=$student->group->teacher->name;
            $item['id']=$student->id;
            array_push($data, $item);
            $i++;
        }
        return $data;
    }

    public function getByIds($ids){
        return $this->studentRepo->getByIds($ids);
    }

    public function countByTypes()
    {
        return $this->studentRepo->countByTypes();
    }

    public function countByCourses()
    {
        return $this->studentRepo->countByCourses();
    }

    public function countGoodAttandance()
    {
        return $this->studentRepo->countGoodAttandance();
    }

    public function countBadAttandance()
    {
        return $this->studentRepo->countBadAttandance();
    }

    public function countLeftThisMonth()
    {
        return $this->studentRepo->countLeftThisMonth();
    }

    public function storeMessage($data)
    {
        \App\Models\StudentMessage::create([
            'student_id'=>$data['student_id'],
            'user_id'=>auth()->guard('user')->id(),
            'message'=>$data['message']
        ]);
    }


}
