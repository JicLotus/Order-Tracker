<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

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
			$descuentos = DB::select("select * from descuentos");

			

			return view('descuentos.descuentos', ['title' => 'Home',
							'page' => 'home','marcas' => $marcas, 'categorias' => $categorias, 'productos' => $productos, 'descuentos' => $descuentos]
			);
			
  
        
    }
}
