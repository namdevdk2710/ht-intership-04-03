<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
    protected $fillable= [
        'name'
    ];
    public function userroles(){
        return $this->hasMany(UserRole::class);
    }
}
