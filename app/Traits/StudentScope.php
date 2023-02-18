<?php

namespace App\Traits;

use App\Models\Event;
use App\Models\Group;

trait StudentScope
{
    public function scopeBoys($query)
    {
        return $query->where('sex', 1);
    }

    public function scopeGirls($query)
    {
        return $query->where('sex', 0);
    }

    public function scopeDebtors($query)
    {
        return $query->where('debt', '>', 0);
    }

    public function scopeNoDebt($query)
    {
        return $query->where('debt', '<=', 0);
    }

    public function scopeSchool($query)
    {
        return $query->where('school_id', auth()->guard('user')->user()->school_id);
    }
    public function scopeActive($query)
    {
        return $query->whereStatus(self::ACTIVE);
    }

    public function scopeGraduated($query)
    {
        return $query->whereStatus(self::GRADUATED);
    }

    public function scopeLeft($query)
    {
        return $query->whereStatus(self::OUT);
    }

    public function scopeLeftRecently($query)
    {
        $currentMonth=date('m');
        return $query->left()->whereMonth('outed_date', $currentMonth);
    }

    public function scopeDiscount($query)
    {
        return $query->active()->where('type', '!=', 1);
    }

    public function scopeGoodAttandance($query){
        $day=\Carbon\Carbon::today()->subWeek();
        return $query->active()
            ->whereHas('events', function ($q) use($day){
                $q->where('created_at', '>', $day);
            });
    }

    public function scopeBadAttandance($query){
        $ids=$this->goodAttandance()
                        ->pluck('id');
        return $query->active()->whereNotIn('id', $ids);
    }

    public function scopeWithLastEventStatus($query){
        $query->addSubSelect('last_event_status', Event::select('status')
            ->whereColumn('person_id', 'students.id')->where('type', 'student')
            ->latest());
    }

    public function scopeWithGroupName($query){
        $query->addSubSelect('group_name', Group::select('name')
            ->whereColumn('id', 'students.group_id'));
    }

}
