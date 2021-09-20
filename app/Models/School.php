<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\HasRoles;

class School extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable=['name', 'phone', 'email', 'addres', 'domain', 'director', 'card_number', 'card_date', 'card_name', 'password'];

    
    /**
        * The roles that belong to the School
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
        */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
}
