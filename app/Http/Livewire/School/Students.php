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

    public $creator_id, $status, $query;



    public function render()
    {
        $creators = User::creators()->get();

        $students=Student::query();

        if($this->creator_id){
            $students->where('creator_id', $this->creator_id);
            $this->resetPage();
        }

        if(isset($this->status)){
            $students->where('status', $this->status);
            $this->resetPage();
        }

        if(isset($this->query)){
            $students->where('name', 'LIKE',  '%'.$this->query.'%');
            $this->resetPage();
        }

        $students=$students->latest()
            ->with('group.course')
            ->school()
            ->paginate(10);

        return view('livewire.school.students', ['students'=>$students, 'creators'=>$creators]);
    }
}
