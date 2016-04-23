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
	   
	$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2 order by nombre");
			$clientes = DB::select("select nombre,id from clientes order by nombre");
			$sql = "select *, productos.nombre as nombreProducto from productos left join pedidos on pedidos.id_producto = productos.id ";
			$fecha = $request->datepicker;
			$idCliente = $request->idCliente ;
			$idVendedor =$request->idVendedor ;
			
			if( (strcmp($request->idCliente, 'Todos')) || (strcmp($request->idVendedor ,'Todos')) || (strcmp($request->datepicker , 'Todas'))){
				$sql .= " where";
				$contador = 0;
				if(strcmp($request->idCliente, 'Todos')){
					$contador += 1;
					$sql .= " pedidos.id_cliente = " . $request->idCliente ;
				}
				if(strcmp($request->idVendedor ,'Todos')){
					if($contador > 0)
						$sql .= " and ";
					$contador += 1;
					$sql .= " pedidos.id_usuario = " . $request->idVendedor ;
				}
				if(strcmp($request->datepicker , 'Todas')){
					if($contador > 0)
						$sql .= " and ";
					$sql .= " pedidos.fecha = " . $request->datepicker;
				}
			}
			$pedidos = DB::select($sql);
			
			$bultos = DB::select("$sql group by pedidos.id_compra");

                        
        return view('pedidos.pedidovendedor', ['title' => 'Home',
                                'page' => 'home','pedidos' => $pedidos, 'clientes' => $clientes, 'bultos' => $bultos, 'vendedores' => $vendedores,
                                 'idVendedor' => $idVendedor, 'idCliente' => $idCliente, 'fecha2' => $fecha]
        );
        
	}
	
}
