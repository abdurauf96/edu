<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\School;
class Organization extends Model
{
    use LogsActivity, School;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

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
    protected $fillable = ['school_id', 'name'];

    public function staffs()
    {
        return $this->hasMany('App\Models\Staff');
    }
    
    public static function boot() {
        parent::boot();
        static::deleting(function($model) {
             $model->staffs()->delete();
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
