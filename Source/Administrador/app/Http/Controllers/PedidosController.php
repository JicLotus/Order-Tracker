<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {		
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2 order by nombre");
			$clientes = DB::select("select nombre,id from clientes order by nombre");
			$sql = "select *,clientes.nombre as nombreCliente, productos.nombre as nombreProducto from pedidos ";
			$sql .= "left join clientes on pedidos.id_cliente = clientes.id left join productos on pedidos.id_producto = productos.id";
			$pedidos = DB::select($sql); 
        
        return view('pedidos.pedidos', ['title' => 'Home',
                                'page' => 'home','pedidos' => $pedidos , 'clientes' => $clientes,'vendedores' => $vendedores]
        );
        
    }
}
