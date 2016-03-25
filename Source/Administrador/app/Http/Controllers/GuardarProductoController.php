<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class GuardarProductoController extends Controller
{
    
    public function index(Request $request)
    {
  
		DB::table('productos')->where('id', $request->idProducto)->update(array('nombre' => ($request->nombre),'codigo' => ($request->codigo),'caracteristicas' => ($request->caracteristicas),
							'stock' => ($request->stock), 'marca' => ($request->marca), 'categoria' => ($request->categoria),
							'precio' => ($request->precio))); 
		
		$producto = DB::table('productos')->where('id', $request->idProducto)->first();
		
        return view('productos.edit', ['title' => 'Home',
                                'page' => 'home','producto'=>$producto]
        );
        
        
    }
}
