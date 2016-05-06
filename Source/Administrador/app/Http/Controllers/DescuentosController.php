<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class DescuentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {		
			$vendedores = DB::select("select nombre,id from usuarios where privilegio = 2 order by nombre");
			$clientes = DB::select("select nombre,id from clientes order by nombre");

        
        return view('descuentos.descuentos', ['title' => 'Home',
                                'page' => 'home', 'clientes' => $clientes,'vendedores' => $vendedores]
        );
        
    }
}
