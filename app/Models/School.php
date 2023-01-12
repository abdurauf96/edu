<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class School extends Authenticatable
{
    use HasFactory;

    protected $fillable=['company_name', 'phone', 'addres', 'domain', 'director', 'status', 'district_id', 'email'];

    /**
        * The roles that belong to the School
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
        */

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function groups()
    {
        return $this->hasManyThrough(Group::class, Course::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }

}
