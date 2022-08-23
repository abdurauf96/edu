<?php

namespace App\Http\Livewire\School;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search='';
    public $creator_id, $status, $test_status;

    //protected $listeners = ['StatusChanged'];

    public function doActive($id)
    {
        $student=Student::find($id);
        $student->test_status==1 ? $student->test_status = null : $student->test_status=1;
        $student->save();
        $this->dispatchBrowserEvent('StatusChanged');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $creators = User::creators()->get();

        $students=Student::query();

        if($this->creator_id){
            $students->where('creator_id', $this->creator_id);
        }

        if(isset($this->status)){
            $students->where('status', $this->status);
        }

        $students=$students->latest()
            ->where('name', 'LIKE',  '%'.$this->search.'%')
            ->with('group.course')
            ->school()
            ->paginate(10);

        return view('livewire.school.students', ['students'=>$students, 'creators'=>$creators]);
    }
}
