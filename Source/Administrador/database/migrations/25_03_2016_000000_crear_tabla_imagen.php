<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaImagen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->integer('id_producto')->unsigned()->unique();
            $table->foreign('id_producto')->references('id')->on('productos');
            
			$table->string('imagen_base64');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('agendas');
    }
}
