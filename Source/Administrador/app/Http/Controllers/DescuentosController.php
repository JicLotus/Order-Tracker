<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;
use DateTime;
use Carbon;

class DescuentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {		
		$sql = "select descuentos.id,id_marca,id_categoria,marcas.nombre as marca, categorias.nombre as categoria, porcentaje,id_producto, cantidad, desde, hasta from descuentos
		 left join marcas on descuentos.id_marca = marcas.id left join categorias on
		  descuentos.id_categoria = categorias.id order by desde desc, descuentos.id desc";
		$descuentos = DB::select($sql);
		
		
		$categorias = DB::select("select * from categorias");
		$marcas = DB::select("select * from marcas");
		return view('descuentos.descuentos', ['title' => 'Home',
						'page' => 'home','descuentos' => $descuentos,'marcas'=> $marcas, 'categorias'=>$categorias,
						'idCategoria'=>0,'idMarca'=>0,'cantidadMarcada'=>0,'fechaMarcada'=>"", 'eliminado' => -1]
		);
			
    }
    
    public function filtro(Request $request)
    {	
		
			$sql = "select descuentos.id,id_marca,id_categoria,marcas.nombre as marca, categorias.nombre as categoria, porcentaje,
			 id_producto, cantidad, desde, hasta from descuentos left join marcas on
			 descuentos.id_marca = marcas.id left join categorias on descuentos.id_categoria = categorias.id where 1=1 ";
			
			$categorias = DB::select("select * from categorias");
			$marcas = DB::select("select * from marcas");
			
			$idMarca = $request->idMarca;
			$idCategoria = $request->categoria;
			$cantidad = $request->cantidad;
			$fecha = $request->datepicker;
			if ($fecha != "Todas" || $idMarca != 0 || $idCategoria != 0){ 
				
				if ($fecha != ""){
					$dt = new DateTime($fecha);
					$fecha = "'".$dt->format('Y-m-d')."'";	
					$sql .= " and descuentos.desde <= $fecha and descuentos.hasta >= $fecha";
				}
				
				if ($idMarca != 0)
					$sql .= " and id_marca=$idMarca";
					
				if ($idCategoria != 0)
					$sql.= " and id_categoria=$idCategoria";
					
				if ($cantidad != 0)
					$sql.= " and cantidad=$cantidad";
			}
			$sql .= " order by desde desc, descuentos.id desc";
			
			$descuentos = DB::select($sql);
			return view('descuentos.descuentos', ['title' => 'Home',
							'page' => 'home','descuentos' => $descuentos,'marcas'=> $marcas, 'categorias'=>$categorias,
							'idCategoria'=>$idCategoria,'idMarca'=>$idMarca,'cantidadMarcada'=>$cantidad,
							'fechaMarcada'=>$request->datepicker , 'eliminado' => -1]
			);
	}
    
    public function borrarDescuentosVencidos()
    {
		$dt = new DateTime('today');
		$fechaActual = "'".$dt->format('Y-m-d')."'";
		
		DB::delete("delete from descuentos where hasta<$fechaActual");
		
		$url = app()->make('urls')->getUrlDescuentos();
		return redirect($url);
	}
    
    
    
    public function eliminarDescuento($id, Request $request)
    {
		$dt = new DateTime('today');
		$fechaActual = "'".$dt->format('Y-m-d')."'";
		
		$eliminado = DB::delete("delete from descuentos where (id= $id and not(desde <= $fechaActual and hasta >= $fechaActual))");
		
		
			$sql = "select descuentos.id,id_marca,id_categoria,marcas.nombre as marca, categorias.nombre as categoria, porcentaje,
			 id_producto, cantidad, desde, hasta from descuentos left join marcas on
			 descuentos.id_marca = marcas.id left join categorias on descuentos.id_categoria = categorias.id where 1=1 ";
			
			$categorias = DB::select("select * from categorias");
			$marcas = DB::select("select * from marcas");
			
			$idMarca = $request->idMarca;
			$idCategoria = $request->categoria;
			$cantidad = $request->cantidad;
			$fecha = $request->datepicker;
			if ($fecha != "Todas" || $idMarca != 0 || $idCategoria != 0){ 
				
				if ($fecha != ""){
					$dt = new DateTime($fecha);
					$fecha = "'".$dt->format('Y-m-d')."'";	
					$sql .= " and descuentos.desde <= $fecha and descuentos.hasta >= $fecha";
				}
				
				if ($idMarca != 0)
					$sql .= " and id_marca=$idMarca";
					
				if ($idCategoria != 0)
					$sql.= " and id_categoria=$idCategoria";
					
				if ($cantidad != 0)
					$sql.= " and cantidad=$cantidad";
			}
			$sql .= " order by desde desc";
			
			
			$descuentos = DB::select($sql);
			return view('descuentos.descuentos', ['title' => 'Home',
							'page' => 'home','descuentos' => $descuentos,'marcas'=> $marcas, 
							'categorias'=>$categorias,'idCategoria'=>$idCategoria,'idMarca'=>$idMarca,
							'cantidadMarcada'=>$cantidad,'fechaMarcada'=>$request->datepicker, 'eliminado' => $eliminado]
			);
	}
    
    
    
}
