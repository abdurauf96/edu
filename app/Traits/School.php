<?php
namespace App\Traits;

trait School{
    public function scopeSchool(){
        return self::where('school_id', auth()->guard('user')->user()->school_id);
    }
}
