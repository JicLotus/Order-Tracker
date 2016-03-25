<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;

class GuardarProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     

     public function edit(Request $request)
    {   
    	$user = app()->make('currentUser');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->mobile_phone = $request->input('mobile_phone');
        $user->cuit = $request->input('cuit');
        if($user->password != $request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return redirect('/profile');
    }
    */
    
    public function index($id)
    {
    	/*
DB::table('productos')->insert(
    ['nombre' => 'El producto2', 'codigo' => 'asd']
);*/
    	 	
		DB::table('productos')->where('id', $id)->update(array('nombre' => (htmlspecialchars($_POST["nombre"])))); //$input[name="nombre"]
		
		$producto = DB::table('productos')->where('id', $id)->first();
		
        return view('productos.edit', ['title' => 'Home',
                                'page' => 'home','producto'=>$producto]
        );
        
        
    }
}
