<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyIdClienteAgendasField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
				$table->increments('id')->unique();
        		$table->integer('id_cliente');
            $table->unique(array('id_usuario', 'id_cliente'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
				$table->increments('id')->unique();
        		$table->integer('id_cliente');
            $table->unique(array('id_usuario', 'id_cliente'));
        });
    }
}