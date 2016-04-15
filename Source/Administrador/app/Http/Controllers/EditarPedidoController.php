<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class EditarProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param integer $id
     * @return Response
     */
    public function index($id)
    {
    		$pedido = DB::table('pedido')->where('id', $id)->first(); 
    		
			return view('pedidos.pedido', ['title' => 'Home',
							'page' => 'home','pedido'=>$pedido]
			);
			
    }
}
