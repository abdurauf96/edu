<?php

namespace App\Http\Livewire\School;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class Payments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $payments=Payment::school()
            ->orderBy('id', 'DESC')
            ->with('student')
            ->whereHas('student', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orWhere('type', 'like', '%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.school.payments', ['payments'=>$payments]);
    }
}
