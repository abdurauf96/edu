<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\School;

class Course extends Model
{
    use LogsActivity, School;

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
    protected $fillable = ['school_id', 'name', 'duration', 'price', 'code', 'description', 'is_for_bot', 'status'];

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

    public function paymentsByMonth($month,$year)
    {
        return $this->payments()->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();
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
