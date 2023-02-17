<?php

namespace App\Http\Livewire\School;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Debtors extends Component
{
    use WithPagination;

    public $min_debt,$max_debt,$search,$totalDebt;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'min_debt'=>['except'=>''],
        'max_debt'=>['except'=>''],
        'search'=>['except'=>''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingMinDebt()
    {
        $this->resetPage();
    }

    public function updatingMaxDebt()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->totalDebt=Student::school()->debtors()->select('debt')->sum('debt');
    }

    public function render()
    {
        $debtors=Student::school()
            ->when($this->min_debt, function ($query){
                return $query->where('debt', '>', $this->min_debt);
            })
            ->when($this->max_debt, function ($query){
                return $query->where('debt', '<', $this->max_debt);
            })
            ->where('name', 'LIKE',  '%'.$this->search.'%')
            ->debtors()
            ->withGroupName()
            ->paginate(10);
        return view('livewire.school.debtors', compact('debtors'));
    }
}
