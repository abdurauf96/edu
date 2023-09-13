<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Traits\StudentScope;
use Carbon\Carbon;
use App\Models\School as SchoolModel;

class Student extends Authenticatable
{
    use LogsActivity,SoftDeletes, HasApiTokens, StudentScope;

    const ACTIVE = 1; // xozirgi vaqtda o'qiyotgan o'quvchilar
    const OUT   = 2; // chiqib ketgan o'quvchilar
    const GRADUATED = 0; // bitirib ketgan o'quvchilar

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $dates = ['start_date','finished_date', 'outed_date'];
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id', 'name', 'image', 'phone', 'year', 'address', 'passport', 'sex', 'qrcode', 'type',  'status', 'password', 'outed_date', 'finished_date', 'district_id', 'study_type', 'future_work', 'start_date','debt'];

    public function sertificates(): HasMany
    {
        return $this->hasMany(Sertificate::class);
    }

    public function getDiscountPercentAttribute(): float|int
    {
        return (1-$this->type)*100;
    }

    public function statusText(): string
    {
        if($this->attributes['status']==self::ACTIVE){
            return 'O\'qimoqda';
        }elseif($this->attributes['status']==self::OUT){
            return 'Chiqib ketgan';
        }elseif($this->attributes['status']==self::GRADUATED){
            return 'Bitirgan';
        }else{
            return 'Belgilanmagan';
        }
    }

    public function getFormattedDebtAttribute(): string
    {
        if($this->attributes['debt'] > 0){
            return '-'.number_format(abs($this->attributes['debt']));
        }else{
            return number_format(abs($this->attributes['debt']));
        }
    }

    public function activities(): HasMany
    {
        return $this->hasMany(StudentActivity::class)->latest();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(StudentMessage::class)->latest();
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'person_id')->where('type', 'student')
            ->select('person_id', 'type', 'status', 'created_at')
            ->latest();
    }

    public function getLastEventStatus()
    {
        return $this->events()->latest()->first()->status ?? null;
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function teacher(): HasOneThrough
    {
        return $this->hasOneThrough(Teacher::class,Group::class);
    }

    public function course()
    {
        return $this->group->course;
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class)->select('student_id', 'amount', 'type', 'created_at');
    }

    public function getSchool(): BelongsTo
    {
        return $this->belongsTo(SchoolModel::class, 'school_id');
    }

    public function getPriceMonth(): float
    {
        return round($this->type*$this->group->course->price);
    }

    public function isByDateHere($date): bool
    {
        $event=Event::whereDate('created_at', $date)
            ->where('type', 'student')
            ->where('status', 1)
            ->where('person_id', $this->id)
            ->first();
        if($event){
            return true;
        }
        return false;
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($student) {
            $student->payments()->delete();
        });
        static::creating(function ($model) {
            $model->school_id = auth()->guard('user')->user()->school_id;
            $model->finished_date = $model->group->end_date;
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
