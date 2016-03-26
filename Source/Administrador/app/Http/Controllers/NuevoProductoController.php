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

		if ($request->hasFile('imagen'))
		{
			$id = DB::table('productos')->insertGetId(array('nombre' => ($request->nombre),'codigo' => ($request->codigo),'caracteristicas' => ($request->caracteristicas),
							'stock' => ($request->stock), 'marca' => ($request->marca), 'categoria' => ($request->categoria),
							'precio' => ($request->precio)));

			$file= $request->file('imagen');
			$destinationPath = public_path().'/img/';
			$filename        = $id. '_' . date('Y-m-d H:i:s');
			$uploadSuccess   = $file->move($destinationPath, $filename);
			
			DB::table('imagenes')->insert(array('id_producto' => $id, 'ruta_imagen' => '/img/'.$filename));
			
		}
  
		$url = "{{app()->make('urls')->getUrlProductos()}";

		return redirect()->action('ProductosController@index');

        
    }





}
