<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\School;

class Course extends Model
{
    use LogsActivity,SoftDeletes, School;

    const ACTIVE = 1; // xozirgi vaqtda o'qiyotgan o'quvchilar
    const OUT = 2; // chiqib ketgan o'quvchilar
    const GRADUATED = 0; // bitirib ketgan o'quvchilar

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
    protected $fillable = ['school_id', 'name', 'duration', 'price', 'code', 'description', 'is_for_bot', 'status', 'image', 'body', 'price_as_text'];

    public function scopeActive($query)
    {
        return $query->where('is_for_bot', true);
    }
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

    public function debtorStudents()
    {
        return $this->students()->where('debt', '>', 0);
    }

    public function activeStudents()
    {
        return $this->students->where('status', self::ACTIVE);
    }

    public function graduatedStudents()
    {
        return $this->students->where('status', self::GRADUATED);
    }
    public function outStudents()
    {
        return $this->students->where('status', self::OUT);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function waitingStudents()
    {
        return $this->hasMany(WaitingStudent::class);
    }

    public function plans()
    {
        return $this->hasMany(CoursePlan::class)->orderBy('order');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($course) {
             $course->groups()->delete();
             $course->teachers()->delete();
        });
        static::saving(function ($model){
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
