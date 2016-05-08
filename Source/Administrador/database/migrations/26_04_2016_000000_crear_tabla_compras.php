<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('compras');
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id_compra');
            $table->integer('id_usuario');
            $table->integer('id_cliente');
	    $table->string('estado')->default('pendiente');
            $table->dateTime('fecha');
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
