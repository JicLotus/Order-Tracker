<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaNotificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::dropIfExists('notificaciones');
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('id_usuario');
			$table->string('tipo_notificacion');
			$table->double('porcentaje');
			$table->string('valor');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notificaciones');
    }
}
