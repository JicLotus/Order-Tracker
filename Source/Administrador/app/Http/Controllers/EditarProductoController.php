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
    		
        return view('productos.edit', ['title' => 'Home',
                                'page' => 'home','producto'=>$producto]
        );
    }


}
