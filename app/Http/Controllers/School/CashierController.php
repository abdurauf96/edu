<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class CashierController extends Controller
{

    public function index()
    {
        $payments=Payment::query();

        if(request()->get('course_id')){
            $course_id=request()->get('course_id');
            $course=\App\Models\Course::find($course_id);
            $students=$course->students;
            $ids=[];
            foreach ($students as $student) {
                array_push($ids, $student->id);
            }
            $payments=$payments->whereIn('student_id', $ids);
            
        }
        if(request()->get('month_id')){
            $month_id=request()->get('month_id');
            $payments=$payments->where('month_id', $month_id);
        }
        $payments = $payments->get();
        
        $courses=\App\Models\Course::all();
        $months=\App\Models\Month::all();
        return view('school.cashier.table', compact('payments', 'courses', 'months'));
    }
}
