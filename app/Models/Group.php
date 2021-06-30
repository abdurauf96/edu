<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{
    use LogsActivity;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

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
    protected $fillable = ['name', 'teacher_id', 'course_id', 'course_days', 'start_date', 'end_date', 'duration', 'time', 'status'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_group')->latest();
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($group) {
             $group->students()->delete();
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
