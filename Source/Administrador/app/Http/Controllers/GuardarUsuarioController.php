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
		DB::table(Config::get('constants.TABLA_USUARIOS'))->where(Config::get('constants.TABLA_USUARIOS_ID'), $request->idUsuario)
				->update(array(Config::get('constants.TABLA_USUARIOS_NOMBRE') => ($request->nombre),
				Config::get('constants.TABLA_USUARIOS_EMAIL') => ($request->email),
				Config::get('constants.TABLA_USUARIOS_PASSWORD') => ($request->password),
				Config::get('constants.TABLA_USUARIOS_PRIVILEGIO') => ($request->privilegio)));
						

		$usuario = DB::table(Config::get('constants.TABLA_USUARIOS'))
					->where(Config::get('constants.TABLA_USUARIOS_ID'), $request->idUsuario)->first();

		return view('usuarios.editusuario', ['title' => 'Home',
							'page' => 'home','usuario'=>$usuario]
			);
    }
}
