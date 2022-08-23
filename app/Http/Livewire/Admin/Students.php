<?php

namespace App\Http\Livewire\Admin;

use App\Models\School;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $school_id,$schools, $status;

    public function mount()
    {
        $this->schools=School::all();
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

        $students=$students->with('group.course', 'getSchool')->paginate(10);
        return view('livewire.admin.students', ['students'=>$students]);
    }
}
