<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request){

		  $clientes = DB::select("select * from clientes order by nombre ");
		  $clienteAnterior = "";
 		  $razonAnterior = "";
 		  $direccionAnterior = "";                     
        return view('clientes.clientes', ['title' => 'Home',
                                'page' => 'home','clientes' => $clientes,  
                                'clienteAnterior'=> $clienteAnterior ,'razonAnterior' =>  $razonAnterior , 'direccionAnterior'=> $direccionAnterior ]
        );
	}
     public function filtro(Request $request){
		 
 		  $clienteAnterior = $request->nombre;
 		  $razonAnterior = $request->razonsocial;
 		  $direccionAnterior = $request->direccion;       
 		  		 
 		  $cliente = strtoupper($clienteAnterior);		 
  		  $razon = strtoupper($razonAnterior);
 		  $direccion = strtoupper($direccionAnterior);	
 		  		  		 
 		  $sql = "select * from clientes where ";
 		  
 		  if($cliente != "")
			$sql .= "UPPER(nombre) like '%$cliente%' and " ;
		  if($razon != "")
			 $sql .= "UPPER(razon_social) like '%$razon%' and " ;		
		  if($direccion != "")
			$sql .= "UPPER(direccion) like '%$direccion%' and ";
		  
 		  $sql .= "1 = 1 order by nombre";
 		  $clientes = DB::select($sql);
 		                
        return view('clientes.clientes', ['title' => 'Home',
                                'page' => 'home','clientes' => $clientes, 
                                'clienteAnterior'=> $clienteAnterior ,'razonAnterior' =>  $razonAnterior , 'direccionAnterior'=> $direccionAnterior ]
        );
           
    }
}
