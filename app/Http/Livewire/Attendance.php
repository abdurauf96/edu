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

        //$this->students=auth()->user()->students;

        if($this->group_id){
            $this->students=auth()->user()->students->where('group_id', $this->group_id);
        }
        return view('livewire.attendance');
    }
}
