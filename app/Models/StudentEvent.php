<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEvent extends Model
{
    use HasFactory;

    protected $fillable=['student_id', 'status', 'time'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
}
