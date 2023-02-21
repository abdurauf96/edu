<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\School;
use App\Models\School as SchoolModel;
class Staff extends Model
{
    use LogsActivity,School,SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staffs';

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
    protected $fillable = ['name', 'position', 'phone', 'year', 'image', 'passport', 'addres', 'qrcode', 'organization_id'];

    public function getLastEventStatus()
    {
        return Event::where(['type'=>'staff', 'person_id'=>$this->id])->latest()->first()->status ?? null;
    }

    public function getSchool(){
        return $this->belongsTo(SchoolModel::class, 'school_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public static function boot() {
        parent::boot();

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
