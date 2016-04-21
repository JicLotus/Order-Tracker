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
			$clientes = DB::select("select nombre,id from clientes order by nombre");
			$sql = "select *, productos.nombre as nombreProducto from productos ";
			$sql .= "left join pedidos on pedidos.id_producto = productos.id where pedidos.id_cliente = " . $request->idCliente ;
			$pedidos = DB::select($sql);
			$bultos = DB::select("$sql group by id_compra");
			$nombre =  DB::select("select nombre,id from clientes where id = " .$request->idCliente);
                        
        return view('pedidos.pedidovendedor', ['title' => 'Home',
                                'page' => 'home','pedidos' => $pedidos, 'clientes' => $clientes, 'nombre' => $nombre, 'bultos' => $bultos]
        );
        
        
    }
}
