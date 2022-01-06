<?php

namespace App\Http\Livewire;

use App\Models\WaitingStudent;
use Livewire\Component;
use Livewire\WithPagination;

class WaitingStudents extends Component
{
    use WithPagination;
    public $courses;
    public $course_id;
    public $results=[];
    public $key;
    protected $paginationTheme = 'bootstrap';


//    public function mount()
//    {
//        $this->waitingStudents=WaitingStudent::school()->latest()->paginate(10);
//    }


    public function saveStatus()
    {
        foreach ($this->results as $id => $value){
            WaitingStudent::find($id)->update(['call_result'=>$value]);
        }
        $this->results=[];
    }

    public function render()
    {
        $waitingStudents=WaitingStudent::query();

        if($this->course_id){
            $waitingStudents->where('course_id', $this->course_id);
        }
        if($this->key){
            $waitingStudents->where('name', 'like', '%'.$this->key.'%');
        }

        $waitingStudents=$waitingStudents->where('school_id', auth()->guard('user')->user()->school_id)->latest()->paginate(10);

        return view('livewire.waiting-students', ['waitingStudents'=>$waitingStudents]);
    }
}
