<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
     /**
      * Seed the application's database.
      *
      * @return void
      */
     public function run()
     {
       $this->truncateTables([
         'users',
         'mesas',
         'productos',
         'ventas',
         'ventas_productos_mesas',
         'mesas_productos'
       ]);
       $this->call(UsersTableSeeder::class);
       $this->call(MesasTableSeeder::class);
       $this->call(ProductosTableSeeder::class);
     }

     //Borra toda la BBDD
     public function truncateTables(array $tables)
     {
       foreach ($tables as $table) {
         DB::statement("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE");

       }
     }
}
