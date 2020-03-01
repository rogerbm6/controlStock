<?php

use Illuminate\Database\Seeder;
use App\Producto;
class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Producto::class)->times(30)->create();
    }
}
