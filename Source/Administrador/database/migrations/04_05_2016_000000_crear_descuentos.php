<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearDescuentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->increments('id')->unique();
			$table->integer('id_marca');
			$table->integer('id_categoria');
			$table->integer('id_producto');
			$table->integer('cantidad');
			$table->dateTime('desde');
			$table->dateTime('hasta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('descuentos');
    }
}
