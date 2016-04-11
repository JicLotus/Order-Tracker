<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Property as Property;

class GuardarClienteController extends Controller
{
    
    public function index(Request $request)
    {
  
		DB::table(Config::get('constants.TABLA_CLIENTES'))->where(Config::get('constants.TABLA_CLIENTES_ID'), $request->idCliente)
				->update(array(Config::get('constants.TABLA_CLIENTES_NOMBRE') => ($request->nombre),
				Config::get('constants.TABLA_CLIENTES_DIRECCION') => ($request->direccion),
				Config::get('constants.TABLA_CLIENTES_RAZON_SOCIAL') => ($request->razon_social),
				Config::get('constants.TABLA_CLIENTES_TELEFONO_1') => ($request->telefono_movil), 
				Config::get('constants.TABLA_CLIENTES_TELEFONO_2') => ($request->telefono_laboral),
				Config::get('constants.TABLA_CLIENTES_EMAIL') => ($request->email)));
		
		$cliente = DB::table(Config::get('constants.TABLA_CLIENTES'))
					->where(Config::get('constants.TABLA_CLIENTES_ID'), $request->idCliente)->first();
		
		return view('clientes.editcliente', ['title' => 'Home',
							'page' => 'home','cliente'=>$cliente]
			);
    }
}
