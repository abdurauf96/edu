<?php

namespace App\Repositories;
use App\Models\Student;
use App\Models\Group;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\BaseRepository;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface{
    public function getAll(){
        return Student::latest()->get();
    }

    public function create($request){
        $requestData = $request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;
        }
        $filename=str_replace(' ', '-', $request->name).'-'.time().'.png';
        $requestData['code']=$filename;

        $lastStudent=$this->getLastStudent();
        $requestData['username']=$this->generateIdNumber($lastStudent);
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
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;   
        }

        $student = $this->findOne($id);
        $student->update($requestData);
    }

    public function getLastStudent()
    {
        return Student::latest()->first();
    }

    public function generateIdNumber($student)
    {
        //21MDC001 ~ year - course_code - student_number
        $last_number=intval(substr($student->username, -4));
        $number = str_pad($last_number+1, 4, 0, STR_PAD_LEFT);
        $course_code=$student->group->course->code;
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

    // public function removeFromGroup($group_id, $student_id)
    // {
    //     Group::find($group_id)->students()->detach($student_id);
    // }

    // public function addStudentToGroup($group_id, $student_id)
    // {
    //     Group::find($group_id)->students()->attach($student_id);
    // }
}