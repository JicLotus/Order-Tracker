<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class UsuariosController extends Controller
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

		  $usuarios = DB::table('usuarios')->get();
                        
        return view('usuarios.usuarios', ['title' => 'Home',
                                'page' => 'home','usuarios' => $usuarios]
        );
        
        
    }
}
