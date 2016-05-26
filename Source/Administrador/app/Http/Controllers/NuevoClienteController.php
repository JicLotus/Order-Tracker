<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use File;
use Validator;
use Mail;


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
		$validator = Validator::make($request->all(), [
             
			'nombre' => 'required',
			'email' => 'required|email|unique:clientes,email',
			'direccion' => 'required',
			'telefono_movil' => 'required'
		
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
			
		#guardo el cliente
		$id = DB::table('clientes')->insertGetId(array('nombre' => ($request->nombre),'email' => ($request->email),'direccion' => ($request->direccion),
							'razon_social' => ($request->razon_social), 'telefono_movil' => ($request->telefono_movil), 'telefono_laboral' => ($request->telefono_laboral),
							));


		$data['idCliente'] = $id;
		
		Mail::send('clientes.email', ['id'=>$id], function($message) use($request){
		$message->to($request->email, $request->nombre)->subject('Bienvenido '  .$request->nombre . ' a Order Tracker!');
		});

		
		$clientes = DB::select("select * from clientes order by nombre ");
		  $clienteAnterior = "";
 		  $razonAnterior = "";
 		  $direccionAnterior = "";                     
        return view('clientes.clientes', ['title' => 'Home',
                                'page' => 'home','clientes' => $clientes,  
                                'clienteAnterior'=> $clienteAnterior ,'razonAnterior' =>  $razonAnterior , 'direccionAnterior'=> $direccionAnterior , 'accion' => 1]
        );
        
    }







}

