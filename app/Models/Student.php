<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use LogsActivity;
    
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
    protected $fillable = ['name', 'image', 'phone', 'year', 'address', 'passport', 'sex', 'code', 'type', 'is_debt'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'student_group');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('course_id')->orderBy('month_id');
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
