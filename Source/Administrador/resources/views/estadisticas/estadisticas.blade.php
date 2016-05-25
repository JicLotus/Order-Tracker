@extends("layouts.base") 

@section("content")
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
		google.charts.load("current", {packages:["corechart", "bar"]});

		google.charts.setOnLoadCallback(topVendedores);
		google.charts.setOnLoadCallback(ventaDelMes);

		
		function topVendedores() {
			var data = google.visualization.arrayToDataTable([
				['Task', 'Hours per Day'],
				['Juan Costa',     11],
				['Jose Castelli',      2],
				['Gabriel Masi',  2],
				['Debora Martin', 2],
				['Juan Laura',    7]
				]);

			var options = {
				title: 'Top 10 Vendedores',
				is3D: true,
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
		  }


		function ventaDelMes() {
			 var data = google.visualization.arrayToDataTable([
				['Ventas', '2015', '2016'],
				['Ventas', 8175000, 808000]
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
<div class="container">

	<div class="row">

		<div class="col-md-4">
			<label class="control-label" >Vendedor</label>
			<select name="idMarca" >
				<option value = 1 >Juan Laura</option>
				<option value = 2 >Jose Castelli</option>
			</select>
		</div>
	
		<div class="col-md-4">
			<label class="control-label" >Mes</label>
			<select  name="cantidad" >
				<option value = 1 >Enero</option>
				<option value = 2 >Febrero</option>
				<option value = 3 >Marzo</option>
				<option value = 4 >Abril</option>
				<option value = 5 >Mayo</option>
				<option value = 6 >Junio</option>
				<option value = 7 >Julio</option>
				<option value = 8 >Agosto</option>
				<option value = 9 >Septiembre</option>
				<option value = 10 >Octubre</option>
				<option value = 11 >Noviembre</option>
				<option value = 12 >Diciembre</option>
			</select>
		</div>
			
		<div class="col-md-4">
			<label class="control-label" >Año</label>
			<select name="cantidad" >
				<option value = 2015 >2015</option>
				<option value = 2016 >2016</option>
			</select>
		</div>
	
	
	</div>


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



</div>

@endsection
