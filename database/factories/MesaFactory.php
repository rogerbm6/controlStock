<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Mesa;
use Faker\Generator as Faker;

$factory->define(Mesa::class, function (Faker $faker) {
    $total=User::count();
    return
    [
      //'user_id'=>$faker->numberBetween(1, $total),
      'nombre'=>$faker->name()
    ];
});
