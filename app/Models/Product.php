<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'users';

    protected $filltable=[
        'name',
        'description',
    ] ;

    public function productcategory()
    {
        return  $this->belongsTo(ProductCategory::class ,'id','id');
    }
}
