<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;

use File;
use \DateTime;
use \DatePeriod;
use \DateInterval;
use Validator;
class NuevoDescuentoController extends Controller
{
	
    public function index()
    {
    		$marcas = DB::select("select nombre,id from marcas");
			$categorias = DB::select("select nombre,id from categorias");
			$productos = DB::select("select nombre,id from productos");
			
    	
        return view('descuentos.nuevodescuento', ['title' => 'Home',
                                'page' => 'home','categorias'=>$categorias,'marcas'=>$marcas ,'productos' =>$productos]
        );
    }
    
    public function guardar(Request $request)
    {
		
		$idCategoria=$request->idCategoria;
		$idMarca=$request->idMarca;
		$idProducto=0;
		$cantidad=$request->cantidad;
		$porcentaje=$request->porcentaje/100.0;
		$porcentaje = 1.0 - $porcentaje;
		
		
		if ($idCategoria==0 & $idMarca==0 & $idProducto==0 & $cantidad==0){
				$this->validate($request, [
				'cantidad' => 'accepted'
				]);
		}
		
		$fecha = $request->from;
		$dt = new DateTime($fecha);
		$desde = "'".$dt->format('Y-m-d')."'";
		
		$fecha = $request->to;
		$dt = new DateTime($fecha);
		$hasta = "'".$dt->format('Y-m-d')."'";
		
		if ($idCategoria!=0){
			$sql = "insert into descuentos (id_marca,id_categoria,id_producto,cantidad,porcentaje,desde,hasta) values (0,$idCategoria,0,0,$porcentaje,$desde,$hasta)";
			DB::insert($sql);
			$tipo = "'".Config::get('constants.TIPO_NOTIFICACION_CATEGORIA')."'";

			$sql = "Insert into notificaciones (id_usuario, tipo_notificacion, porcentaje, valor)
					select usuarios.id, $tipo , $porcentaje, categorias.nombre from usuarios, categorias
					where categorias.id = $idCategoria";
			DB::insert($sql);

		}
		
		if ($idMarca!=0){
			$sql = "insert into descuentos (id_marca,id_categoria,id_producto,cantidad,porcentaje,desde,hasta) values ($idMarca,0,0,0,$porcentaje,$desde,$hasta)";
			DB::insert($sql);
			$tipo = "'".Config::get('constants.TIPO_NOTIFICACION_MARCA')."'";
			$sql = "Insert into notificaciones (id_usuario, tipo_notificacion, porcentaje, valor)
					select usuarios.id, $tipo , $porcentaje, marcas.nombre from usuarios, marcas
					where marcas.id = $idMarca";
			DB::insert($sql);
			}
		
		if ($cantidad!=0){
			$sql = "insert into descuentos (id_marca,id_categoria,id_producto,cantidad,porcentaje,desde,hasta) values (0,0,$idProducto,$cantidad,$porcentaje,$desde,$hasta)";
			DB::insert($sql);
			$tipo = "'".Config::get('constants.TIPO_NOTIFICACION_CANTIDAD')."'";
			$sql = "Insert into notificaciones (id_usuario, tipo_notificacion, porcentaje, valor)
					select id, $tipo , $porcentaje, $cantidad from usuarios";
			DB::insert($sql);

			}
		
		
		$url = app()->make('urls')->getUrlDescuentos();
		return redirect($url);
    }
}
