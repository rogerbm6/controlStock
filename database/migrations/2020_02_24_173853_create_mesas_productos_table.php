<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas_productos', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('producto_id');
            $table->unsignedInteger('mesa_id');

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('set null');

            $table->foreign('mesa_id')->references('id')->on('mesas');

            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesas_productos');
    }
}
