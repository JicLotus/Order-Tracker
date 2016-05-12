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
    		$producto = DB::table('productos')->where('id', $id)->first(); 
    		$marcas = DB::select("select nombre,id from marcas order by nombre");
			$categorias = DB::select("select nombre,id from categorias order by nombre");

			return view('productos.edit', ['title' => 'Home',
							'page' => 'home','producto'=>$producto,'marcas' => $marcas, 'categorias' => $categorias]
			);
			
    }
}
