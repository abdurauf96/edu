<?php

namespace App\Http\Livewire\School;

use App\Models\Course;
use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\StudentsExport;
use App\Services\StudentService;
use Maatwebsite\Excel\Facades\Excel;

class Students extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $studentsToExportExcel, $course_id,$courses, $payment, $gender, $manager_id,$creators;
    public $status='active';

    protected $queryString = [
        'course_id'=>['except'=>''],
        'status'=>['except'=>''],
        'search'=>['except'=>''],
        'payment'=>['except'=>''],
        'gender',
        'manager_id'=>['except'=>''],
    ];

    public function mount(){
        $this->courses=Course::school()->whereStatus(true)->get();
        $this->creators=User::role('creator')->get();
    }

    public function export(StudentService $studentService)
    {
        $data=$studentService->exportDataToAcademy($this->studentsToExportExcel);
        return Excel::download(new StudentsExport($data), 'students.xlsx');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingCourseId()
    {
        $this->resetPage();
    }

    public function updatingManagerId()
    {
        $this->resetPage();
    }

    public function updatingPayment()
    {
        $this->resetPage();
    }

    public function render()
    {

        $students=Student::query();

        if($this->course_id){
            $group_ids=Group::where('course_id', $this->course_id)->pluck('id');
            $students->whereIn('group_id', $group_ids);
        }

        if($this->manager_id){
            $students->whereHas('group', function($q) {
                $q->where('user_id', $this->manager_id);
            });
        }

        if($this->payment){

            if($this->payment=='debtors'){

                $students->debtors();

            }elseif($this->payment=='discount'){

                $students->discount();

            }elseif($this->payment=='no-debt'){

                $students->noDebt();

            }
        }

        if($this->gender){
            switch ($this->gender){
                case 'girls':
                    $students->girls();
                    break;
                case 'boys':
                    $students->boys();
                    break;
            }
        }

        if($this->status){
            switch ($this->status){
                case 'active':
                    $students->active();
                    break;
                case 'graduated':
                    $students->graduated();
                    break;
                case 'left':
                    $students->left();
                    break;
                case 'left-recently':
                    $students->leftRecently();
                    break;
                case 'good-attandance':
                    $students->goodAttandance();
                    break;
                case 'bad-attandance':
                    $students->badAttandance();
                    break;
            }
        }

        $students->latest()
            ->select('id', 'name', 'debt','test_status','group_id','status')
            ->where(function($query){
                $query->where('name', 'LIKE',  '%'.$this->search.'%')
                    ->orWhere('id', 'LIKE', '%'.$this->search.'%');
            })
            ->with([
                'group'=>function($query){
                    $query->select('id', 'course_id', 'name', 'start_date', 'end_date', 'teacher_id');
                },
                'group.course' => function($query){
                    $query->select('id', 'name');
                },
                'group.teacher' => function($query){
                    $query->select('id', 'name');
                },
            ])
            ->school();

        $this->studentsToExportExcel=$students->get();

        $students=$students->paginate(10);

        return view('livewire.school.students', ['students'=>$students]);
    }
}
