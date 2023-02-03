<?php

namespace App\Http\Livewire\School;

use App\Models\Course;
use App\Models\Group;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class Groups extends Component
{
    use WithPagination;
    public $courses,$teachers,$start_date,$end_date,$teacher_id,$course_id,$days;
    public $status='active';
    protected $queryString=[
        'status'=>['except'=>''],
        'course_id'=>['except'=>''],
        'teacher_id'=>['except'=>''],
        'days'=>['except'=>''],
        'start_date'=>['except'=>''],
        'end_date'=>['except'=>''],
    ];
    public function mount()
    {
        $this->courses = Course::select('id', 'name')->school()->whereNotNull('is_for_bot')->latest()->get();
        $this->teachers = Teacher::select('id', 'name')->school()->active()->latest()->get();
    }
    public function render()
    {
        $groups = Group::query();
//        if($this->status){
//            $groups->type($this->status);
//        }

        $groups=$groups->select('id', 'name', 'start_date', 'end_date', 'room_number')
            ->when($this->status, function ($query){
                return $query->type($this->status);
            })
            ->when($this->course_id, function ($query){
                return $query->where('course_id', $this->courses);
            })
            ->when($this->teacher_id, function ($query){
                return $query->where('teacher_id', $this->teacher_id);
            })
            ->when($this->start_date, function ($query){
                return $query->where('start_date', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query){
                return $query->where('end_date', '<=', $this->end_date);
            })
            ->withCourseName()
            ->withTeacherName()
            ->withCount('students')
            ->latest()
            ->paginate(10);

        return view('livewire.school.groups', compact('groups'));
    }
}
