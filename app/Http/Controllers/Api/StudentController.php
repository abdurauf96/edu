<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentEvent;
use App\Http\Resources\Student as StudentResource;
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
        StudentEvent::create([
            'student_id'=>$id,
            'status'=>$status=='in'? 1 : 0,
            'time'=>$time,
        ]);
        return $this->sendResponse(new StudentResource($student));
    }
}
