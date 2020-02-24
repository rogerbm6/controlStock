<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Producto;
use Faker\Generator as Faker;

$factory->define(Producto::class, function (Faker $faker) {
    return [
      //'mesa_id'=>$faker->numberBetween(1, 7),
      'nombre' =>$faker->name,
      'precio' =>$faker->numberBetween(1, 100),
      'tipo'   =>$faker->randomElement(['collar', 'pulsera', 'areta', 'anillo']),
  ];
});
