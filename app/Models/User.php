<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles,Notifiable,HasApiTokens,SoftDeletes;
    const RECEPTION_ROLE_ID = 4; // receptionist user role id equal to 4

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
        'is_active'
    ];

    protected $guard_name = 'user';

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

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function logins(): HasMany
    {
        return $this->hasMany(Login::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Group::class);
    }

//    public function scopeCreators()
//    {
//        return $this->whereHas('roles', function ($query) {
//            return $query->where('role_id', self::RECEPTION_ROLE_ID);
//        });
//    }
//    public static function boot() {
//        parent::boot();
//
//        static::creating(function ($model){
//            $model->school_id=auth()->guard('user')->user()->school_id;
//        });
//
//    }
}
