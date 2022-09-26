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

    use LogsActivity, HasApiTokens;
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
    protected $fillable = ['group_id', 'name', 'image', 'phone', 'year', 'address', 'passport', 'sex', 'qrcode', 'type', 'is_debt', 'status', 'username', 'password', 'study_year', 'outed_date', 'finished_date', 'idcard', 'district_id', 'study_type', 'future_work', 'start_date','debt', 'creator_id', 'class_id', 'school_number'];

    public function statusText(){
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

    public function is_debt(){
        if($this->attributes['debt'] > 0){
            return true;
        }
        return false;
    }

    public function scopeDebt($query)
    {
        return $query->where('debt', '>', 0);
    }

    public function scopeSertificated($query)
    {
        return $query->where('sertificat_status', 1);
    }

    public function scopeSchool($query)
    {
        return $query->where('school_id', auth()->guard('user')->user()->school_id);
    }
    public function scopeActive($query)
    {
        return $query->whereStatus(self::ACTIVE);
    }

    public function scopeGraduated($query)
    {
        return $query->whereStatus(self::GRADUATED);
    }

    public function scopeOut($query)
    {
        return $query->whereStatus(self::OUT);
    }

    public function scopeGrant($query)
    {
        return $query->active()->where('type', '!=', 1);
    }

    public function clas()
    {
        return $this->belongsTo(Clas::class, 'class_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'person_id')->where('type', 'student');
    }

    public function getLastEventStatus()
    {
        return $this->events()->latest()->first()->status ?? null;
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function course()
    {
        return $this->group->course;
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('month_id');
    }

    public function getSchool()
    {
        return $this->belongsTo(SchoolModel::class, 'school_id');
    }

    public function getPriceMonth()
    {
        return round($this->type*$this->group->course->price);
    }

    public function isByDateHere($date)
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
