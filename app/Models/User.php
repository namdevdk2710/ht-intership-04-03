<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
}
