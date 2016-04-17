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
			

			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$sql = "select *,usuarios.nombre as nombreUsuario, productos.nombre as nombreProducto from pedidos ";
			$sql .= "left join usuarios on pedidos.id_usuario = usuarios.id left join productos on pedidos.id_producto = productos.id";
			$pedidos = DB::select($sql); 
        
        return view('pedidos.pedidos', ['title' => 'Home',
                                'page' => 'home','pedidos' => $pedidos , 'vendedores' => $vendedores]
        );
        
    }
}
