<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sertificate extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['student_id', 'sertificate_id', 'course_id', 'type', 'date'];
}
