<?php
namespace App\Repositories;

use App\Models\Event;
use App\Models\Sertificate;
use App\Models\Student;
use App\Models\Group;
use App\Models\Course;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Database\Query\Builder;

class StudentRepository implements StudentRepositoryInterface{

    public function getAll(){

        $students=Student::latest()
            ->school()
            ->active()
            ->get();

        return $students;
    }

    public function create($request){
        $requestData = $request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/students';
            $file->move($path, $image);
            $requestData['image']=$image;
        }
        $qrcodeName=str_replace(' ', '-', $request->name).'-'.time().'.png';
        $requestData['qrcode']=$qrcodeName;
        $requestData['password']=bcrypt('12345678');
        $student=Student::create($requestData);
        return $student;
    }

    public function findOne($id)
    {
        return Student::with('sertificates.course')
            ->withLastEventStatus()
            ->withGroupName()
            ->findOrFail($id);
    }

    public function update($request, $id)
    {
        $requestData = $request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/students';
            $file->move($path, $image);
            $requestData['image']=$image;
        }
        $student = $this->findOne($id);
        $student->update($requestData);
        return $student;
    }

    public function addWaitingStudentToGroup($waitingStudent, $request)
    {
        $data=[
            'group_id'=>$request->group_id,
            'name'=>$waitingStudent->name,
            'phone'=>$waitingStudent->phone,
            'year'=>$waitingStudent->year,
            'address'=>$waitingStudent->address,
            'image'=>$waitingStudent->image,
            'passport'=>$waitingStudent->passport,
            'sex'=>$waitingStudent->sex,
            'type'=>$waitingStudent->type,
            'status'=>1,
            'district_id'=>$waitingStudent->district_id,
            'study_type'=>$waitingStudent->study_type,
            'start_date'=>$request->start_date
        ];
        $filename=str_replace(' ', '-', $waitingStudent->name).'-'.time().'.png';
        $data['qrcode']=$filename;
        $data['password']=bcrypt('12345678');
        $student=Student::create($data);
        return $student;
    }

    public function getByIds($ids)
    {
        return Student::find($ids);
    }

    public function countByTypes()
    {
        $students = Student::school()
            ->selectRaw("count(case when test_status='1' then 1 end) as count_test_active")
            ->selectRaw("count(case when status='".Student::ACTIVE."' then 1 end) as count_active")
            ->selectRaw("count(case when status='".Student::GRADUATED."' then 1 end) as count_graduated")
            ->selectRaw("count(case when status='".Student::OUT."' then 1 end) as count_outed")
            ->selectRaw("count(case when sex='1' and status='".Student::ACTIVE."' then 1 end ) as count_boys")
            ->selectRaw("count(case when sex='0' and status='".Student::ACTIVE."' then 1 end) as count_girls")
            ->selectRaw("count(case when type!='1' and status='".Student::ACTIVE."' then 1 end) as count_discount")
            ->selectRaw("count(case when study_type='1' and status='".Student::ACTIVE."' then 1 end) as count_school")
            ->selectRaw("count(case when study_type='2' and status='".Student::ACTIVE."' then 1 end) as count_collegue")
            ->selectRaw("count(case when study_type='3' and status='".Student::ACTIVE."' then 1 end) as count_university")
            ->selectRaw("count(case when study_type='4' and status='".Student::ACTIVE."' then 1 end) as count_worker")
            ->first();
        return $students;
    }

    public function countByCourses()
    {
        $courses=Course::school()
            ->withCount(['students', 'students as active_students_count'=>function($query){
                $query->where('students.status', Course::ACTIVE);
            },
            'students as graduated_students_2021_count'=>function($query){
                $query->where('students.status', Course::GRADUATED)->whereYear('finished_date', 2021);
            },
            'students as graduated_students_2022_count'=>function($query){
                $query->where('students.status', Course::GRADUATED)->whereYear('finished_date', 2022);
            },
            'students as out_students_count'=>function($query){
                $query->where('students.status', Course::OUT);
            },
            ])
            ->get();

        return $courses;
    }

    public function countLeftThisMonth()
    {
        return Student::school()->leftRecently()->count();
    }

    public function countGoodAttandance()
    {
        return Student::school()->goodAttandance()->count();
    }

    public function countBadAttandance()
    {
        return Student::school()->badAttandance()->count();
    }

    public function getLastSertificateId()
    {
        return Sertificate::orderBy('id', 'desc')->first()->sertificate_id ?? null;
    }
}
