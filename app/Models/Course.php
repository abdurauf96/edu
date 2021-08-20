<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use LogsActivity;

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
        return $this->hasManyThrough(Student::class, Group::class);
    }

    public function activeStudents()
    {
        return $this->hasManyThrough(Student::class, Group::class)->where('students.status', 1);
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
    protected $fillable = ['name', 'duration', 'price', 'code'];

    public static function boot() {
        parent::boot();
        static::deleting(function($course) {
             $course->groups()->delete();
             $course->teachers()->delete();
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
