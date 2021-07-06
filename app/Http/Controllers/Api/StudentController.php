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

    public function getStudentEvent($type, $id, $status, $time)
    {

        
        //return redirect()->route('students.show', $student->id);
    }
}
