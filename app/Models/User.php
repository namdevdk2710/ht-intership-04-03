<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model implements Authenticatable
{   use AuthenticableTrait;
    protected $table= 'users';

    protected $fillable=[
        'name',
        'email',
        'password',
        'phone',
        'birthday',
        'image',
        'remember_token',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
    protected $hidden=[
        'password',
    ];
    public function userroles()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }
    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }
}
