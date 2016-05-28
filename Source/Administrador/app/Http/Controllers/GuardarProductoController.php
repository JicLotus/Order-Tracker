<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Property as Property;

class GuardarProductoController extends Controller
{
    
    public function index(Request $request)
    {
		
		$collection = array(     
			'nombre' => 'required',			
			'precio' => 'required|numeric|min:0',
			'marca'  => 'required',
			'stock'  => 'required|integer|min:1',
        );
		
		$codigo = DB::table(Config::get('constants.TABLA_PRODUCTOS'))
				->where(Config::get('constants.TABLA_PRODUCTOS_ID'), $request->idProducto)
				->pluck(Config::get('constants.TABLA_PRODUCTOS_CODIGO'));

		if ($codigo!=$request->codigo){
			$collection = array_add($collection, 'codigo', 'required|unique:productos,codigo');
		}
		
		$validator = Validator::make($request->all(), $collection);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

  
		DB::table(Config::get('constants.TABLA_PRODUCTOS'))->where(Config::get('constants.TABLA_PRODUCTOS_ID'), $request->idProducto)
				->update(array(Config::get('constants.TABLA_PRODUCTOS_NOMBRE') => ($request->nombre),
				Config::get('constants.TABLA_PRODUCTOS_CODIGO') => ($request->codigo),
				Config::get('constants.TABLA_PRODUCTOS_CARACTERISTICAS') => ($request->caracteristicas),
				Config::get('constants.TABLA_PRODUCTOS_STOCK') => ($request->stock),
				Config::get('constants.TABLA_PRODUCTOS_MARCA') => ($request->marca), 
				Config::get('constants.TABLA_PRODUCTOS_CATEGORIA') => ($request->categoria),
				Config::get('constants.TABLA_PRODUCTOS_PRECIO') => ($request->precio))); 
		
		  $sql = "SELECT u.id, u.nombre, u.codigo, u.stock, u.marca, MIN(t.imagen_base64) AS imagen_base64,m.nombre as nombreMarca, c.nombre as nombreCategoria FROM productos u Left JOIN imagenes t ON t.id_producto = u.id 
		  Left JOIN marcas m ON m.id = u.marca
		  Left Join categorias c ON c.id= u.categoria GROUP BY u.id;";

		  $productos = DB::select($sql);
		  $marcas = DB::select("select * from marcas");

        return view('productos.productos', ['title' => 'Home',
                                'page' => 'home','productos' => $productos,'marcas'=> $marcas, 'idMarca'=>0, 'nombre'=>'','codigo'=>'',
                                'accion' => 2]
        );	
        
    }
}
