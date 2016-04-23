<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pedidos');
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto');
            $table->integer('cantidad');
	    $table->integer('precio');
	    $table->integer('id_compra');

        });
    }

    /**
     * Reverse the migrations.
	 * @return void
     */
    public function down()
    {
        Schema::drop('pedidos');
    }
}
