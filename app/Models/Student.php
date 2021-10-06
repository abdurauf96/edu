<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Traits\School;
use App\Models\School as SchoolModel;

class Student extends Authenticatable
{
    use LogsActivity, HasApiTokens, School;

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
    protected $fillable = ['group_id', 'name', 'image', 'phone', 'year', 'address', 'passport', 'sex', 'code', 'type', 'is_debt', 'status', 'username', 'password'];

    public function events()
    {
        return $this->hasMany(Event::class, 'person_id')->where('type', 'student');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('month_id');
    }


    public function is_debt()
    {
        $res=count($this->payments->where('month_id', date("m", strtotime("first day of previous month"))));

        if($res>0){
            return false;
        }else{
            return true;
        }
    }
    public function getSchool(){
        return $this->belongsTo(SchoolModel::class, 'school_id');
    }


    public static function boot() {
        parent::boot();
        static::deleting(function($student) {
             $student->payments()->delete();
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
