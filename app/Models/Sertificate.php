<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertificate extends Model
{
    use HasFactory;
    protected $fillable=['student_id', 'sertificate_id', 'course_id', 'type', 'date','name','surname'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
