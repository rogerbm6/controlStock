<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas_users', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('mesa_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mesa_id')->references('id')->on('mesas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesas_users');
    }
}
