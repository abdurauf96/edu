<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\School;

class WaitingStudent extends Model
{
    use LogsActivity, School,SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'waiting_students';

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
    protected $attributes = [
        'type' => 1, //study type oddiy
    ];
    protected $fillable = ['course_id', 'name', 'phone', 'year', 'address', 'passport', 'image', 'sex', 'type', 'phone2', 'course_time', 'call_result', 'district_id', 'study_type','sale_manager_id', 'personal_manager_id', 'is_informed', 'is_has_computer','is_come_open_lesson', 'is_contract_given','is_payed'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public static function boot() {
        parent::boot();
        static::creating(function ($model){
            $model->school_id=auth()->guard('user')->user()->school_id;
            $model->creator_id=auth()->guard('user')->id();
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
