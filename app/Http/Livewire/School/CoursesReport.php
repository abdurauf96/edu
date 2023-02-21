<?php

namespace App\Http\Livewire\School;

use App\Models\Course;
use Livewire\Component;

class CoursesReport extends Component
{
    public $start_date,$finished_date;
    public function mount()
    {
        $this->start_date=\Carbon\Carbon::now()->startOfMonth()->toDateString();
    }
    public function render()
    {
        $courses=Course::school()
            ->active()
            ->withCount([
            'students as registered_students'=>function($query){
            $query->when($this->start_date, function ($q){
                $q->where('students.start_date', '>=', $this->start_date);
            })->when($this->finished_date, function ($q){
                $q->where('students.start_date', '<=', $this->finished_date);
            });
        },
        'students as left_students'=>function($query){
            $query->when($this->start_date, function ($q){
                $q->where('students.outed_date', '>=', $this->start_date)->where('students.status', Course::OUT);
            })->when($this->finished_date, function ($q){
                $q->where('students.outed_date', '<=', $this->finished_date)->where('students.status', Course::OUT);
            });
        }])
        ->get();

        return view('livewire.school.courses-report', compact('courses'))
            ->extends('layouts.school')
            ->section('content');
    }
}
