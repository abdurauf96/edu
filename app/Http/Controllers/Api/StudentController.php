<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentEvent as StudentEventModel;
use App\Events\StudentEvent;
use App\Http\Resources\Student as StudentResource;
use Auth;
class StudentController extends BaseController
{
   

    public function getStudent($id)
    {
        $student=Student::with('group')->findOrFail($id);
        return $this->sendResponse(new StudentResource($student));
    }

    public function getStudentEvent($id, $status, $time)
    {
        $student=Student::findOrFail($id);
        StudentEventModel::create([
            'student_id'=>$id,
            'status'=>$status=='in'? 1 : 0,
            'time'=>$time,
        ]);
        $students=StudentEventModel::latest()->get();
        //if(Auth::check() && Auth::user()->hasRole('viewer')){
        event(new StudentEvent($id));
        //}
        
        return $this->sendResponse(new StudentResource($student));
        //return redirect()->route('students.show', $student->id);
    }
}
