<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasProdutosMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_produtos_mesas', function (Blueprint $table)
        {

          $table->unsignedInteger('venta_id');
          $table->unsignedInteger('productomesa_id');

          $table->foreign('venta_id')->references('id')->on('ventas');
          $table->foreign('productomesa_id')->references('id')->on('productos_mesas');

          $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_produtos_mesas');
    }
}
