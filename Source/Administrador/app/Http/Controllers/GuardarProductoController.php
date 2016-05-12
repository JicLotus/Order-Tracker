<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Property as Property;

class GuardarProductoController extends Controller
{
    
    public function index(Request $request)
    {
  
		DB::table(Config::get('constants.TABLA_PRODUCTOS'))->where(Config::get('constants.TABLA_PRODUCTOS_ID'), $request->idProducto)
				->update(array(Config::get('constants.TABLA_PRODUCTOS_NOMBRE') => ($request->nombre),
				Config::get('constants.TABLA_PRODUCTOS_CODIGO') => ($request->codigo),
				Config::get('constants.TABLA_PRODUCTOS_CARACTERISTICAS') => ($request->caracteristicas),
				Config::get('constants.TABLA_PRODUCTOS_STOCK') => ($request->stock),
				Config::get('constants.TABLA_PRODUCTOS_MARCA') => ($request->marca), 
				Config::get('constants.TABLA_PRODUCTOS_CATEGORIA') => ($request->categoria),
				Config::get('constants.TABLA_PRODUCTOS_PRECIO') => ($request->precio))); 
		
		$producto = DB::table(Config::get('constants.TABLA_PRODUCTOS'))
					->where(Config::get('constants.TABLA_PRODUCTOS_ID'), $request->idProducto)->first();
		$marcas = DB::select("select nombre,id from marcas order by nombre");
		$categorias = DB::select("select nombre,id from categorias order by nombre");

		return view('productos.edit', ['title' => 'Home',
						'page' => 'home','producto'=>$producto,'marcas' => $marcas, 'categorias' => $categorias]
		);

	
        
    }
}
