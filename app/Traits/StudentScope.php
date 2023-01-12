<?php

namespace App\Traits;

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

    public function scopeSertificated($query)
    {
        return $query->where('sertificat_status', 1);
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

}
