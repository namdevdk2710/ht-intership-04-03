<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $tabel='productcategory';

    protected $filltabel=[
        'categoryname',
        'cout',
    ];

    public function product()
    {
        return  $this->hasMany(Product::class,'id' ,'id');
    }

}
