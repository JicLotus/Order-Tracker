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
	

			$sql = "DELETE pedidos from pedidos,compras WHERE estado = 'cancelado' and compras.id_compra = pedidos.id_compra";
			$sql = "DELETE from compras WHERE estado = 'cancelado'";
			DB::statement($sql);
			

			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2 order by nombre");
			$clientes = DB::select("select nombre,id from clientes order by nombre");

        
        return view('pedidos.pedidos', ['title' => 'Home',
                                'page' => 'home','vendedores' => $vendedores , 'clientes' => $clientes]
        );
        
    }
}
