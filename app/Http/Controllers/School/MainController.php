<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Services\StudentService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Group;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public $studentService;
    public $teacherRepo;

    public function __construct(StudentService $studentService, TeacherRepositoryInterface $teacherRepo)
    {
        $this->studentService=$studentService;
        $this->teacherRepo=$teacherRepo;
    }

    public function index()
    {
        $num_groups=\App\Models\Group::school()->type('active')->count();

        $num_teachers=$this->teacherRepo->numberActives();

        $courses=\App\Models\Course::school()->select('name')
            ->withCount(['students as active_students_count' => function ($query) {
                    $query->where('students.status', Course::ACTIVE);
                    },
        ])->get();

        $students = $this->studentService->countByTypes();

        $count_good_attandance=$this->studentService->countGoodAttandance();

        $count_bad_attandance=$this->studentService->countBadAttandance();

        $left_this_month=$this->studentService->countLeftThisMonth();

        return view('school.dashboard', compact( 'students','courses', 'num_groups', 'num_teachers','count_good_attandance','count_bad_attandance', 'left_this_month'));

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

}
