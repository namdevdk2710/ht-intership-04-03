<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\UserRole::class, function (Faker $faker) {

    return [
        'user_id'=> function (){
        return  factory(\App\Models\User::class)->create()->id;
        },
        'role_id'=> rand(2,5),
    ];
});