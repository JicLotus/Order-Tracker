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

		  $productos = DB::table('productos')
            ->leftJoin('imagenes', 'productos.id', '=', 'imagenes.id_producto')
            ->get();
                        
        return view('productos.productos', ['title' => 'Home',
                                'page' => 'home','productos' => $productos]
        );
        
        
    }
}
