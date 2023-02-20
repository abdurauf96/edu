<?php

namespace App\Http\Livewire\School;

use App\Models\Group;
use Livewire\Component;

class GroupsReport extends Component
{
    public $activeGroupsCount,$newGroupsCount,$finishedGroupsCount,$start_date,$finished_date;
    public function mount()
    {
        $this->start_date=\Carbon\Carbon::now()->startOfMonth()->toDateString();
    }
    public function render()
    {
        $this->activeGroupsCount=$this->getActiveGroupsCount();
        $this->newGroupsCount=$this->getNewGroupsCount();
        $this->finishedGroupsCount=$this->getFinishedGroupsCount();

        return view('livewire.school.groups-report')
            ->extends('layouts.school')
            ->section('content');
    }
    public function getActiveGroupsCount()
    {
        return Group::school()
            ->when($this->start_date, function ($q){
                return $q->where('start_date', '<', $this->start_date)
                    ->where('end_date', '>', $this->start_date);
            })
            ->when($this->finished_date, function ($q){
                return $q->where('start_date', '<', $this->finished_date)
                    ->where('end_date', '>', $this->finished_date);
            })
            ->when(!$this->start_date and !$this->finished_date, function ($q){
                return $q->type('active');
            })
            ->count();
    }

    public function getNewGroupsCount()
    {
        return Group::school()
            ->when($this->start_date, function ($q){
                return $q->where('start_date', '>=', $this->start_date);
            })
            ->when($this->finished_date, function ($q){
                return $q->where('start_date', '<=', $this->finished_date);
            })
            ->count();
    }

    public function getFinishedGroupsCount()
    {
        return Group::school()
            ->when($this->start_date, function ($q){
                return $q->where('end_date', '>=', $this->start_date);
            })
            ->when($this->finished_date, function ($q){
                return $q->where('end_date', '<=', $this->finished_date);
            })
            ->count();
    }
}
