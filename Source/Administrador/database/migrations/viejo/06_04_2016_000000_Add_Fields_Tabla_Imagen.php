<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsTablaImagen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('imagenes', function (Blueprint $table) {
            $table->increments('id_mapeo')->unsigned()->unique();
            $table->integer('id_producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		$table->increments('id_mapeo')->unsigned()->unique();
		$table->integer('id_producto');
    }
}
