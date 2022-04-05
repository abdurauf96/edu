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
        $staffObj=new StaffRepository;
    }

    public function getAll($key=null)
    {
        if($key=='not-actives'){
            $teachers=Teacher::school()->latest()->whereStatus(0)->get();
        }elseif($key=='all'){
            $teachers=Teacher::school()->latest()->get();
        }else{
            $teachers=Teacher::school()->latest()->whereStatus(1)->get();
        }
        
        return $teachers;
    }

    public function findOne($id)
    {
        return Teacher::findOrFail($id);
    }

    public function store($data){

        $staff=$this->staffObj->findOne($data['staff_id']);
        $yearToArray=explode('-', $staff['year']);
        $reversed=array_reverse($yearToArray);
        $yearToString=implode('', $reversed);

        $teacher=new Teacher;
        $teacher->password=Hash::make($yearToString);

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
        $teacher->save();
        $teacher->courses()->sync($data['course_id']);

    }
}
