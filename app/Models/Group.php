<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Traits\School;


class Group extends Model
{
    use LogsActivity, School;
    //status=1 guruh to'lgan
    //status=0 ochilmoqda
    const GRADUATED=2 ; //bitirgan

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
    protected $fillable = ['name', 'teacher_id', 'course_id', 'course_days', 'start_date', 'end_date', 'duration', 'time', 'status', 'year', 'room_number'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function scopeType($query, $type=null)
    {
        if(isset($type)){
            return $query->where('status', self::GRADUATED);
        }else{
            return $query->where('status', '!=', self::GRADUATED);
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function allStudents()
    {
        return $this->hasMany(Student::class)->latest();
    }

    public function students()
    {
        return $this->allStudents()->where(['status' => 1]);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($group) {
            $group->allStudents()->delete();
        });
        static::creating(function ($model) {
            $model->school_id = auth()->guard('user')->user()->school_id;
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
