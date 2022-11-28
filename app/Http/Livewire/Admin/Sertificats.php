<?php

namespace App\Http\Livewire\Admin;

use App\Exports\SchoolStudentsExport;
use App\Models\School;
use App\Models\Student;
use App\Services\StudentService;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Sertificats extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $school_id,$schools, $status, $studentsToExportExcel;

    public function mount()
    {
        $this->status=0;
        if(auth()->user()->hasRole('super-admin')){
            $this->schools=School::all();
        }else{
            $this->schools=School::school()->get();
        }
    }

    public function export(StudentService $service)
    {
        $data=$service->exportDataToSchool($this->studentsToExportExcel);
        return Excel::download(new SchoolStudentsExport($data), 'students.xlsx');
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingSchoolId()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(StudentService $studentService)
    {
        $students=Student::query();

        if($this->school_id){
            $students->where('school_id', $this->school_id);
        }

        if(isset($this->status)){
            $students->where('status', $this->status);
        }

        if(auth()->user()->hasRole('xtb')){
            $schoolsId=School::school()->get()->pluck('id')->toArray();
            $students->whereIn('school_id', $schoolsId);
        }

        $students->where(function($query){
            $query->where('name', 'LIKE',  '%'.$this->search.'%')
                ->orWhere('id', 'LIKE', '%'.$this->search.'%');
        })->with('group', 'getSchool');

        $this->studentsToExportExcel=$students->get();
        $students=$students->paginate(10);


        return view('livewire.admin.sertificats', ['students'=>$students]);
    }
}
