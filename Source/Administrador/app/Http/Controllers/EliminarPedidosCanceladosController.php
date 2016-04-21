<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class EliminarPedidosCanceladosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   public function index()
    {		

			$sql = "DELETE from pedidos WHERE estado = 'cancelado'";
			DB::statement($sql);
			

			$clientes = DB::select("select nombre,id from clientes order by nombre");
			$sql = "select *,clientes.nombre as nombreUsuario, productos.nombre as nombreProducto from pedidos ";
			$sql .= "left join clientes on pedidos.id_usuario = clientes.id left join productos on pedidos.id_producto = productos.id";
			$pedidos = DB::select($sql); 
        
        return view('pedidos.pedidos', ['title' => 'Home',
                                'page' => 'home','pedidos' => $pedidos , 'clientes' => $clientes]
        );
        
    }
}
