<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::dropIfExists('productos');
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');				
				$table->string('codigo');
				//Indice de la imagen
				$table->integer('imagen');
				$table->string('caracteristicas',10000);
				$table->integer('stock');
				$table->integer('marca');
				$table->integer('estado');
				$table->boolean('eliminado')->default(false);
				$table->integer('categoria');
				$table->double('precio',10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productos');
    }
}
