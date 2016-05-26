@extends("layouts.base") 

@section("content")
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
		google.charts.load("current", {packages:["corechart", "bar"]});

		google.charts.setOnLoadCallback(topVendedores);
		google.charts.setOnLoadCallback(ventaDelMes);

		
		function topVendedores() {
			
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Nombre');
			data.addColumn('number', 'Cantidad Vendida');
			
			@foreach($rankingVendedores as $vendedor)
				data.addRows([
				  ['{{$vendedor->nombre}}', {{$vendedor->totalVendido}}] // Example of specifying actual and formatted values.
				]);				
			@endforeach
			

	
			var options = {
				title: 'Top 10 Vendedores',
				is3D: true,
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
		  }


		function ventaDelMes() {
		 	var data = new google.visualization.DataTable();
		
			data.addColumn('string', 'Nombre');
		
			@foreach($ventaDelMes as $venta)
				data.addColumn('number', '{{$venta->anio}}');
			@endforeach
		
				data.addRows([
				  ['Ventas', {{$ventaDelMes[0]->total}}, {{$ventaDelMes[1]->total}}] // Example of specifying actual and formatted values.
				]);				
			

		  var options = {
			title: 'Mayo de 2016: $5.000.245',
			chartArea: {width: '60%'},
			height:300,
			hAxis: {
			  title: '',
			  minValue: 0
			},
			vAxis: {
			  title: ''
			}
		  };

		  var chart = new google.visualization.BarChart(document.getElementById('barchart_material'));
		  chart.draw(data, options);
		}
</script>
</head>

<a  href="{{app()->make('urls')->getUrlEstadisticas()}}" class="btn btn-primary btn-block"><h4><b>ESTADISTICAS</b></h4></a>
<h4><form action="{{app()->make('urls')->getUrlFiltrarEstadisticas()}}" method="POST" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="form-group">

	<div class="row">

		<div class="col-md-3">
			<label class="control-label" >Vendedor</label>
			<select name="vendedor" >
				<option value = ''>Todos</option>
				@foreach($vendedores as $vendedor)   
					<option value = {{$vendedor->id}}> {{$vendedor->nombre}}</option>
				@endforeach
			</select>
		</div>
	
		<div class="col-md-3">
			<label class="control-label" >Mes</label>
			<select  name="mes" >
				<option value = '' >Todos</option>
				<option value = 01 >Enero</option>
				<option value = 02 >Febrero</option>
				<option value = 03 >Marzo</option>
				<option value = 04 >Abril</option>
				<option value = 05 >Mayo</option>
				<option value = 06 >Junio</option>
				<option value = 07 >Julio</option>
				<option value = 08 >Agosto</option>
				<option value = 09 >Septiembre</option>
				<option value = 10 >Octubre</option>
				<option value = 11 >Noviembre</option>
				<option value = 12 >Diciembre</option>
			</select>
		</div>
			
		<div class="col-md-3">
			<label class="control-label" >Año</label>
			<select name="anio" >

			<option value = ''>Todos</option>
			@foreach($anios as $anio)   
				<option value = {{$anio->anio}}> {{$anio->anio}}</option>
			@endforeach
			
			</select>

			
		</div>
	

		<div class="col-md-3">	
			<button type="submit" class="btn btn-primary">Buscar</button>
			
		</div>

	</div>	
		
</form></h4>

	<table class="columns">
      <tr>
        <td style="padding:0 135px 0 15px;">
			<div id="barchart_material" >
			</div>
		</td>
        
        <td style="padding:0 15px 0 15px;"><div id = "tabla" >
				<table class="table table-striped">
			<thead>
			  <tr>
				<th>Marca</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Porcentaje</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>Sony</td>
				<td>25</td>
				<td>$40000</td>
				<td>15%</td>
			  </tr>
			  <tr>
				<td>Sony</td>
				<td>25</td>
				<td>$40000</td>
				<td>15%</td>
			  </tr>
			  <tr>
				<td>Sony</td>
				<td>25</td>
				<td>$40000</td>
				<td>15%</td>
			  </tr>
			  <tr>
				<td>Sony</td>
				<td>25</td>
				<td>$40000</td>
				<td>15%</td>
			  </tr>
			  <tr>
				<td>Sony</td>
				<td>25</td>
				<td>$40000</td>
				<td>15%</td>
			  </tr>
			</tbody>
		  </table>
			</div>
			</div>
        </td>
      </tr>
    </table>


	<div class = "row">	
			<body>
				<div id="piechart_3d" >
			</body>		

	</div>


@endsection
