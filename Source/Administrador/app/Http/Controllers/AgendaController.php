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


function agendaFecha(Request $request, $fecha0)
    {		
			$dt = new DateTime($fecha0);
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
	
			$sql = "select *, agendas.id as agendaId, usuarios.nombre as nombreVendedor, clientes.nombre as nombreCliente from agendas ";
			$sql .= "left join usuarios on agendas.id_usuario = usuarios.id ";
			$sql .= " left join clientes on agendas.id_cliente = clientes.id where usuarios.id = " .$request->idVendedor 
						." and date_format(agendas.fecha, '%Y-%m-%d') between ".$lunes." and ".$viernes." order by agendas.orden;";
			return DB::select($sql);
     }

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     
    
    public function index(Request $request)
    {		
			$fecha0 = $request->datepicker;
			$agendas = agendaFecha($request, $fecha0);
			
			
			if(empty($agendas)){
				
				$fecha1 = $fecha0;
				$contador = 0;
				while(empty($agendas) && ($contador< 10)){
					
					//busco los registros de alguna la semana pasada
					$dt = new DateTime($fecha1);	
					$dt->setISODate($dt->format('o'), $dt->format('W')-1);
					$periods = new DatePeriod($dt, new DateInterval('P1D'), 4);
					$days = iterator_to_array($periods);
					$fecha1 = $days[0]->format ('d-m-Y');
					$contador++;
					$agendas = agendaFecha($request, $fecha1);
					
				}
				//calculo los dias de la semana seleccionada
				$dt = new DateTime($fecha0);	
				$dt->setISODate($dt->format('o'), $dt->format('W'));
				$periods = new DatePeriod($dt, new DateInterval('P1D'), 4);
				$days = iterator_to_array($periods);
				

				
				foreach ($agendas as $agenda){
					switch ($agenda->dia){
						case "Lunes":
							$old_date = $days[0]->format ('Y-m-d');
						break;
						case "Martes":
							$old_date = $days[1]->format ('Y-m-d');
						break;
						case "Miercoles":
							$old_date = $days[2]->format ('Y-m-d');
						break;
						case "Jueves":
							$old_date = $days[3]->format ('Y-m-d');
						break;
						case "Viernes":
							$old_date = $days[4]->format ('Y-m-d');
						break;
					}
					
					$middle = strtotime($old_date);             
					$fecha = date('Y-m-d H:i:s', $middle); 
					
					DB::table('agendas')->insertGetId(array('id_usuario' => ($request->idVendedor),'id_cliente' => ($agenda->id_cliente), 'fecha' => $fecha, 'dia' => ($agenda->dia), 'orden' => ($agenda->orden)));

				}
			}
			$agendas = agendaFecha($request, $fecha0);
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$nombre =  DB::select("select nombre,id from usuarios where id = " .$request->idVendedor);
			
			$asignado = 0;
        return view('agendas.agenda', ['title' => 'Home',
                                'page' => 'home','agendas' => $agendas, 'vendedores' => $vendedores, 'nombre' => $nombre, 'hoy' => $fecha0, 'asignado' => $asignado]
        );
        
        
    }
}
