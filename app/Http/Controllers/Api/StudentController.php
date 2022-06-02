<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentFullInfo;
use App\Http\Resources\StudentPaymentHistory;
use App\Http\Requests\UpdateStudentRequest;
use Hash;
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

    public function getStudentEvents()
    {
        $student=request()->user();
        $events=[];
        foreach ($student->events as $event) {
            $data=[
                'event'=>$event->status==1 ? 'Kirib kelgan' : 'Chiqib ketgan',
                'time'=>$event->time,
                'date'=>$event->created_at->format('d-m-Y')
            ];
            array_push($events, $data);
        }
        return $this->sendResponse($events);
    }

    public function updateInfo(UpdateStudentRequest $request)
    {
        $student=request()->user();
        $requestData=$request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/students';
            $file->move($path, $image);
            $requestData['image']=$image;
        }
        $student->update($requestData);
        return $this->sendResponse();   
    }

    public function updatePassword(Request $request)
    {
        $student=request()->user();
        $request->validate([
            'old_password'=>'required',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if(!Hash::check($request->old_password, $student->password)){
            return $this->sendError('current password is wrong'); 
        }
        
        $student->update(['password'=>Hash::make($request->password)]);
        return $this->sendResponse();   
    }
  
}
