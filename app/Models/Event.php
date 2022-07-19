<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, \App\Traits\School;
    protected $fillable=['name', 'person_id', 'status', 'time', 'type', 'school_id','organization_id'];
    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
