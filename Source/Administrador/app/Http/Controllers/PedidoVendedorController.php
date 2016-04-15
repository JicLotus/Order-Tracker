<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class PedidoVendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {		
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2");
			$sql = "select *, productos.nombre as nombreProducto from productos ";
			$sql .= "left join pedidos on pedidos.id_producto = productos.id where pedidos.id_usuario = " . $request->idVendedor ;
			$pedidos = DB::select($sql);
			$nombre =  DB::select("select nombre,id from usuarios where id = " .$request->idVendedor);
                        
        return view('pedidos.pedidovendedor', ['title' => 'Home',
                                'page' => 'home','pedidos' => $pedidos, 'vendedores' => $vendedores, 'nombre' => $nombre]
        );
        
        
    }
}
