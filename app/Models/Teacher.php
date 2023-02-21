<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\School;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\School as SchoolModel;
class Teacher extends Authenticatable
{
    use LogsActivity, School,SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teachers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['school_id', 'name', 'birthday', 'address', 'passport', 'phone', 'email', 'password', 'status', 'profession'];

    protected $attributes=[
        'status'=>1
    ];
    public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }
    public function scopeInActive($query)
    {
        return $query->where('status', 0);
    }
    public function getSchool()
    {
        return $this->belongsTo(SchoolModel::class, 'school_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'teacher_course');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Group::class)->where(['students.status'=>1]);
    }

    public function allStudents(){
        return $this->hasManyThrough(Student::class, Group::class);
    }

    public function debt_students()
    {
        return $this->students()->debtors()->get();
    }

    public function get_percent_debt_students()
    {
        if(count($this->students)>0){
            return (count($this->debt_students())*100)/count($this->students);
        }
        return false;
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($teacher) {
             $teacher->groups()->delete();
        });
        static::creating(function ($model){
            $model->school_id=auth()->guard('user')->user()->school_id;
        });

    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }


}
