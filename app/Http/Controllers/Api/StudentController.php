<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\Student as StudentResource;
class StudentController extends BaseController
{
    public function getStudent($id)
    {
        $student=Student::findOrFail($id);
        return $this->sendResponse(new StudentResource($student));

    }

    public function test($id)
    {
        $student=Student::findOrFail($id);
        return $this->sendResponse(new StudentResource($student));
    }
}
