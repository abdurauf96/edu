<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotStudent extends Model
{
    use HasFactory;
    protected $fillable=['chat_id', 'course_id', 'fio', 'phone', 'status', 'finished'];
}
