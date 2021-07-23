<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Payment;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface{
    public function getAll()
    {
        return Payment::latest()->get();
    }

    public function create($request)
    {
        
        $requestData=$request->all();
        $student=\App\Models\Student::findOrFail($request->student_id);
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