<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class AgendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	
			$sql = "select *,usuarios.nombre as nombreVendedor, clientes.nombre as nombreCliente from agendas ";
			$sql .= "left join usuarios on agendas.id_usuario = usuarios.id left join clientes on agendas.id_cliente = clientes.id";
			$agendas = DB::select($sql);
                        
        return view('agendas.agendas', ['title' => 'Home',
                                'page' => 'home','agendas' => $agendas]
        );
        
        
    }
}
