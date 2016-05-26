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
    public function index(){
		
		$usuarios = DB::table('usuarios')->get();
                        
        return view('usuarios.usuarios', ['title' => 'Home',
                                'page' => 'home','usuarios' => $usuarios, 'vendedorAnterior' => "", 'emailAnterior' => "", 'accion' => 0]
        );
        
        
    }
    
     public function filtro(Request $request){
		
		$vendedorAnterior = $request->nombre;
		//$emailAnterior = $request->mail;
		$vendedor = strtoupper($vendedorAnterior);		
		 
		$usuarios =  DB::select("select * from usuarios where UPPER(nombre) like '%$vendedor%'");
                        
        return view('usuarios.usuarios', ['title' => 'Home',
                                'page' => 'home','usuarios' => $usuarios, 'vendedorAnterior' => $vendedorAnterior, 'emailAnterior' => "" ,'accion' => 0]
        );
        
        
    }
}
