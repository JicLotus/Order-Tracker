<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	/*
DB::table('productos')->insert(
    ['nombre' => 'El producto2', 'codigo' => 'asd']
);*/

#    	  $productos = DB::table('productos')->get();

		  
		  $sql = "SELECT u.id, u.nombre, u.codigo, u.stock, u.marca, MIN(t.imagen_base64) AS imagen_base64 FROM productos u JOIN imagenes t ON t.id_producto = u.id GROUP BY u.id;";

		  $productos = DB::select($sql);

        return view('productos.productos', ['title' => 'Home',
                                'page' => 'home','productos' => $productos]
        );
        
        
    }
}
