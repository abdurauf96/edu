<?php
namespace App\Traits;

trait School{

    public static function school(){
        return self::where('school_id', auth()->guard('user')->user()->school_id);
    }
}
