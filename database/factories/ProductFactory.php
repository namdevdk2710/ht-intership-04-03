<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id'=>function(){
            return  factory(\App\Models\ProductCategory::class)->create()->id ;
        },
        'description' => $faker ->paragraph,
    ];
});
