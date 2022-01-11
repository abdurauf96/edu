<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\School;

class Course extends Model
{
    use LogsActivity, School;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

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
    protected $fillable = ['school_id', 'name', 'duration', 'price', 'code', 'description'];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_course');
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Group::class)->where('students.study_year',2022);
    }

    public function activeStudents()
    {
        return $this->hasManyThrough(Student::class, Group::class)->where(['students.status'=>1,'students.study_year'=>2022]);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function waitingStudents()
    {
        return $this->hasMany(WaitingStudent::class);
    }

    public function getPaymentsByMonth($month_id, $year)
    {
        return $this->payments->where('month_id', $month_id)->where('year', $year);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($course) {
             $course->groups()->delete();
             $course->teachers()->delete();
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
