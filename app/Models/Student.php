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
    protected $fillable = ['name', 'image', 'phone', 'year', 'address', 'passport', 'code'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'student_group');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('course_id')->orderBy('month_id');
    }
    
    // public function checkStatus($group_id)
    // {
    //     $res=true;
    //     //$group=\App\Models\Group::findOrFail($group_id);
    //     $payment=$this->payments->where('group_id', $group_id)->where('month_id', date('m'))->first();
    //     if(!$payment){
    //         $res=false;
    //     }
    //     return $res;
        
    // }

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
