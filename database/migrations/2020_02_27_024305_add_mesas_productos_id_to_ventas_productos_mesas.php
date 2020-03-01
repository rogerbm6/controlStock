<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMesasProductosIdToVentasProductosMesas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas_productos_mesas', function (Blueprint $table) {
          $table->foreign('productomesa_id')->references('id')->on('mesas_productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas_productos_mesas', function (Blueprint $table) {
            //
        });
    }
}
