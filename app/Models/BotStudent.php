<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\School;

class BotStudent extends Model
{
    use HasFactory, School;
    protected $fillable=['chat_id', 'course_id', 'fio', 'phone', 'status', 'finished'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
