<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAgendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_usuario');
        		$table->integer('id_cliente');
            $table->unique(array('id_usuario', 'id_cliente'));
            $table->dateTime('fecha');
            $table->string('dia');
            $table->integer('orden');
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
