<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\WithPagination;
class Events extends Component
{
    use WithPagination;

    public $type,$start_date,$end_date,$event,$apply;
    public $statistika=[];

    public function mount()
    {
        $this->statistika['numberTodayStudents']=Event::school()
        ->whereDate('created_at', date('Y-m-d'))
        ->where('type','student')
        ->where('status', 1)
        ->count();
        $this->statistika['numberTodayStaffs']=$this->countStaffs();
    }

    public function countStaffs()
    {
        return Event::school()
            ->whereDate('created_at', date('Y-m-d'))
            ->where('type','staff')
            ->where('status', 1)
            ->count();
    }

    public function render()
    {
        $events=Event::query();

        if(isset($this->event)){
            $events->where('status', $this->event);
        }
        if($this->apply){
            if($this->start_date){
                $events->where('created_at', '>=', $this->start_date );
            }
            if($this->end_date){
                $events->where('created_at', '<=', $this->end_date );
            }
        }

        if($this->type){
            if($this->type=='student'){
                $events->where('type', 'student');
            }else{
                $events->where('type', 'staff');
            }
        }

        $events=$events->where('school_id', auth()->guard('user')->user()->school_id)
        ->latest()
        ->paginate(10);

        return view('livewire.events', ['events'=>$events]);
    }
}
