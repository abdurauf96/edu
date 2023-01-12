<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMessage extends Model
{
    use HasFactory;
    protected $fillable=['student_id', 'user_id', 'message'];

    public function creator()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
