<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Property as Property;

class GuardarUsuarioController extends Controller
{
    
    public function index(Request $request)
    {
		$id = $request->idUsuario;
		$vendedor = DB::select("select * from usuarios where id=$id");
		
		$this->validate($request, [
        'email' => 'required|email|unique:clientes,email',
        'nombre' => 'required',
        'telefono' => 'required',
        'password' => 'required',
        'password2' => 'required',
        'password3' => 'required',
		]);
		
		if($request->password == $vendedor[0]->password){
				if ($request->password2 == $request->password3 ){
					DB::table(Config::get('constants.TABLA_USUARIOS'))->where(Config::get('constants.TABLA_USUARIOS_ID'), $request->idUsuario)
						->update(array(Config::get('constants.TABLA_USUARIOS_NOMBRE') => ($request->nombre),
						Config::get('constants.TABLA_USUARIOS_EMAIL') => ($request->email),
						Config::get('constants.TABLA_USUARIOS_PASSWORD') => ($request->password),
						Config::get('constants.TABLA_USUARIOS_PRIVILEGIO') => ($request->privilegio),
						Config::get('constants.TABLA_USUARIOS_TELEFONO') => ($request->telefono)));				
				}else{
					$this->validate($request, [
					'telefono' => 'alpha'
					]);
				}
		}else{
			$this->validate($request, [
			'telefono' => 'active_url'
			]);
		}
		
		
		$usuarios = DB::table('usuarios')->get();

		 return view('usuarios.usuarios', ['title' => 'Home',
                                'page' => 'home','usuarios' => $usuarios, 'vendedorAnterior' => "", 'emailAnterior' => "", 'accion' => 2]
        ); 
        
    }
    
    
}
