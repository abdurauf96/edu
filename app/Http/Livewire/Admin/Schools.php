<?php

namespace App\Http\Livewire\Admin;

use App\Models\School;
use Livewire\Component;
use App\Services\SchoolService;
use Livewire\WithPagination;

class Schools extends Component
{
    protected $schoolService;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(SchoolService $schoolService)
    {
        $this->schoolService=$schoolService;
    }

    public function exportToExcel(SchoolService $schoolService)
    {
        $schools=School::latest()->get();
        return $schoolService->exportToExcel($schools);
    }

    public function delete($id)
    {
        $school=School::find($id);
        $school->users()->delete();
        $school->delete();
        return back()->with('message', 'maktab o`chirib yuborildi!');
    }
    public function render()
    {
        $schools=School::latest()->paginate(10);
        return view('livewire.admin.schools', compact('schools'));
    }
}
