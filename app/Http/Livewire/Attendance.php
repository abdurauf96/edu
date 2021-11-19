<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class Attendance extends Component
{
    public $group_id;
    public $date;
    public $students=[];
    public $eventIds=[];
    public function mount()
    {
        $this->date=Carbon::today();
    }
    public function render()
    {

        //$students=auth()->user()->students;

        $teacherStudents=Event::query();

        if($this->group_id){
            $this->students=auth()->user()->students->where('group_id', $this->group_id);
            $ids=$this->students->pluck('id')->toArray();
            $teacherStudents->whereDate('created_at', $this->date);
            $this->eventIds=$teacherStudents->where('type', 'student')->whereIn('person_id', $ids)->pluck('person_id')->toArray();
        }
        return view('livewire.attendance');
    }
}
