<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductOption::class, function (Faker $faker) {
    return [
        'product_id'=> function (){
            return  factory(\App\Models\Product::class)->create()->id;
            },
        'optionname' =>$faker->name,
        'size' => $faker->numberBetween(1,50),
        'price' => $faker->randomDigitNotNull,
        'status' => $faker->numberBetween(0,1),
        'color' => $faker->colorName,
        'image' => $faker->image,
        'description' => $faker -> paragraph ,
        'stock' => $faker->numberBetween(1,100),
    ];
});
