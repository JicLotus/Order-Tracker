<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EditarUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param integer $id
     * @return Response
     */
    public function editarUsuario($id)
    {
    		$usuario = DB::table('usuarios')->where('id', $id)->first(); 
    		
			return view('usuarios.editusuario', ['title' => 'Home',
							'page' => 'home','usuario'=>$usuario,'editar'=>true]
			);
    }
    
    public function verUsuario($id)
    {
    		$usuario = DB::table('usuarios')->where('id', $id)->first(); 
    		
			return view('usuarios.editusuario', ['title' => 'Home',
							'page' => 'home','usuario'=>$usuario,'editar'=>false]
			);
    }
}
