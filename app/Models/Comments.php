<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongTo(Student::class, 'student_id');
    }

    public function userauth()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
