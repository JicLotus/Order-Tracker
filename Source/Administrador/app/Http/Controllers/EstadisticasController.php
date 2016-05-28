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

		  $dt = new DateTime();
		  $mesFiltro = $dt->format('m');
		  $anioFiltro = $dt->format('Y');
		  $anioAnterior = $anioFiltro-1;
		  $vendedorFiltro = '';

			$sql = "select usuarios.nombre as nombre, (sum(vendido_fuera_ruta)+sum(vendido_clientes)) as totalVendido 
					from estadisticas, usuarios 
					where date_format(dia, '%Y') LIKE '%$anioFiltro%' 
					and usuarios.id = estadisticas.id_usuario
					and date_format(dia, '%m') LIKE '%$mesFiltro%'
					group by id_usuario 
					order by totalVendido desc 
					LIMIT 10;";

		  $rankingVendedores = DB::select($sql);

		  $rankingMarcas = DB::Select("(select  marcas.id, marcas.nombre as marca, sum(pedidos.cantidad) as cantidad, 
												sum(precio_final*cantidad) as total 
										from pedidos, productos, marcas, compras 
										where pedidos.id_producto = productos.id 
										and compras.id_compra = pedidos.id_compra 
										and date_format(fecha, '%m') = $mesFiltro 
										and date_format(fecha,'%Y') = $anioFiltro 
										and marcas.id = productos.marca 
										group by marcas.id order by cantidad desc LIMIT 5);");
			
			$ventaDelMes = DB::select("(select $anioFiltro as anio, ifnull((select sum(vendido_fuera_ruta)+sum(vendido_clientes) as total from estadisticas 
										where date_format(dia, '%m') like '%$mesFiltro%' and id_usuario like '%%' and date_format(dia,'%Y') like '%$anioFiltro%'
										group by date_format(dia,'%Y')), 0) as total)
										union
										(select $anioAnterior as anio, ifnull((select sum(vendido_fuera_ruta)+sum(vendido_clientes) as total from estadisticas 
										where date_format(dia, '%m') like '%$mesFiltro%' and id_usuario like '%%' and date_format(dia,'%Y') like '%$anioAnterior%' 
										group by date_format(dia,'%Y')), 0) as total)");
			
			return view('estadisticas.estadisticas', ['title' => 'Home',
						'page' => 'home', 'rankingVendedores' => $rankingVendedores, 'anios'=> $anios, 'vendedores' => $vendedores,
						'rankingMarcas'=>$rankingMarcas, 'ventaDelMes' => $ventaDelMes, 'mesFiltro'=>$mesFiltro, 'anioFiltro'=>$anioFiltro, 'vendedorFiltro'=>$vendedorFiltro]
		);
			
    }
    
        public function filtrar(Request $request)
    {	
	
		$vendedor = $request->vendedor;
		$anio = $request->anio;
		$mes = $request->mes;

		$dt = new DateTime();
			
		  $mesFiltro = $mes;
		  $anioFiltro = $anio;
		  
		  $vendedorFiltro = $vendedor;
			

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

			$anioAnterior = $anio-1;

			if ($vendedor == ''){
				$vendedor = 'null';
			}
	
			
			
			$ventaDelMes = DB::select("(select $anio as anio, ifnull((select sum(vendido_fuera_ruta)+sum(vendido_clientes) as total from estadisticas 
										where date_format(dia, '%m') like '%$mes%' and id_usuario like ifnull($vendedor, '%%') and date_format(dia,'%Y') like '%$anio%'
										group by date_format(dia,'%Y')), 0) as total)
										union
										(select $anioAnterior as anio, ifnull((select sum(vendido_fuera_ruta)+sum(vendido_clientes) as total from estadisticas 
										where date_format(dia, '%m') like '%$mes%' and id_usuario like ifnull($vendedor, '%%') and date_format(dia,'%Y') like '%$anioAnterior%' 
										group by date_format(dia,'%Y')), 0) as total)");

		  $rankingMarcas = DB::Select("(select  marcas.id, marcas.nombre as marca, sum(pedidos.cantidad) as cantidad, 
												sum(precio_final*cantidad) as total 
										from pedidos, productos, marcas, compras 
										where pedidos.id_producto = productos.id 
										and compras.id_compra = pedidos.id_compra 
										and date_format(fecha, '%m') = $mesFiltro 
										and date_format(fecha,'%Y')= $anioFiltro 
										and marcas.id = productos.marca 
										group by marcas.id order by cantidad desc LIMIT 5);");
			
			if ($rankingMarcas == null){
				echo $rankingMarcas = '';
			}

						return view('estadisticas.estadisticas', ['title' => 'Home',
						'page' => 'home', 'rankingVendedores' => $rankingVendedores, 'anios'=> $anios, 'vendedores' => $vendedores,
						'rankingMarcas'=>$rankingMarcas, 'ventaDelMes' => $ventaDelMes, 'mesFiltro'=>$mesFiltro, 'anioFiltro'=>$anioFiltro, 'vendedorFiltro'=>$vendedorFiltro]
		);



		
	}
    
    
}
