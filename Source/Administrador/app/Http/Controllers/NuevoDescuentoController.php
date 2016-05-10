<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;
use \DateTime;
use \DatePeriod;
use \DateInterval;


class NuevoDescuentoController extends Controller
{
	
    public function index()
    {
    		$marcas = DB::select("select nombre,id from marcas");
			$categorias = DB::select("select nombre,id from categorias");
			$productos = DB::select("select nombre,id from productos");
			
    	
        return view('descuentos.nuevodescuento', ['title' => 'Home',
                                'page' => 'home','categorias'=>$categorias,'marcas'=>$marcas ,'productos' =>$productos]
        );
    }
    
    public function guardar(Request $request)
    {
		$idVendedor= $request->idVendedor;    	

    	$dia = $request->dia;
		
		$dt = new DateTime();
		
		// set object to Monday on next week
		$dt->setISODate($dt->format('o'), $dt->format('W')+1);
//		$dt->setISODate($dt->format('o'), $dt->format('W'));

		// get all 1day periods from Monday to +6 days
		$periods = new DatePeriod($dt, new DateInterval('P1D'), 4);
		
		$days = iterator_to_array($periods);
		// convert DatePeriod object to array

		// $days[0] is Monday, ..., $days[6] is Sunday
		// to format selected date do: $days[1]->format('Y-m-d');
		switch ($dia){
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
		$idCliente= $request->idCliente[0];



			foreach ($request->idCliente as $cliente){
				try{		
					$id = DB::table('agendas')->insertGetId(array('id_usuario' => ($idVendedor),'id_cliente' => ($cliente), 'fecha' => ($fecha), 'dia' => $request->dia));
				}catch(\PDOException $exception){
				
				}
			}
			

		$url = app()->make('urls')->getUrlAgendas();
		return redirect($url);

    }





}
