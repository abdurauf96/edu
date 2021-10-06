<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\School;

class StudentActivity extends Model
{
    use HasFactory, School;

    protected $fillable=['student_id', 'description'];

    public static function boot() {
        parent::boot();

        static::creating(function ($model){
            $model->school_id=auth()->guard('user')->user()->school_id;
        });
    }
}
