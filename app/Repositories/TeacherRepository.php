<?php


namespace App\Repositories;


use App\Models\Teacher;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\StaffRepository;
use Hash;
class TeacherRepository implements TeacherRepositoryInterface
{

    protected $staffObj;
    public function __construct()
    {
        $this->staffObj=new StaffRepository;
    }

    public function getAll()
    {
        //$teachers=Teacher::school()->latest()->withCount('students')->with('courses')->get();
        //return $teachers;
    }

    public function findOne($id)
    {
        return Teacher::withCount(['students', 'students as debt_students_count'=>function($query){
                $query->debtors();
            }])
            ->with('courses')
            ->findOrFail($id);
    }

    public function store($data){

        $staff=$this->staffObj->findOne($data['staff_id']);

        $teacher=new Teacher;
        $teacher->password=generatePassword($data['birthday']);

        $teacher->name=$staff->name;
        $teacher->birthday=$staff->year;
        $teacher->address=$staff->addres;
        $teacher->passport=$staff->passport;
        $teacher->phone=$staff->phone;
        $teacher->email=$data['email'];
        $teacher->status=$data['status'];
        $teacher->save();
        $teacher->courses()->attach($data['course_id']);
    }

    public function update($id, $data){

        $teacher = $this->findOne($id);
        $teacher->email=$data['email'];
        $teacher->status=$data['status'];
        $teacher->birthday=$data['birthday'];
        $teacher->password=generatePassword($data['birthday']);
        $teacher->name=$data['name'];
        $teacher->save();
        $teacher->courses()->sync($data['course_id']);

    }

    public function numberActives()
    {
        return Teacher::school()->whereStatus(1)->count();
    }
}
