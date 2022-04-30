<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentRepositoryInterface{
    public function getAll()
    {
        return Payment::school()->orderBy('id', 'DESC')->get();
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

    public function getPaymentResultsByMonth($year, $month)
    {
        $courses= Course::school()->get();
        $statistika=['all'=> ['fact_sum'=>0, 'real_sum'=>0] ];

        foreach ($courses as $course) {
            $fact_sum=0;
            foreach ($course->activeStudents as $s) {
                $fact_sum+=$s->type*$course->price;
            }
            array_push($statistika, [
                'course_name'=>$course->name,
                'number_students'=>count($course->activeStudents),
                'fact_sum'=>$fact_sum,
                'real_sum'=>collect($course->payments)->sum('amount')
            ]);

            $statistika['all']['fact_sum']+=$course->price*count($course->activeStudents);
            $statistika['all']['real_sum']+=collect($course->payments)->sum('amount');
        };

        return $statistika;
    }
}
