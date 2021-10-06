<?php

namespace App\Repositories;
use App\Models\Student;
use App\Models\Group;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\BaseRepository;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface{
    public function getAll(){
        return Student::school()->latest()->get();
    }

    public function create($request){

        $requestData = $request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/'.auth()->guard('user')->user()->school->company_name.'/students';
            $file->move($path, $image);
            $requestData['image']=$image;
        }
        $filename=str_replace(' ', '-', $request->name).'-'.time().'.png';
        $requestData['code']=$filename;

        $lastStudent=$this->getLastStudent();

        $requestData['username']=$this->generateIdNumber($lastStudent, $request->group_id);
        $requestData['password']=$this->generatePassword($requestData['year']);

        $student=Student::create($requestData);

        $this->createQRCode($student->id, $filename, 'student');

    }

    public function findOne($id)
    {
        return Student::findOrFail($id);
    }

    public function update($request, $id)
    {
        $requestData = $request->all();

        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/'.auth()->guard('user')->user()->school->company_name.'/students';
            $file->move($path, $image);
            $requestData['image']=$image;
        }

        $student = $this->findOne($id);
        $student->update($requestData);
    }

    public function getLastStudent()
    {
        return Student::school()->latest()->first();
    }

    public function generateIdNumber($student, $group_id)
    {

        $group=Group::findOrFail($group_id);

        //21MDC001 ~ year - course_code - student_number
        if(empty($student)){
            $last_number=0000;
        }else{
            $last_number=intval(substr($student->username, -4));
        }

        $number = str_pad($last_number+1, 4, 0, STR_PAD_LEFT);
        $course_code=$group->course->code;
        $current_year=date('y');
        $idNumber=$current_year.$course_code.$number;
        return $idNumber;
    }

    public function generatePassword($year)
    {
        $yearToArray=explode('-', $year);
        $reversed=array_reverse($yearToArray);
        $yearToString=implode('', $reversed);

        return bcrypt($yearToString);
    }

    public function addWaitingStudentToGroup($waitingStudent, $group_id)
    {
        $data=[
            'group_id'=>$group_id,
            'name'=>$waitingStudent->name,
            'phone'=>$waitingStudent->phone,
            'year'=>$waitingStudent->year,
            'address'=>$waitingStudent->address,
            'image'=>$waitingStudent->image,
            'passport'=>$waitingStudent->passport,
            'sex'=>$waitingStudent->sex,
            'type'=>$waitingStudent->type,
            'status'=>1,
        ];

        $filename=str_replace(' ', '-', $waitingStudent->name).'-'.time().'.png';
        $data['code']=$filename;

        $lastStudent=$this->getLastStudent();
        $data['username']=$this->generateIdNumber($lastStudent, $group_id);
        $data['password']=$this->generatePassword($data['year']);

        $student=Student::create($data);
        $this->createQRCode($student->id, $filename, 'student');

    }

}
