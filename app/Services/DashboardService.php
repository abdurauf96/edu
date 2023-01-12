<?php
namespace App\Services ;

use App\Models\Group;
use App\Models\School;
use App\Models\Student;

class DashboardService{
    public $schoolsId;

    public function __construct()
    {
        $this->schoolsId=School::get()->pluck('id')->toArray();
    }

    public function getSchoolStudentsStatistics()
    {
        $students = Student::whereIn('school_id', $this->schoolsId)->selectRaw('count(*) as total')
            ->selectRaw("count(case when status='".Student::ACTIVE."' then 1 end) as active")
            ->selectRaw("count(case when status='".Student::GRADUATED."' then 1 end) as graduated")
            ->selectRaw("count(case when status='".Student::OUT."' then 1 end) as outed")
            ->selectRaw("count(case when sex='1' then 1 end) as boys")
            ->selectRaw("count(case when sex='0' then 1 end) as girls")
            ->first();
        return $students;
    }

    public function getQuantityGroups()
    {
        return Group::whereIn('school_id', $this->schoolsId)->get()->count() ;
    }

    public function getAllStudentsStatistics()
    {
        $students = Student::selectRaw('count(*) as total')
            ->selectRaw("count(case when status='".Student::ACTIVE."' then 1 end) as active")
            ->selectRaw("count(case when status='".Student::GRADUATED."' then 1 end) as graduated")
            ->selectRaw("count(case when status='".Student::OUT."' then 1 end) as outed")
            ->selectRaw("count(case when sex='1' then 1 end) as boys")
            ->selectRaw("count(case when sex='0' then 1 end) as girls")
            ->first();
        return $students;
    }

    public function getSchoolStatistics()
    {
        $schools=School::query();
        $schools->withCount(['students', 'groups',   'students as active_students_count'=> function($query){
            $query->active();
        },'students as graduated_students_count'=> function($query){
            $query->graduated();
        },'students as outed_students_count'=> function($query){
            $query->left();
        }, 'students as girls_count'=> function($query){
            $query->where('sex', 0);
        }, 'students as boys_count'=> function($query){
            $query->where('sex', 1);
        }]);

        if(auth()->user()->hasRole('xtb')){
            $schools->school();
        }
        return $schools->get();
    }
}
