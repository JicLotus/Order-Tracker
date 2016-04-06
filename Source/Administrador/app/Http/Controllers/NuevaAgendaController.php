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
			$clientes = DB::select("select nombre,id from clientes");  	
    	
        return view('agendas.nuevaagenda', ['title' => 'Home',
                                'page' => 'home','vendedores'=>$vendedores,'clientes'=>$clientes]
        );
    }
    
    public function guardar(Request $request)
    {
		$idVendedor= $request->idVendedor;    	
    	$idCliente= $request->idCliente;
    	
		$id = DB::table('agendas')->insertGetId(array('id_usuario' => ($idVendedor),'id_cliente' => ($idCliente)));

		$url = app()->make('urls')->getUrlAgendas();
		return redirect($url);
    }





}
