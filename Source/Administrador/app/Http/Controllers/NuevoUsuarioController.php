<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;

use Validator;
	 


class NuevoUsuarioController extends Controller
{


    public function index()
    {
    		#$producto = DB::table('productos')->where('id', $id)->first(); 
    		
        return view('usuarios.nuevousuario', ['title' => 'Home',
                                'page' => 'home']
        );
    }
    
        public function guardar(Request $request)
    {

		$validator = Validator::make($request->all(), [           
			'nombre' => 'required',
			'email' => 'required|email|unique:usuarios,email',
			'password' => 'required',
			'privilegio' => 'required',
			'telefono' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }




		#guardo el usuario
		$id = DB::table('usuarios')->insertGetId(array('nombre' => ($request->nombre),'email' => ($request->email),'password' => ($request->password),
							'privilegio' => ($request->privilegio),'telefono' => ($request->telefono) ,'created_at' => (date('Y-m-d H:i:s'))));
		$usuarios = DB::table('usuarios')->get();
	
		 return view('usuarios.usuarios', ['title' => 'Home',
                                'page' => 'home','usuarios' => $usuarios, 'vendedorAnterior' => "", 'emailAnterior' => "", 'accion' => 1]
        );
        
        
    }







}
