<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
class EditarPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param integer $id
     * @return Response
     */
    public function index($id, Request $request)
   {		
	   
	   DB::table(Config::get('constants.TABLA_PEDIDOS'))->where(Config::get('constants.TABLA_PEDIDOS_ID_COMPRA'), $id)
				->update(array(Config::get('constants.TABLA_PEDIDOS_ESTADO') => ($request->estado)));
	   
	   if($request->estado == 'cancelado'){
			$sql2= "UPDATE productos dest, (SELECT * FROM pedidos where id_compra=$id) src 
			SET dest.stock = dest.stock + src.cantidad where dest.id= src.id_producto ";
			DB::statement($sql2);
		}
	   
			$clientes = DB::select("select nombre,id from clientes order by nombre");
			$sql = "select *, productos.nombre as nombreProducto from productos ";
			$sql .= "left join pedidos on pedidos.id_producto = productos.id where pedidos.id_cliente = " . $request->idCliente ;
			$pedidos = DB::select($sql);
			$nombre =  DB::select("select nombre,id from clientes where id = " .$request->idCliente);
            			$bultos = DB::select("$sql group by id_compra");
            
                        
        return view('pedidos.pedidovendedor', ['title' => 'Home',
                                'page' => 'home','pedidos' => $pedidos, 'clientes' => $clientes, 'nombre' => $nombre, 'bultos' => $bultos]
        );
	}
	
}
