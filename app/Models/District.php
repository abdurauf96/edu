<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function students()
    {
        return $this->hasMany(Student::class)->where('status', 1)->where('school_id', auth()->guard('user')->user()->school_id);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
