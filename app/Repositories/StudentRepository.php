<?php
namespace App\Repositories;

use App\Models\Student;
use App\Models\Group;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface{

    public function getAll($request=null){
        
        $year=$request->year ?? null;
        $type=$request->type ?? null;
       
        $students=Student::query();

        switch ($type) {
            case 'graduated':
                $students->whereStatus(0);
                break;
            case 'out':
                $students->whereStatus(2);
                break;
            case 'active':
                $students->whereStatus(1);
                break;
            case 'grant':
                $students->where('type', '!=', 1);
                break;
            case 'girls':
                $students->whereSex(0);
                break;
            case 'boys':
                $students->whereSex(1);
                break;
        }
        
        $students=$students->when($year, function($query) use ($year){
            $query->where('study_year', $year);
        })
        ->latest()
        ->with('group.course')
        ->get();

        return $students;
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
        return $student;
    }

    public function getLastStudentNumber()
    {
        return Student::school()->latest()->first()->username ?? null;
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
            'study_year'=>date('Y'),
            'district_id'=>$waitingStudent->district_id,
            'study_type'=>$waitingStudent->study_type,
            'start_date'=>$request->start_date,
        ];

        $filename=str_replace(' ', '-', $waitingStudent->name).'-'.time().'.png';
        $data['qrcode']=$filename;
        $course_code=Group::findOrFail($request->group_id)->course->code;
        $lastStudent=$this->getLastStudentNumber();
        $data['username']=generateIdNumber($lastStudent, $course_code);
        $data['password']=generatePassword($data['year']);

        $student=Student::create($data);
        return $student;
    }

}
