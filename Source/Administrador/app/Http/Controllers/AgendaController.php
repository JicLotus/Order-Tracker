<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;
use \DateTime;
use \DatePeriod;
use \DateInterval;


class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {		
			$fecha2 = $request->datepicker;
			$dt = new DateTime($fecha2);
			$fecha = $dt->format('Y-m-d');
			$dayofweek = date('W', strtotime($fecha));
		
			$year = 2016;			
			$date = new DateTime();
			$date->setISODate($year,$dayofweek);
			$lunes = $date->format('Y-m-d'); 
			$lunes = "'".$lunes."'";

			//ahora busco los dias de lunes a viernes
			$dt = new DateTime();
		
			// set object to Monday on next week
			$dt->setISODate($year, $dayofweek);

			// get all 1day periods from Monday to +6 days
			$periods = new DatePeriod($dt, new DateInterval('P1D'), 6);
				
			$days = iterator_to_array($periods);

			$viernes = $days[4]->format('Y-m-d');
			$viernes = "'".$viernes."'";
	
	
	
			
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$sql = "select *, agendas.id as agendaId, usuarios.nombre as nombreVendedor, clientes.nombre as nombreCliente from agendas ";
			$sql .= "left join usuarios on agendas.id_usuario = usuarios.id ";
			$sql .= " left join clientes on agendas.id_cliente = clientes.id where usuarios.id = " .$request->idVendedor 
						." and date_format(agendas.fecha, '%Y-%m-%d') between ".$lunes." and ".$viernes." order by agendas.orden;";
			$agendas = DB::select($sql);
			$nombre =  DB::select("select nombre,id from usuarios where id = " .$request->idVendedor);
			
			$asignado = 0;
        return view('agendas.agenda', ['title' => 'Home',
                                'page' => 'home','agendas' => $agendas, 'vendedores' => $vendedores, 'nombre' => $nombre, 'hoy' => $fecha2, 'asignado' => $asignado]
        );
        
        
    }
}
