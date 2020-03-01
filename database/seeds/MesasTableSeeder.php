<?php

use App\Mesa;
use Illuminate\Database\Seeder;
class MesasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Mesa::class)->times(7)->create();
    }
}
