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
     
    public function editarProducto($id)
    {
		$producto = DB::table('productos')->where('id', $id)->first();
		$imagenes = DB::select("Select id_producto,imagen_base64 from imagenes where id_producto=$id");
		$marcas = DB::select("select nombre,id from marcas order by nombre");
		$categorias = DB::select("select nombre,id from categorias order by nombre");

		return view('productos.edit', ['title' => 'Home',
						'page' => 'home','producto'=>$producto,'marcas' => $marcas, 'categorias' => $categorias, 'imagenes'=>$imagenes,'editar'=>true]
		);
	}
	
	public function verProducto($id)
	{
		$producto = DB::table('productos')->where('id', $id)->first();
		$imagenes = DB::select("Select id_producto,imagen_base64 from imagenes where id_producto=$id");
		$marcas = DB::select("select nombre,id from marcas order by nombre");
		$categorias = DB::select("select nombre,id from categorias order by nombre");

		return view('productos.edit', ['title' => 'Home',
						'page' => 'home','producto'=>$producto,'marcas' => $marcas, 'categorias' => $categorias, 'imagenes'=>$imagenes,'editar'=>false]
		);
	}
    
}
