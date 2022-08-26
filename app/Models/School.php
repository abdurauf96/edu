<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class School extends Authenticatable
{
    use HasFactory;
    public const ACADEMY = 1;
    public const SCHOOL = 2;

    protected $fillable=['company_name', 'phone', 'addres', 'domain', 'director', 'status'];


    /**
        * The roles that belong to the School
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
        */
    public function isAcademy()
    {
        return $this->type==self::ACADEMY ;
    }

    public function isSchool()
    {
        return $this->type==self::SCHOOL ;
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
