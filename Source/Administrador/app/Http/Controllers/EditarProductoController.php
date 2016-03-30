<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class EditarProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param integer $id
     * @return Response
     */


    public function index($id)
    {
		
		$producto = DB::table(Config::get('constants.TABLA_PRODUCTOS'))
						->where(Config::get('constants.TABLA_PRODUCTOS_ID'), $id)->first(); 
    		
        return view('productos.edit', ['title' => 'Home',
                                'page' => 'home','producto'=>$producto]
        );
    }




}
