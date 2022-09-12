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

    public $school_id,$schools, $status, $studentsToExportExcel;

    public function mount()
    {
        $this->schools=School::all();
    }

    public function export(StudentService $service)
    {
        $data=$service->exportDataToAcademy($this->studentsToExportExcel);
        return Excel::download(new StudentsExport($data), 'students.xlsx');
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingSchoolId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $students=Student::query();

        if($this->school_id){
            $students->where('school_id', $this->school_id);
        }

        if(isset($this->status)){
            $students->where('status', $this->status);
        }
        $students->with('group.course', 'getSchool');

        $this->studentsToExportExcel=$students->get();
        $students=$students->paginate(10);

        return view('livewire.admin.students', ['students'=>$students]);
    }
}
