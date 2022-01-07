<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\Student;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function students()
    {
        return view('teacher.students');
    }

    public function profil()
    {
        return view('teacher.profil');
    }

    public function getInfo()
    {
        $teacher=request()->user();
        $courses=\App\Models\Course::where('school_id', $teacher->getSchool->id)->get();

        $course_id=[];
        foreach ($teacher->courses as $course){
            array_push($course_id, $course->id);
        }

        $data=['courses'=>$courses, 'teacher'=>$teacher, 'course_id'=>$course_id];
        return $data;
    }

    public function updateInfo(Request $request)
    {
       
        $teacher=$request->user();
        $teacher->update($request->all());
        $teacher->courses()->sync($request->courses);
        
    }

    public function updateLogin(Request $request)
    {
       
        $teacher=$request->user();
        $data=$request->all();
        $request->validate([
            'email'=>'required|unique:teachers,email,'.$teacher->id,
            'password'=>'required|min:6',
        ]);
        $data['password']=bcrypt($request->password);

        $teacher->update($data);
        
    }

    public function groups()
    {
        return view('teacher.groups');
    }

    public function attendance()
    {
        return view('teacher.attendance');
    }
}
