<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Config;

class CrearTablaEstadisticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::dropIfExists(Config::get('constants.TABLA_ESTADISTICAS'));
        Schema::create(Config::get('constants.TABLA_ESTADISTICAS'), function (Blueprint $table) {
           
            $table->integer(Config::get('constants.ESTADISTICAS_VISITADOS_HOY'));				
			$table->integer(Config::get('constants.ESTADISTICAS_A_VISITAR'));
			$table->integer(Config::get('constants.ESTADISTICAS_VISITADOS_FUERA_RUTA'));
        	$table->double(Config::get('constants.ESTADISTICAS_VENDIDO_FUERA_RUTA'));
        	$table->double(Config::get('constants.ESTADISTICAS_VENDIDO_CLIENTES_DIA'));
			$table->integer(Config::get('constants.ESTADISTICAS_ID_VENDEDOR'));				
			$table->dateTime(Config::get('constants.ESTADISTICAS_DIA'));
			$table->primary(array(Config::get('constants.ESTADISTICAS_ID_VENDEDOR'),
						  Config::get('constants.ESTADISTICAS_DIA')));
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Config::get('constants.TABLA_ESTADISTICAS'));
    }
}
