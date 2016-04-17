<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class EliminarAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   public function index($idAgenda, $vendedor)
    {		

			$sql = "DELETE from agendas WHERE id= " . $idAgenda;
			DB::statement($sql);
			

			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$sql = "select *, agendas.id as agendaId,usuarios.nombre as nombreVendedor, clientes.nombre as nombreCliente from agendas ";
			$sql .= "left join usuarios on agendas.id_usuario = usuarios.id ";
			$sql .= " left join clientes on agendas.id_cliente = clientes.id where usuarios.id = " . $vendedor;
			$agendas = DB::select($sql);
			
			$sql ="select nombre,id from usuarios where id = ".$vendedor;
			$nombre =  DB::select($sql) ;
                        
        return view('agendas.agenda', ['title' => 'Home',
                                'page' => 'home','agendas' => $agendas, 'vendedores' => $vendedores, 'nombre' => $nombre]
        );
        
        
    }
}
