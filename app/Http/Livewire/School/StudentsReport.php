<?php

namespace App\Http\Livewire\School;

use App\Models\Student;
use Livewire\Component;

class StudentsReport extends Component
{
    public $start_date,$finished_date, $payedStudentsCount,$activeStudentsCount,$leftStudentsCount,$newStudentsCount,$graduatedStudentsCount;
    public function mount()
    {
        $this->start_date=\Carbon\Carbon::now()->startOfMonth()->toDateString();
    }
    public function render()
    {
        $this->activeStudentsCount=$this->getActiveStudentsCount();
        $this->payedStudentsCount=$this->getPayedStudentsCount();
        $this->leftStudentsCount=$this->getLeftStudentsCount();
        $this->newStudentsCount=$this->getNewStudentsCount();
        $this->graduatedStudentsCount=$this->getGraduatedStudentsCount();

        return view('livewire.school.students-report')
            ->extends('layouts.school')
            ->section('content');
    }
    public function getGraduatedStudentsCount()
    {
        return Student::school()
            ->when($this->start_date, function ($q){
                return $q->where('finished_date', '>=', $this->start_date);
            })
            ->when($this->finished_date, function ($q){
                return $q->where('finished_date', '<=', $this->finished_date);
            })
            ->count();
    }
    public function getNewStudentsCount()
    {
        return Student::school()
            ->when($this->start_date, function ($q){
                return $q->where('start_date', '>=', $this->start_date);
            })
            ->when($this->finished_date, function ($q){
                return $q->where('start_date', '<', $this->finished_date);
            })
            ->count();
    }
    public function getLeftStudentsCount()
    {
        return Student::school()
            ->when($this->start_date, function ($q){
                return $q->where('outed_date', '>=', $this->start_date);
            })
            ->when($this->finished_date, function ($q){
                return $q->where('outed_date', '<=', $this->finished_date);
            })
            ->left()
            ->count();
    }
    public function getPayedStudentsCount()
    {
        return Student::school()->whereHas('payments', function ($query){
            $query->when($this->start_date, function ($q){
                $q->where('created_at', '>=', $this->start_date);
            })->when($this->finished_date, function ($q){
                $q->where('created_at', '<=', $this->finished_date);
            });
        })->count();
    }

    public function getActiveStudentsCount()
    {
        return Student::school()
            ->when($this->start_date, function ($q){
                return $q->where('start_date', '<', $this->start_date)
                    ->where('finished_date', '>', $this->start_date);
            })
            ->when($this->finished_date, function ($q){
                return $q->where('start_date', '<', $this->finished_date)
                    ->where('finished_date', '>', $this->finished_date);
            })
            ->when(!$this->start_date and !$this->finished_date, function ($q){
                return $q->active();
            })
            ->count();
    }
}
