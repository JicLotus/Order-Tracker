<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;

	 


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

		$this->validate($request, [
        'email' => 'required',
        'nombre' => 'required',
        'password' => 'required',
        'privilegio' => 'required'
		]);

		#guardo el usuario
		$id = DB::table('usuarios')->insertGetId(array('nombre' => ($request->nombre),'email' => ($request->email),'password' => ($request->password),
							'privilegio' => ($request->privilegio), 'created_at' => (date('Y-m-d H:i:s'))));

	
		$url = app()->make('urls')->getUrlUsuarios();
		return redirect($url);
        
    }







}
