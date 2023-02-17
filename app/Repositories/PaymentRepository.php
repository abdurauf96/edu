<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface{
    public function getAll()
    {
        return Payment::school()->orderBy('id', 'DESC')->with('student')->get();
    }

    public function create($request)
    {

        $requestData=$request->all();
        $student=\App\Models\Student::findOrFail($request->student_id);
        $student->debt-=$request->amount;
        $student->save();
        $requestData['course_id']=$student->group->course_id;
        Payment::create($requestData);
    }

    public function findOne($id)
    {
        return Payment::findOrFail($id);
    }

    public function update($request, $id)
    {
        $payment = $this->findOne($id);
        $payment->update($request->all());
    }

}
