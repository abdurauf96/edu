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
        $filename=$request->name.'-'.time().'.png';
        $requestData['code']=$filename;
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

    // public function removeFromGroup($group_id, $student_id)
    // {
    //     Group::find($group_id)->students()->detach($student_id);
    // }

    // public function addStudentToGroup($group_id, $student_id)
    // {
    //     Group::find($group_id)->students()->attach($student_id);
    // }
}