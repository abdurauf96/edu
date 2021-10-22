<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\WithPagination;
class Events extends Component
{
    use WithPagination;

    public $type;
    public $start_date;
    public $end_date;

    public function mount(){
        //$this->events=Event::school()->latest()->paginate(1);
    }

    public function render()
    {
        $events=Event::query();

        if($this->start_date){
            $events->where('created_at', '>', $this->start_date );
        }
        if($this->end_date){
            $events->where('created_at', '<', $this->end_date );
        }
        if($this->type){
            $events->where('type', $this->type );
        }

        $events=$events->where('school_id', auth()->guard('user')->user()->school_id)->latest()->paginate(10);

        return view('livewire.events', ['events'=>$events]);
    }
}
