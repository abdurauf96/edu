<?php


namespace App\Repositories;


use App\Models\Teacher;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Hash;
class TeacherRepository implements TeacherRepositoryInterface
{
    public function store($data){
        //$requestData = $request->except(['course_id']);

        $yearToArray=explode('-', $data['birthday']);
        $reversed=array_reverse($yearToArray);
        $yearToString=implode('', $reversed);

        $data['password']=Hash::make($yearToString);

        $teacher=Teacher::create($data);
        $teacher->courses()->attach($data['course_id']);
    }

    public function update($id, $data){
        //$requestData = $request->except(['course_id']);
        $teacher = Teacher::findOrFail($id);

        $yearToArray=explode('-', $data['birthday']);
        $reversed=array_reverse($yearToArray);
        $yearToString=implode('', $reversed);
        $data['password']=Hash::make($yearToString);

        $teacher->update($data);
        $teacher->courses()->sync($data['course_id']);

    }
}
