<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payment extends Model
{
    use LogsActivity, SoftDeletes, \App\Traits\School;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public function scopeWithStudentName($query){
        $query->addSubSelect('student_name',Student::select('name')
            ->whereColumn('id', 'payments.student_id'));
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'course_id', 'month_id', 'amount', 'type', 'description', 'year', 'purpose', 'created_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->guard('user')->user())
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
