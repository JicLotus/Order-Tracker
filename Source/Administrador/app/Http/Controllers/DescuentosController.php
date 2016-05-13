<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

use DateTime;

class DescuentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {		
			$productos = DB::select("select *, productos.id as idProducto, productos.nombre as nombreProducto,
			 marcas.nombre as nombreMarca, categorias.nombre as nombreCategoria 
			from productos,marcas,categorias,descuentos 
			where productos.marca = marcas.id and productos.categoria = categorias.id 
			and productos.id = descuentos.id_producto group by productos.id");
			
			$marcas = DB::select("select nombre,id from marcas order by nombre");
			$categorias = DB::select("select nombre,id from categorias order by nombre");
			
			
			$dt = new DateTime();
			$fecha = "'".$dt->format('Y-m-d')."'";
			
			$descuentos = DB::select("select * from descuentos where descuentos.desde <= $fecha");

			

			return view('descuentos.descuentos', ['title' => 'Home',
							'page' => 'home','marcas' => $marcas, 'categorias' => $categorias, 'productos' => $productos, 'descuentos' => $descuentos]
			);
			
    }
    
    public function filtro(Request $request)
    {	
			$productos = DB::select("select *, productos.id as idProducto, productos.nombre as nombreProducto,
			 marcas.nombre as nombreMarca, categorias.nombre as nombreCategoria 
			from productos,marcas,categorias,descuentos 
			where productos.marca = marcas.id and productos.categoria = categorias.id 
			and productos.id = descuentos.id_producto group by productos.id");
			
			$marcas = DB::select("select nombre,id from marcas order by nombre");
			$categorias = DB::select("select nombre,id from categorias order by nombre");

			$sql = "select * from descuentos";

			$idMarca = $request->idMarca;
			$idCategoria = $request->categoria;
			$cantidad = $request->cantidad;
			$fecha = $request->datepicker;

			if ($fecha != "Todas" || $idMarca != 0 || $idCategoria != 0){ 
				$sql.=" where 1=1";
				
				if ($fecha != "Todas"){
					$dt = new DateTime($fecha);
					$fecha = "'".$dt->format('Y-m-d')."'";	
					$sql .= " and descuentos.desde <= $fecha";
				}
				
				if ($idMarca != 0)
					$sql .= " and id_marca=$idMarca";

				if ($idCategoria != 0)
					$sql.= " and id_categoria=$idCategoria";
					
			}

			$descuentos = DB::select($sql);

			return view('descuentos.descuentos', ['title' => 'Home',
							'page' => 'home','marcas' => $marcas, 'categorias' => $categorias, 'productos' => $productos, 'descuentos' => $descuentos]
			);
	}
    
    
}
