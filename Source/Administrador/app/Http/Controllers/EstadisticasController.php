<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Property as Property;
use DateTime;
use Carbon;

class EstadisticasController extends Controller
{
    public function index()
    {		
		return view('estadisticas.estadisticas', ['title' => 'Home',
						'page' => 'home']
		);
			
    }
    
    
}
