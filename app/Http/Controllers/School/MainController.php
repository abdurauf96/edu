<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
class MainController extends Controller
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
       
        $num_students=Student::school()->currentYear()->count();
        $num_groups=\App\Models\Group::school()->get()->count();

        $girls=Student::school()->currentYear()->whereSex('0')->count();
        $boys=Student::school()->currentYear()->whereSex(1)->count();
        $grant_students=Student::school()->grant()->count();

      
        $active_students=Student::active()->count();
        $out_students=Student::school()->out()->count();
        $graduated_students=Student::school()->graduated()->count();

        $teachers=\App\Models\Teacher::school()->with('students')->get();
        $courses=\App\Models\Course::school()->with('activeStudents')->get();

        return view('school.dashboard', compact(  'num_students', 'courses', 'num_groups', 'teachers', 'boys', 'girls', 'grant_students', 'active_students', 'out_students', 'graduated_students'));
    }

    public function paymentStatistics()
    {
        $statistika=$this->paymentRepo->getPaymentResultsByMonth(2021, date('m'));

        return view('school.payments.statistics', compact('statistika'));
    }

    public function reception()
    {
        return view('school.reception');
    }

    public function test()
    {
        //$students=\App\Models\Student::all();

        set_time_limit(600);
        //$response = Http::get('https://academy.digitalpark.uz/api/payments');
       //dd($response->json());
        // foreach ($response->json() as $data) {

        //     \App\Models\Payment::create($data);
        // }


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

        return redirect('/school/dashboard');

    }

}
