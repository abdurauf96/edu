<?php

namespace App\Http\Livewire\School;

use App\Models\Event;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\StudentsExport;
use App\Services\StudentService;
use Maatwebsite\Excel\Facades\Excel;

class Students extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $creator_id, $test_status, $studentsToExportExcel, $type;
    public $status=1;
    //protected $listeners = ['StatusChanged'];

    public function doActive($id)
    {
        $student=Student::find($id);
        $student->test_status==1 ? $student->test_status = null : $student->test_status=1;
        $student->save();
        $this->dispatchBrowserEvent('StatusChanged');
    }

    public function export(StudentService $service)
    {
        $data=$service->exportDataToAcademy($this->studentsToExportExcel);
        return Excel::download(new StudentsExport($data), 'students.xlsx');
    }

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
        $creators = User::role('creator')->get();

        $students=Student::query();

        if($this->creator_id){
            $students->where('creator_id', $this->creator_id);
        }

        if(isset($this->status)){
            $students->where('status', $this->status);
        }

        if($this->type){
            $students->grant();
        }

        $students->latest()
            ->select('id', 'name', 'debt','test_status','group_id')
            ->where(function($query){
                $query->where('name', 'LIKE',  '%'.$this->search.'%')
                    ->orWhere('id', 'LIKE', '%'.$this->search.'%');
            })
            ->with([
                'group'=>function($query){
                    $query->select('id', 'course_id', 'name');
                },
                'group.course' => function($query){
                    $query->select('id', 'name');
            }])
            ->addSubSelect('last_event_status', Event::select('status')
                ->whereColumn('person_id', 'students.id')->where('type', 'student')
                ->latest())
            ->school();

        $this->studentsToExportExcel=$students->get();

        $students=$students->paginate(10);
      
        return view('livewire.school.students', ['students'=>$students, 'creators'=>$creators]);
    }
}