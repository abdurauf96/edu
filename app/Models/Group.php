<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Traits\School;

class Group extends Model
{
    use LogsActivity, School,SoftDeletes;
    //status=1 guruh active
    //status=2 guruh bitirgan
    const GRADUATED=2 ; //bitirgan
    const ACTIVE=1 ; //active
    const EVERYDAY=3;
    const ODD_DAYS=1;
    const EVEN_DAYS=2;

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
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date'=>'date:Y-m-d'
    ];
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'teacher_id', 'course_id', 'course_days', 'start_date', 'end_date',  'time', 'status', 'room_number', 'user_id','room_id'];
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $this->attributes['start_date'])->addMonths($this->course->duration);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function scopeType($query, $type=null)
    {
        if($type=='graduated'){
            return $query->where('status', self::GRADUATED);
        }else{
            return $query->where('status', self::ACTIVE);
        }
    }
    public function scopeWithCourseName($query){
        $query->addSubSelect('course_name',Course::select('name')
            ->whereColumn('id', 'groups.course_id'));
    }

    public function scopeWithTeacherName($query){
        $query->addSubSelect('teacher_name',Teacher::select('name')
            ->whereColumn('id', 'groups.teacher_id'));
    }

    public function scopeWithRoomNumber($query){
        $query->addSubSelect('room_number',Room::select('room_number')
            ->whereColumn('id', 'groups.room_id'));
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function allStudents(): HasMany
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
        static::saving(function ($model) {
            $model->school_id = auth()->guard('user')->user()->school_id;
            $model->allStudents()->update(['finished_date'=>$model->end_date]);
        });
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return __CLASS__ . " model has been {$eventName}";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
