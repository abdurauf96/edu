<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\WaitingStudent;
use Livewire\Component;
use Livewire\WithPagination;

class WaitingStudentsArchive extends Component
{
    use WithPagination;
    public $course_id;
    public $results=[];
    public $key;
    protected $paginationTheme = 'bootstrap';

    public function saveStatus()
    {
        foreach ($this->results as $id => $value){
            WaitingStudent::onlyTrashed()->where('id',$id)->update(['call_result'=>$value]);
        }
        $this->results=[];
    }

    public function restore($id)
    {
       $student = WaitingStudent::onlyTrashed()->where('id',$id)->restore();
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

        $waitingStudents=$waitingStudents->school()
            ->with('course')
            ->onlyTrashed()
            ->latest()
            ->paginate(10);

        $courses=Course::school()->get();
        return view('livewire.waiting-students-archive', ['waitingStudents'=>$waitingStudents, 'courses'=>$courses]);
    }
}
