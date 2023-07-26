<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface{
    public function getAll()
    {
        return Payment::school()->orderBy('id', 'DESC')->with('student')->get();
    }

    public function create($request)
    {
        DB::transaction(function () use ($request){
            $requestData=$request->all();
            $student=Student::select('id','group_id','debt','name')->findOrFail($request->student_id);
            $student->debt-=$request->amount;
            $student->save();
            $requestData['course_id']=$student->group->course_id;
            Payment::create($requestData);
            $sheetdb = new \SheetDB\SheetDB('6fmw9bjg3sfwt');
            $sheetdb->create([
                'ID' => $student->id,
                'STUDENT'=>$student->name,
                'COURSE'=>$student->group->name,
                'PAYMENTS'=>$request->amount,
                'DATE'=>$request->created_at,
            ]);
        });
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
