<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;

	 


class NuevoClienteController extends Controller
{


    public function index()
    {
    		#$producto = DB::table('productos')->where('id', $id)->first(); 
    		
        return view('clientes.nuevocliente', ['title' => 'Home',
                                'page' => 'home']
        );
    }
    
        public function guardar(Request $request)
    {

		$this->validate($request, [
        'email' => 'required',
        'nombre' => 'required',
        'direccion' => 'required'
		]);
		
		

		#guardo el cliente
		$id = DB::table('clientes')->insertGetId(array('nombre' => ($request->nombre),'email' => ($request->email),'direccion' => ($request->direccion),
							'razon_social' => ($request->razon_social), 'telefono_movil' => ($request->telefono_movil), 'telefono_laboral' => ($request->telefono_laboral),
							));


	
		$url = app()->make('urls')->getUrlClientes();
		return redirect($url);
        
    }







}
