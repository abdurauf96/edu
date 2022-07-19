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

    public $organizations;
    public $organization_id;
    public $onlyStudents;
    public $start_date;
    public $end_date;
    public $event;
    public $statistika=[];

    public function mount(){

        $this->organizations = Organization::school()->latest()->get();

        $this->statistika['numberTodayStudents']=Event::school()
        ->whereDate('created_at', date('Y-m-d'))
        ->where('type','student')
        ->where('status', 1)
        ->count();
        $this->statistika['numberTodayStaffs']=$this->countStaffs();

    }

    public function countStaffs($organization_id=null)
    {
        return Event::school()
            ->whereDate('created_at', date('Y-m-d'))
            ->where('type','staff')
            ->where('status', 1)
            ->when($organization_id, function ($query) use ($organization_id){
                return $query->where('organization_id', $organization_id);
            })
            ->count();
    }

    public function render()
    {
        $events=Event::query();

        if(isset($this->event)){
            $events->where('status', $this->event);
        }
        if($this->start_date){
            $events->where('created_at', '>', $this->start_date );
        }
        if($this->end_date){
            $events->where('created_at', '<', $this->end_date );
        }
        if($this->onlyStudents){
            $events->where('type', 'student');
        }
        if($this->organization_id){
            $events->where('organization_id', $this->organization_id);
            $this->statistika['numberTodayStaffs']=$this->countStaffs($this->organization_id);
        }
        $events=$events->where('school_id', auth()->guard('user')->user()->school_id)
        ->latest()
        ->paginate(10);

        return view('livewire.events', ['events'=>$events]);
    }
}
