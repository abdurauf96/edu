<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;
    const RECEPTION_ROLE_ID = 4; // receptionist user role id equal to 4

    public function isAdmin(){
        if($this->hasRole('admin')){
            return true;
        }
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'creator_id');
    }

    public function scopeCreators()
    {
        return $this->whereHas('roles', function ($query) {
            return $query->where('role_id', self::RECEPTION_ROLE_ID);
        });
    }
//    public static function boot() {
//        parent::boot();
//
//        static::creating(function ($model){
//            $model->school_id=auth()->guard('user')->user()->school_id;
//        });
//
//    }
}
