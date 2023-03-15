<?php

namespace App\Http\Livewire\School;

use App\Models\Payment;
use App\Models\Teacher;
use App\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class Payments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $group_id,$type,$groups,$start_date,$end_date;

    protected $queryString = [
        'group_id'=>['except'=>''],
        'type'=>['except'=>''],
        'search'=>['except'=>''],
        'start_date'=>['except'=>''],
        'end_date'=>['except'=>''],
    ];

    public function mount(){
        $this->groups=Group::school()->select('id','name')->whereStatus(true)->get();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingGroupId()
    {
        $this->resetPage();
    }
    public function updatingType()
    {
        $this->resetPage();
    }
    public function updatingStartDate()
    {
        $this->resetPage();
    }
    public function updatingEndDate()
    {
        $this->resetPage();
    }

    public function render()
    {
        $payments=Payment::school()
            ->when($this->group_id, function ($query){
                return $query->whereHas('student', function ($query) {
                    $query->where('group_id', $this->group_id);
                });
            })
            ->when($this->type, function ($query){
                return $query->where('type', $this->type);
            })
            ->when($this->start_date, function ($query){
                return $query->where('created_at', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query){
                return $query->where('created_at', '<=', $this->end_date);
            })
            ->orderby('id','desc')
            ->withStudentName()
            ->whereHas('student', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('id', 'like', '%'.$this->search.'%');
            })
            ->paginate(10);

        return view('livewire.school.payments', ['payments'=>$payments]);
    }
}
