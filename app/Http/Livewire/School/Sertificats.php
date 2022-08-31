<?php

namespace App\Http\Livewire\School;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Sertificats extends Component
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
        $students=Student::query();

        $students=$students->latest()
            ->where('name', 'LIKE',  '%'.$this->search.'%')
            ->with('group.course')
            ->school()
            ->sertificated()
            ->paginate(10);

        return view('livewire.school.sertificats', ['students'=>$students]);
    }

}
