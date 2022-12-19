<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Group;
use App\Models\School;
use App\Models\Clas;

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
        $num_groups=\App\Models\Group::school()->type('active')->get()->count();

        $courses=\App\Models\Course::school()
            ->withCount(['students as active_students_count' => function ($query) {
                    $query->where('students.status', Course::ACTIVE);
                    },
        ])->get();

        $students = Student::school()
            ->selectRaw("count(case when status='".Student::ACTIVE."' then 1 end) as count_active")
            ->selectRaw("count(case when status='".Student::GRADUATED."' then 1 end) as count_graduated")
            ->selectRaw("count(case when status='".Student::OUT."' then 1 end) as count_outed")
            ->selectRaw("count(case when sex='1' and status='".Student::ACTIVE."' then 1 end ) as count_boys")
            ->selectRaw("count(case when sex='0' and status='".Student::ACTIVE."' then 1 end) as count_girls")
            ->selectRaw("count(case when sex='0' and status='".Student::ACTIVE."' then 1 end) as count_girls")
            ->first();


        if(is_school()){
            $classes=Clas::withCount('students')->get();

            return view('school.school-dashboard', compact('students', 'num_groups',  'courses', 'classes'));

        }else{

            $grant_students=Student::school()->grant()->count();

            $teachers=\App\Models\Teacher::school()->whereStatus(1)->with(['students','courses'])->get();

            return view('school.academy-dashboard', compact( 'students','courses', 'num_groups', 'teachers','grant_students'));
        }
    }

    public function todayGroups()
    {
        $numberDay = date('N', strtotime(date("l")));
        $courseDays= $numberDay%2==0 ? Group::EVEN_DAYS : Group::ODD_DAYS;
        $groups=Group::whereIn('course_days', [$courseDays,Group::EVERYDAY])->where('status', '!=', 2)->get();
        //dd($groups);
        return view('school.groups.todayGroups', compact('groups'));
    }

    public function paymentStatistics()
    {
        $statistika=$this->paymentRepo->getPaymentResultsByMonth(date('m'), date('Y'));
        $students=Student::active()->school()->get();
        $payments=$this->paymentRepo->getPaymentsByMonth(date('m'), date('Y'));

        return view('school.payments.statistics', compact('statistika','students', 'payments'));
    }

    public function contacts()
    {
        $contacts=\App\Models\Contact::all();
        return view('school.contacts.index', compact('contacts'));
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
