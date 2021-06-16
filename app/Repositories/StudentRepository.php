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
        $requestData = $request->except(['group_id']);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;
        }
        $filename=time().'.png';
        $requestData['code']=$filename;
        $student=Student::create($requestData);
        $student->groups()->attach($request->group_id);
        $this->createQRCode($request->name, $request->phone, $filename); 
    }

    public function findOne($id)
    {
        return Student::findOrFail($id);
    }

    public function update($request, $id)
    {
        $requestData = $request->except(['group_id']);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;   
        }

        $student = $this->findOne($id);

        $payments_str='';
        foreach($student->payments as $payment){
            $payments_str.='Guruh nomi - '.$payment->group->name.', To`lov oyi - '.$payment->month->name.' <br>'; 
        }
        $filename=time().'.png';
        $this->createQRCode($request->name, $request->phone, $filename, $payments_str);
        $requestData['code']=$filename;
        $student->update($requestData);
    }

    public function removeFromGroup($group_id, $student_id)
    {
        Group::find($group_id)->students()->detach($student_id);
    }

    public function addStudentToGroup($group_id, $student_id)
    {
        Group::find($group_id)->students()->attach($student_id);
    }
}