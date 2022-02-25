<?php
namespace App\Repositories;

use App\Models\Student;
use App\Models\Group;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface{

    public function getAll($year=null){
        return Student::school()
            ->latest()
            ->with('group.course')
            ->when($year, function($query) use ($year){
                $query->where('study_year', $year);
            })
            ->get();
    }

    public function graduated(){
        return Student::school()->graduated()->latest()->get();
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
        $filename=str_replace(' ', '-', $request->name).'-'.time().'.png';
        $filename_idcard=str_replace(' ', '-', $request->name).'-'.time().'.jpg';
        $requestData['qrcode']=$filename;
        $requestData['idcard']=$filename_idcard;

        $lastStudentNumber=$this->getLastStudentNumber();

        $course_code=Group::findOrFail($request->group_id)->course->code;
        $requestData['username']=generateIdNumber($lastStudentNumber, $course_code);
        $requestData['password']=generatePassword($requestData['year'] ?? 12345678);

        $student=Student::create($requestData);
        return $student; 

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
            $path='admin/images/students';
            $file->move($path, $image);
            $requestData['image']=$image;
        }

        $student = $this->findOne($id);
        $student->update($requestData);
    }

    public function getLastStudentNumber()
    {
        return Student::school()->latest()->first()->username ?? null;
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
        $data['qrcode']=$filename;
        $course_code=Group::findOrFail($request->group_id)->course->code;
        $lastStudent=$this->getLastStudentNumber();
        $data['username']=generateIdNumber($lastStudent, $course_code);
        $data['password']=$this->generatePassword($data['year']);

        $student=Student::create($data);
        return $student;
    }

}
