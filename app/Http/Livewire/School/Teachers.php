<?php

namespace App\Http\Livewire\School;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class Teachers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $status='active';
    public $search='';
    protected $queryString = [
        'status'=>['except'=>''],
        'search'=>['except'=>''],
    ];
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
        $teachers=Teacher::query();
        if($this->status){
            if($this->status=='active'){
                $teachers=$teachers->active();
            }else{
                $teachers->inActive();
            }
        }
        $teachers->latest()
            ->where(function($query){
                $query->where('name', 'LIKE',  '%'.$this->search.'%')
                    ->orWhere('id', 'LIKE', '%'.$this->search.'%');
            })
            ->with([
                'courses' => function($query){
                    $query->select('name');
                }
            ])->school();
        $teachers=$teachers->paginate(10);
        return view('livewire.school.teachers', ['teachers'=>$teachers]);
    }
}
