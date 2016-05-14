<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Property as Property;
use \DateTime;
use \DatePeriod;
use \DateInterval;


function procesarYGuardarAgenda($procesar,$numeroDeOrden){
	
	$fecha = date_create($procesar->fecha);
	date_time_set($fecha, 7,0);                  //EMPIEZA EL HORARIO A LAS 7 AM
	date_add($fecha, date_interval_create_from_date_string($numeroDeOrden ." hours"));
					
	DB::table(Config::get('constants.TABLA_AGENDAS'))->where(Config::get('constants.TABLA_AGENDAS_ID'), $procesar->agendaId)
	->update(array(Config::get('constants.TABLA_AGENDAS_FECHA') => ($fecha), 
			Config::get('constants.TABLA_AGENDAS_ORDEN') => ($numeroDeOrden))); 
					
	
}

function getCoordinates($address){
		 
		$address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
		 
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
		 
		$response = file_get_contents($url);
		 
		$json = json_decode($response,TRUE); //generate array object from the response from the web
		 
		return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
}

function getDrivingDistance($dir1 , $dir2)

{	$coord1 = getCoordinates($dir1);
	$coord2  = getCoordinates($dir2);
	
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$coord1."&destinations=".$coord2."&mode=driving&language=pl-PL";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

    return array('distance' => $dist, 'time' => $time);
}

function calcularHorarios($agendas, $dirSalida, $numeroDeOrden){
	
			$agendaAux = array();
			$cantidad = count($agendas);
			$minDistancia = 10000;
			$distFinal = "";
			if ($cantidad != 0){
				if ($cantidad > 1){
					
					foreach ($agendas as $agenda){
						// $distancia['distance'] . $distancia['time'];
						$distancia = getDrivingDistance($dirSalida, $agenda->direccion);
						$distFinal = (preg_split('/\s+/', $distancia['distance']));
						if($minDistancia > ($distFinal[0])){
								array_push($agendaAux, $agenda);
								$minDistancia = $distFinal[0];
						}
						else
								array_unshift($agendaAux, $agenda);
							
					}
					$procesar = array_pop($agendaAux);
					procesarYGuardarAgenda($procesar,$numeroDeOrden);
					
					$numeroDeOrden += 1;
					$dirSalida = $procesar->direccion;
					
					calcularHorarios($agendaAux, $dirSalida, $numeroDeOrden);
				}
				else
					procesarYGuardarAgenda(array_pop($agendas),$numeroDeOrden);
			}
}



class AsignarHorariosController extends Controller
{	
	

	
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {		

//			$diasPosibles = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes");
			
			
			$dt = new DateTime();
			
						
			$dt->setISODate($dt->format('o'), $dt->format('W'));
	
			$periods = new DatePeriod($dt, new DateInterval('P1D'), 4);
		
			$days = iterator_to_array($periods);
			
			$fecha2 = $days[0]->format ('d-m-Y');
			$lunes = $days[0]->format ('Y-m-d');
			$martes = $days[1]->format ('Y-m-d');
			$miercoles = $days[2]->format ('Y-m-d');
			$jueves = $days[3]->format ('Y-m-d');
			$viernes = $days[4]->format ('Y-m-d');
			
			
			$diasPosibles = array($lunes, $martes, $miercoles, $jueves, $viernes);

			foreach($diasPosibles as $dia){
				$sql = "	select *, agendas.id as agendaId, usuarios.nombre as nombreVendedor, clientes.nombre as nombreCliente from agendas ";
				$sql .= "	left join usuarios on agendas.id_usuario = usuarios.id ";
				$sql .= "   left join clientes on agendas.id_cliente = clientes.id where
							date_format(agendas.fecha, '%Y-%m-%d') = '" . $dia . "' 
							and usuarios.id = " . $id;
				$agendas = DB::select($sql);

				$dirSalida= "Av. Paseo Colón 850";
				$numeroDeOrden = 0;
				
				calcularHorarios($agendas, $dirSalida, $numeroDeOrden);
			}
			
		
			
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$sql2 = "select *, agendas.id as agendaId, usuarios.nombre as nombreVendedor, clientes.nombre as nombreCliente from agendas ";
			$sql2 .= "left join usuarios on agendas.id_usuario = usuarios.id ";
			$sql2 .= " left join clientes on agendas.id_cliente = clientes.id where usuarios.id = " .$id 
						." and date_format(agendas.fecha, '%Y-%m-%d') between '".$lunes."' and '".$viernes."' order by agendas.orden;";
			$agendas = DB::select($sql2);
			$nombre =  DB::select("select nombre,id from usuarios where id = " .$id);

			$asignado = 1;
        return view('agendas.agenda', ['title' => 'Home',
                                'page' => 'home','agendas' => $agendas, 'vendedores' => $vendedores, 'nombre' => $nombre, 'hoy' => $fecha2, 'asignado' => $asignado]
        );
        
     
        
/*				
        return view('agendas.agenda', ['title' => 'Home',
                                'page' => 'home','agendas' => $agendas, 'vendedores' => $vendedores, 'nombre' => $nombre
                                ,'hoy' => $hoy]
        );
 */       
        
    }
}
