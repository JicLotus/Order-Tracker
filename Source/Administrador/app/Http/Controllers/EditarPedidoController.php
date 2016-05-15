<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DateTime;

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
	   
	   DB::table(Config::get('constants.TABLA_COMPRAS'))->where(Config::get('constants.TABLA_COMPRAS_ID_COMPRA'), $id)
				->update(array(Config::get('constants.TABLA_COMPRAS_ESTADO') => ($request->estado)));
	   
		   if($request->estado == 'cancelado'){
				$sql2= "UPDATE productos dest, (SELECT * FROM pedidos where id_compra=$id) src 
				SET dest.stock = dest.stock + src.cantidad where dest.id = src.id_producto ";
				DB::statement($sql2);
			}
	   
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2 order by nombre");
			$clientes = DB::select("select nombre,id from clientes order by nombre");
			$fecha = $request->datepicker;
			$idCliente = $request->idCliente ;
			$idVendedor =$request->idVendedor ;
			$sql = "select *, usuarios.nombre as nombreVendedor from productos, pedidos, compras, clientes, usuarios
					where pedidos.id_producto = productos.id
					and usuarios.id = compras.id_usuario
					and compras.id_cliente = clientes.id
					and pedidos.id_compra = compras.id_compra";
											
			if( (strcmp($request->idCliente, 'Todos')) || (strcmp($request->idVendedor ,'Todos')) || (strcmp($request->datepicker , 'Todas'))){
				if(strcmp($request->idCliente, 'Todos')){
					$sql .= " and compras.id_cliente = " . $request->idCliente ;
				}
				if(strcmp($request->idVendedor ,'Todos')){
					$sql .= " and compras.id_usuario = " . $request->idVendedor ;
				}
				if(strcmp($request->datepicker , 'Todas')){
					$dt = new DateTime($fecha);
					$fecha = $dt->format('Y-m-d');
					$sql .= " and date_format(compras.fecha, '%Y-%m-%d') = '".$fecha."'" ;
				}
			}
			$pedidos = DB::select($sql);
			
			
			$bultos = DB::select("$sql group by compras.id_compra order by compras.fecha desc");


			
                        
        return view('pedidos.pedidovendedor', ['title' => 'Home',
                               'page' => 'home','pedidos' => $pedidos, 'clientes' => $clientes, 'bultos' => $bultos, 'vendedores' => $vendedores,
                                 'idVendedor' => $idVendedor, 'idCliente' => $idCliente, 'fecha2' => $fecha]
        );
        
	}
	
}
