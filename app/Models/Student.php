<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Traits\School;
use Carbon\Carbon;
use App\Models\School as SchoolModel;

class Student extends Authenticatable
{

    use LogsActivity, HasApiTokens, School;
    const ACTIVE = 1; // xozirgi vaqtda o'qiyotgan o'quvchilar
    const OUT = 2; // chiqib ketgan o'quvchilar
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
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id', 'name', 'image', 'phone', 'year', 'address', 'passport', 'sex', 'qrcode', 'type', 'is_debt', 'status', 'username', 'password', 'study_year', 'outed_date', 'finished_date', 'idcard', 'district_id', 'study_type', 'future_work', 'start_date','debt'];

    public function scopeCurrentYear()
    {
        return $this->where('study_year', date('Y'));
    }


    public function scopeActive()
    {
        return $this->currentYear()->whereStatus(self::ACTIVE);
    }

    public function scopeGraduated()
    {
        return $this->currentYear()->whereStatus(self::GRADUATED);
    }

    public function scopeOut()
    {
        return $this->currentYear()->whereStatus(self::OUT);
    }

    public function scopeGrant()
    {
        return $this->currentYear()->where('type', '!=', 1);
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'person_id')->where('type', 'student');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('month_id');
    }

    public function getLastEventStatus()
    {
        $event=Event::where(['type'=>'student', 'person_id'=>$this->id])->latest()->first();
        return $event->status ?? null;
    }

    public function getTodayEventStatus()
    {
        $event=Event::where(['type'=>'student', 'person_id'=>$this->id])->whereDate('created_at', date('Y-m-d'))->latest()->first();
        return $event->status ?? null;
    }

    // public function is_debt()
    // {
    //     $currentDate=Carbon::parse(date('Y-m-d'));
    //     $courseStartedDate=Carbon::parse($this->group->start_date);
    //     $payedSum=$this->payments()->sum('amount');
    //     switch ($this->status) {
    //         case 1:
    //             $diffMonth=date_diff($currentDate, $courseStartedDate)->m;
    //             break;
    //         case 2:
    //             $outedDate=Carbon::parse($this->outed_date);
    //             $diffMonth=date_diff($outedDate, $courseStartedDate)->m;
    //             break;
    //         case 0:
    //             $finishedDate=Carbon::parse($this->finished_date);
    //             $diffMonth=date_diff($finishedDate, $courseStartedDate)->m;
    //             break;
    //         default:
    //             $diffMonth=1;
    //             break;
    //     }
    //     $mustPaySum=$this->group->course->price*$diffMonth;

    //     if($payedSum<$mustPaySum){
    //         return true;
    //     }
    //     return false;
    // }
    public function getSchool()
    {
        return $this->belongsTo(SchoolModel::class, 'school_id');
    }


    public static function boot()
    {
        parent::boot();
        static::deleting(function ($student) {
            $student->payments()->delete();
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