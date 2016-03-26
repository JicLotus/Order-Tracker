<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class NuevoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param integer $id
     * @return Response
     */


    public function index()
    {
    		#$producto = DB::table('productos')->where('id', $id)->first(); 
    		
        return view('productos.nuevoproducto', ['title' => 'Home',
                                'page' => 'home']
        );
    }
    
        public function guardar(Request $request)
    {
  
		#DB::table('productos')->where('id', $request->idProducto)->update(array('nombre' => ($request->nombre),'codigo' => ($request->codigo),'caracteristicas' => ($request->caracteristicas),
		#					'stock' => ($request->stock), 'marca' => ($request->marca), 'categoria' => ($request->categoria),
		#					'precio' => ($request->precio))); 
		
		#$producto = DB::table('productos')->where('id', $request->idProducto)->first();
		
		return Redirect::to('http://www.google.com');
#        return view('productos.productos', ['title' => 'Home',
 #                               'page' => 'home']
  #      );
        
        
    }





}
