<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class ClientesController extends Controller
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

		  $clientes = DB::table('clientes')->get();
                        
        return view('clientes.clientes', ['title' => 'Home',
                                'page' => 'home','clientes' => $clientes]
        );
        
        
    }
}
