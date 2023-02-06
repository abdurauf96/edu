<?php
namespace App\Traits;

trait School{
    public function scopeSchool($query){
        return $query->where('school_id', auth()->guard('user')->user()->school_id);
    }
}
