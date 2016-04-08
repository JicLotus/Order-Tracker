<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;

	 


class NuevaAgendaController extends Controller
{
	
    public function index()
    {
    		$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$clientes = DB::select("select nombre,id from clientes")			;
			
    	
        return view('agendas.nuevaagenda', ['title' => 'Home',
                                'page' => 'home','vendedores'=>$vendedores,'clientes'=>$clientes]
        );
    }
    
    public function guardar(Request $request)
    {
		$idVendedor= $request->idVendedor;    	

    	$hora = $request->hora;
    	
    	$old_date = date($request->datepicker. $hora);           
		$middle = strtotime($old_date);             
		$fecha = date('Y-m-d H:i:s', $middle); 
		
    	$idCliente= $request->idCliente[1];
    	
    	foreach ($request->idCliente as $cliente){
			$id = DB::table('agendas')->insertGetId(array('id_usuario' => ($idVendedor),'id_cliente' => ($cliente), 'fecha' => ($fecha)));
		}
		$url = app()->make('urls')->getUrlAgendas();
		return redirect($url);
    }





}
