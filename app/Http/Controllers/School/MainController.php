<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\StudentService;
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
    public $studentService;

    public function __construct(PaymentRepositoryInterface $paymentRepository, StudentService $studentService)
    {
        $this->paymentRepo=$paymentRepository;
        $this->studentService=$studentService;
    }

    public function index()
    {
        $num_groups=\App\Models\Group::school()->type('active')->get()->count();

        $courses=\App\Models\Course::school()
            ->withCount(['students as active_students_count' => function ($query) {
                    $query->where('students.status', Course::ACTIVE);
                    },
        ])->get();

        $students = $this->studentService->countByTypes();


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
        $groups=Group::whereIn('course_days', [$courseDays,Group::EVERYDAY])
            ->with('course', 'teacher')
            ->withCount('students')
            ->type('active')
            ->get();
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

}
