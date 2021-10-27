<?php


namespace App\Repositories;


use App\Models\Teacher;
use App\Repositories\Interfaces\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function store($data){
        //$requestData = $request->except(['course_id']);

        $yearToArray=explode('-', $data['birthday']);
        $reversed=array_reverse($yearToArray);
        $yearToString=implode('', $reversed);

        $data['password']=bcrypt($yearToString);

        $teacher=Teacher::create($data);
        $teacher->courses()->attach($data['course_id']);
    }
}
