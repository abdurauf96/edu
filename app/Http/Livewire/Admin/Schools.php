<?php

namespace App\Http\Livewire\Admin;

use App\Models\School;
use Livewire\Component;
use App\Services\SchoolService;

class Schools extends Component
{
    protected $schoolService;

    public function mount(SchoolService $schoolService)
    {
        $this->schoolService=$schoolService;
    }

    public function exportToExcel(SchoolService $schoolService)
    {
        if(auth()->user()->hasRole('super-admin')){
            $schools=School::latest()->get();
        }else{
            $schools=School::school()->latest()->get();
        }

        return $schoolService->exportToExcel($schools);
    }

    public function render()
    {
        $schools=School::school()->latest()->paginate(10);
        return view('livewire.admin.schools', compact('schools'));
    }
}
