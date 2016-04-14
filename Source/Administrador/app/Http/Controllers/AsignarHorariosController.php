<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class AsignarHorariosController extends Controller
{	
	public function getCoordinates($address){
		 
		$address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
		 
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
		 
		$response = file_get_contents($url);
		 
		$json = json_decode($response,TRUE); //generate array object from the response from the web
		 
		return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
		 
	}
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {		
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$sql = "select *,usuarios.nombre as nombreVendedor, clientes.nombre as nombreCliente from agendas ";
			$sql .= "left join usuarios on agendas.id_usuario = usuarios.id ";
			$sql .= " left join clientes on agendas.id_cliente = clientes.id where usuarios.id = " . $id;
			$agendas = DB::select($sql);
			$nombre =  DB::select("select nombre,id from usuarios where id = " . $id);
			
			
                        
        return view('agendas.agenda', ['title' => 'Home',
                                'page' => 'home','agendas' => $agendas, 'vendedores' => $vendedores, 'nombre' => $nombre]
        );
        
        
    }
}
