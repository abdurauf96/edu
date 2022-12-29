<?php

namespace App\Http\Livewire\Admin;

use App\Exports\StudentsExport;
use App\Models\School;
use App\Models\Student;
use App\Services\StudentService;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Students extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $school_id,$schools, $studentsToExportExcel,$start_date, $finished_date;
    public $status=3;
    public function mount()
    {

        $this->schools=School::all();

    }

    public function export(StudentService $service)
    {
        $data = $service->exportDataToAcademy($this->studentsToExportExcel);
        return Excel::download(new StudentsExport($data), 'students.xlsx');
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingSearch()
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

    public function updatingSchoolId()
    {
        $this->resetPage();
    }

    public function render(StudentService $studentService)
    {
        $students=Student::query();

        if($this->school_id){
            $students->where('school_id', $this->school_id);
        }

        if(isset($this->status) and $this->status!=3){
            $students->where('status', $this->status);
        }

        if(isset($this->start_date)){
            $students->where('start_date' , '>', $this->start_date);
        }

        if(isset($this->finished_date)){
            $students->where('finished_date', '<', $this->finished_date);
        }

        $students->where(function($query){
            $query->where('name', 'LIKE',  '%'.$this->search.'%')
                ->orWhere('id', 'LIKE', '%'.$this->search.'%');
        })->with('group', 'getSchool');

        $this->studentsToExportExcel=$students->get();
        $students=$students->paginate(10);


        return view('livewire.admin.students', ['students'=>$students]);
    }
}
