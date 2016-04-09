<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EditarClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param integer $id
     * @return Response
     */
    public function index($id)
    {
    		$cliente = DB::table('clientes')->where('id', $id)->first(); 
    		
			return view('clientes.editcliente', ['title' => 'Home',
							'page' => 'home','cliente'=>$cliente]
			);
			
    }
}
