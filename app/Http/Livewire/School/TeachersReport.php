<?php

namespace App\Http\Livewire\School;

use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;

class TeachersReport extends Component
{
    public $start_date,$finished_date;
    public function mount()
    {
        $this->start_date=\Carbon\Carbon::now()->startOfMonth()->toDateString();
    }
    public function render()
    {
        $teachers=Teacher::school()->active()->withCount([
            'allStudents as registered_students'=>function($query){
                $query->when($this->start_date, function ($q){
                    $q->where('students.start_date', '>=', $this->start_date);
                })->when($this->finished_date, function ($q){
                    $q->where('students.start_date', '<=', $this->finished_date);
                });
            },
            'allStudents as left_students'=>function($query){
                $query->when($this->start_date, function ($q){
                    $q->where('students.outed_date', '>=', $this->start_date)->where('students.status', Student::OUT);
                })->when($this->finished_date, function ($q){
                    $q->where('students.outed_date', '<=', $this->finished_date)->where('students.status', Student::OUT);
                });
            }])
            ->get();

        return view('livewire.school.teachers-report', compact('teachers'))
            ->extends('layouts.school')
            ->section('content');
    }
}
