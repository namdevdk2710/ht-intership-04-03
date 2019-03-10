<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductCategory::class, function (Faker $faker) {
    return [
        'categoryname'=> $faker->name,
        'count'=>$faker->numerify,
    ];
});
