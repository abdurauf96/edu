<?php

namespace App\Http\Livewire\School;

use App\Models\Student;
use App\Models\User;
use App\Services\StudentService;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SchoolStudentsExport;

class SchoolStudents extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $studentsToExportExcel, $start_date, $finished_date;
    public $status=3;
    //protected $listeners = ['StatusChanged'];

    public function export(StudentService $service)
    {
        $data=$service->exportDataToSchool($this->studentsToExportExcel);
        return Excel::download(new  SchoolStudentsExport($data), 'students.xlsx');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingStartDate()
    {
        $this->resetPage();
    }

    public function updatingFinishedDate()
    {
        $this->resetPage();
    }

    public function render()
    {
        $students=Student::query();

        if(isset($this->status) and $this->status!=3){
            $students->where('status', $this->status);
        }

        if(isset($this->start_date)){
            $students->where('start_date' , '>', $this->start_date);
        }

        if(isset($this->finished_date)){
            $students->where('finished_date', '<', $this->finished_date);
        }

        $students->latest()
            ->where(function($query){
                $query->where('name', 'LIKE',  '%'.$this->search.'%')
                    ->orWhere('id', 'LIKE', '%'.$this->search.'%');
            })
            ->with('group.course','district', 'group.teacher', 'clas')
            ->school();
        $this->studentsToExportExcel=$students->get();
        $students=$students->paginate(10);

        return view('livewire.school.school-students', ['students'=>$students]);
    }
}
