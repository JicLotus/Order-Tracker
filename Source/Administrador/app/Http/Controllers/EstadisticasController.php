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

		  $anios = DB::select("select distinct date_format(dia,'%Y') as anio from estadisticas order by anio desc");
		  $vendedores = DB::select ("select id, nombre from usuarios");

		  $ano = '';
		  $sql = "select usuarios.nombre as nombre, (sum(vendido_fuera_ruta)+sum(vendido_clientes)) as totalVendido 
					from estadisticas, usuarios 
					where date_format(dia, '%Y') LIKE '%$ano%' 
					and usuarios.id = estadisticas.id_usuario
					group by id_usuario 
					order by totalVendido desc 
					LIMIT 10;";

		  $rankingVendedores = DB::select($sql);
		  $ventaDelMes = DB::select("select date_format(dia, '%Y') as anio, sum(vendido_fuera_ruta)+sum(vendido_clientes) as total from estadisticas where date_format(dia, '%m')= 05 group by anio order by total desc;");
			return view('estadisticas.estadisticas', ['title' => 'Home',
						'page' => 'home', 'rankingVendedores' => $rankingVendedores, 'anios'=> $anios, 'vendedores' => $vendedores,
						'ventaDelMes' => $ventaDelMes]
		);
			
    }
    
        public function filtrar(Request $request)
    {	
	
			$vendedor = $request->vendedor;
			$anio = $request->anio;
			$mes = $request->mes;

			$anios = DB::select("select distinct date_format(dia,'%Y') as anio from estadisticas order by anio desc");
			$vendedores = DB::select ("select id, nombre from usuarios");

			$sql = "select usuarios.nombre as nombre, (sum(vendido_fuera_ruta)+sum(vendido_clientes)) as totalVendido 
					from estadisticas, usuarios 
					where date_format(dia, '%Y') LIKE '%$anio%' 
					and usuarios.id = estadisticas.id_usuario
					and date_format(dia, '%m') LIKE '%$mes%'
					group by id_usuario 
					order by totalVendido desc 
					LIMIT 10;";

			$rankingVendedores = DB::select($sql);
		  $ventaDelMes = DB::select("select date_format(dia, '%Y') as anio, sum(vendido_fuera_ruta)+sum(vendido_clientes) as total from estadisticas where date_format(dia, '%m')= 05 group by anio order by total desc;");

			return view('estadisticas.estadisticas', ['title' => 'Home',
						'page' => 'home', 'rankingVendedores' => $rankingVendedores, 'anios'=> $anios, 'vendedores' => $vendedores,
						'ventaDelMes' => $ventaDelMes]
		);
	
		
	}
    
    
}
