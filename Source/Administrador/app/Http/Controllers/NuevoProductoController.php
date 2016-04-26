<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;

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

		#este validation valida que se haya cargado una imagen
		#Si la imagen se cargo entonces se ejecuta el codigo que sigue
		#Si la imagen no se cargo, o el archivo que se cargo no es una imagen
		#entonces el codigo siguiente no se ejecuta y se vuelve al formulario (se hace automaticamente
		
		$this->validate($request, [
        'imagen' => 'image|required',
        'nombre' => 'required'
		]);
		
		

		#guardo el producto
		$id = DB::table('productos')->insertGetId(array('nombre' => ($request->nombre),'codigo' => ($request->codigo),'caracteristicas' => ($request->caracteristicas),
							'stock' => ($request->stock), 'marca' => ($request->marca), 'categoria' => ($request->categoria),
							'precio' => ($request->precio)));


		#se pasa la imagen a base64
		$file= $request->file('imagen');		
		$codificacion = base64_encode(file_get_contents($file));
		$periods = new DatePeriod($dt, new DateInterval('P1D'), 4);
		
		#se guarda la imagen en base64 en la BBDD
		DB::table('imagenes')->insert(array('id_producto' => $id, 'imagen_base64' => $codificacion));		
		
		$imagen2 = $request->file('imagen2');
		$imagen3 = $request->file('imagen3');
		$imagen4 = $request->file('imagen4');
			
		if ($imagen2 != null){
			$codificacion = base64_encode(file_get_contents($imagen2));
			DB::table('imagenes')->insert(array('id_producto' => $id, 'imagen_base64' => $codificacion));					
		}
		if ($imagen3 != null){
			$codificacion = base64_encode(file_get_contents($imagen3));
			DB::table('imagenes')->insert(array('id_producto' => $id, 'imagen_base64' => $codificacion));					
		}
		if ($imagen4 != null){
			$codificacion = base64_encode(file_get_contents($imagen4));
			DB::table('imagenes')->insert(array('id_producto' => $id, 'imagen_base64' => $codificacion));					
		}
		
		$url = app()->make('urls')->getUrlProductos();
		return redirect($url);
        
    }





}
