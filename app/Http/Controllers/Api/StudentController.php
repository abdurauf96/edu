<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentFullInfo;
use App\Http\Resources\StudentPaymentHistory;

class StudentController extends BaseController
{
   
    public function studentFullInfo(Request $request)
    {
        return $this->sendResponse(new StudentFullInfo($request->user()));
    }

    public function getStudentPayments(Request $request)
    {
        $student=$request->user();
        $histories=[];
        foreach ($student->payments as $payment) {
            $history=new StudentPaymentHistory($payment);
            array_push($histories, $history);
        }

        $data=[
            'payment_history'=>$histories 
        ];

        return $this->sendResponse($data);
    }
    
    public function getStudent($id)
    {
        $student=Student::with('group')->findOrFail($id);
        return $this->sendResponse(new StudentResource($student));
    }

  
}
