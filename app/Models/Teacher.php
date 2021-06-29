<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Teacher extends Model
{
    use LogsActivity;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teachers';

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
    protected $fillable = ['name', 'birthday', 'address', 'passport', 'phone'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'teacher_course');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($teacher) {
             $teacher->groups()->delete();
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
