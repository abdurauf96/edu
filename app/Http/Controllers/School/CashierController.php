<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
class CashierController extends Controller
{

    public function index(PaymentRepositoryInterface $paymentRepo, Request $request)
    {
        $payments=$paymentRepo->getAll();
        
        if(!empty($course_id=$request->course_id)){
            $course=\App\Models\Course::find($course_id);
            $students=$course->students;
            $ids=[];
            foreach ($students as $student) {
                array_push($ids, $student->id);
            }
            $payments=$payments->whereIn('student_id', $ids);
        }
        if(!empty($month_id=$request->month_id)){
            $payments=$payments->where('month_id', $month_id);
        }
     
      
        $courses=\App\Models\Course::school()->get();
        $months=\App\Models\Month::all();
        return view('school.cashier.table', compact('payments', 'courses', 'months'));
    }
}
