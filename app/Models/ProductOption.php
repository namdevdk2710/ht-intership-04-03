<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $tabel ='product_option' ;

    protected $filltabel=[
        'optionname',
        'size',
        'price',
        'status',
        'color',
        'image',
        'disciption',
        'stock',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
