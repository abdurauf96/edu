<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public $paymentRepo;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepo=$paymentRepository;
    }

    public function index()
    {
        
        $num_students=\App\Models\Student::all()->count();
        $num_groups=\App\Models\Group::all()->count();

        $girls=\App\Models\Student::whereSex('0')->count();
        $boys=\App\Models\Student::whereSex(1)->count();
        $grant_students=\App\Models\Student::whereType(1)->count();
        $active_students=\App\Models\Student::whereStatus(1)->count();

        $teachers=\App\Models\Teacher::with('students')->get();
        $courses=\App\Models\Course::with('students')->get();

        return view('admin.dashboard', compact(  'num_students', 'courses', 'num_groups', 'teachers', 'boys', 'girls', 'grant_students', 'active_students'));
    }

    public function paymentStatistics()
    {
        $statistika=$this->paymentRepo->getPaymentResultsByMonth(2021, date('m'));

        return view('admin.payments.statistics', compact('statistika'));
    }


    public function test()
    {
        $students=\App\Models\Student::all();
        
        set_time_limit(600);
        
        // $num=1;
        // foreach ($students as $student) {
            
        //     //21MDC001 ~ year - course_code - student_number
        //     $number = str_pad($num, 4, 0, STR_PAD_LEFT);
        //     $course_code=$student->group->course->code;
        //     $current_year=date('y');
        //     $student->student_number=$current_year.$course_code.$number;
            
        //     $year=explode('-', $student->year);
        //     $reversed=array_reverse($year);
        //     $year=implode('', $reversed);
           
        //     $student->password=bcrypt($year);
        //     $student->save();
           
        // }


        // foreach($students as $student){
        //     $filename=str_replace(' ', '-', $student->name).'-'.time().'.png';
        //     $student->code=$filename;
        //     $student->save();

        //     $this->createQRCode($student->id, $filename, 'student');
             
        // }       
       
        return redirect('/dashboard');

    }

}
