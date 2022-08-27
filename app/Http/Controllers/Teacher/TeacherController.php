<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function students(Request $request)
    {

        $groups = auth()->guard('teacher')->user()->groups()->type()->get();

        $students=auth()->guard('teacher')->user()->students;

        if(!empty($request->group_id)){

            $students=auth()->guard('teacher')->user()->students()->where('group_id', $request->group_id)->get();
        }
        return view('teacher.students', compact('students', 'groups'));
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

    public function studentsAttandance(Request $request)
    {

        $student=\App\Models\Student::findOrFail($request->student_id);
        \App\Models\Event::create([
            'person_id'=>$request->student_id,
            'type'=>'student',
            'name'=>$student->name,
            'status'=>$request->status,
            'time'=>date('H:i'),
            'school_id'=>$student->school_id,
        ]);
        //return back()->with('flash_message', 'Natija kiritildi !');
    }

    public function groups()
    {
        $groups = auth()->guard('teacher')->user()->groups()->type()->get();

        return view('teacher.groups', compact('groups'));
    }

    public function attendance()
    {
        return view('teacher.attendance');
    }

    public function coursePlans($id)
    {
        $course=Course::findOrFail($id);
        return view('teacher.plans.index', compact('course'));
    }
}
