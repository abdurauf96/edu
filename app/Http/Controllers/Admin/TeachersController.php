<?php


namespace App\Http\Controllers\Admin;


use App\Models\School;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeachersController
{
    public $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService=$teacherService;
    }

    public function index()
    {
        $teachers=Teacher::query();
        if(auth()->user()->hasRole('xtb')){
            $schoolsId=School::school()->get()->pluck('id')->toArray();
            $teachers->whereIn('school_id', $schoolsId);
        }
        $teachers=$teachers->with('getSchool.district')->latest()->paginate(10);

        if(request()->has('export')){
            return $this->teacherService->exportToExcel($teachers);
        }
        return view('admin.teachers.index', compact('teachers'));
    }
}
