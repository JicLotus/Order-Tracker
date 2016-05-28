@extends("layouts.base") 

@section("content")


<head>

	<style type="text/css">
	.box-centerside  {
	  margin-left: 25%;
	  min-height:190px;
	  width:50%;
	}

	.centerside  {
	  margin-top:1%;
	}
	</style>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

		var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio",
								"Julio","Agosto","Septiembre","Octubre","Noviembre",
								"Diciembre");

		google.charts.load("current", {packages:["corechart", "bar"]});

		if ('{{$vendedorFiltro}}' == ''){
			google.charts.setOnLoadCallback(topVendedores);
		}

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
				title: 'Top 10 Vendedores {{$anioFiltro}}',
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
			
		  var mes = meses[{{$mesFiltro}}-1];
					
		  var options = {
			title: mes +' de {{$anioFiltro}}: ${{$ventaDelMes[0]->total}}',
			chartArea: {width: '60%'},
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

<a  href="{{app()->make('urls')->getUrlEstadisticas()}}" class="col-md-8 btn btn-primary btn-block"><h4><b>ESTADISTICAS</b></h4></a>

<h4><form action="{{app()->make('urls')->getUrlFiltrarEstadisticas()}}" method="POST" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}

	<div class="row">

		<div class="centerside col-md-3">
			<label class="control-label" >Vendedor</label>
			<select name="vendedor" >
				<option value = '' <?php If ($vendedorFiltro == ''){?> selected = 'selected'<?php } ?>}>Todos</option>
				@foreach($vendedores as $vendedor)   
					<option value = '{{$vendedor->id}}' <?php If ($vendedorFiltro == $vendedor->id){?> selected = 'selected'<?php } ?>} > {{$vendedor->nombre}}</option>
				@endforeach
			</select>
		</div>
	
		<div class="centerside col-md-3">
			<label class="control-label" >Mes</label>

			<select  name="mes" >
				<option value = 01 <?php If ($mesFiltro == 01){?> selected = 'selected'<?php } ?>}>Enero</option>
				<option value = 02 <?php If ($mesFiltro == 02){?> selected = 'selected'<?php } ?>}>Febrero</option>
				<option value = 03 <?php If ($mesFiltro == 03){?> selected = 'selected'<?php } ?>}>Marzo</option>
				<option value = 04 <?php If ($mesFiltro == 04){?> selected = 'selected'<?php } ?>}>Abril</option>
				<option value = 05 <?php If ($mesFiltro == 05){?> selected = 'selected'<?php } ?>}>Mayo</option>
				<option value = 06 <?php If ($mesFiltro == 06){?> selected = 'selected'<?php } ?>}>Junio</option>
				<option value = 07 <?php If ($mesFiltro == 07){?> selected = 'selected'<?php } ?>}>Julio</option>
				<option value = 08 <?php If ($mesFiltro == 08){?> selected = 'selected'<?php } ?>}>Agosto</option>
				<option value = 09 <?php If ($mesFiltro == 09){?> selected = 'selected'<?php } ?>}>Septiembre</option>
				<option value = 10 <?php If ($mesFiltro == 10){?> selected = 'selected'<?php } ?>}>Octubre</option>
				<option value = 11 <?php If ($mesFiltro == 11){?> selected = 'selected'<?php } ?>}>Noviembre</option>
				<option value = 12 <?php If ($mesFiltro == 12){?> selected = 'selected'<?php } ?>}>Diciembre</option>
			</select>
		</div>
			
		<div class="centerside col-md-3">
			<label class="control-label" >Año</label>
			<select name="anio" >
				<option value = 2016 <?php If ($anioFiltro == 2016){?> selected = 'selected'<?php } ?>}>2016</option>
				<option value = 2015 <?php If ($anioFiltro == 2015){?> selected = 'selected'<?php } ?>}>2015</option>
			</select>

			
		</div>

		<div class="centerside col-md-3">	
			<button type="submit" class="btn btn-primary">Buscar</button>
			
		</div>

	</div>	

		
</form></h4>
	<table class="columns">
      <tr>

        <td style="padding:0 0px 0 0px;">
			<h3 style="padding:30 0px 0 120px; 	"><span style="font-weight: bold; background-color:grey">Ventas del mes en curso {{$anioFiltro-1}}-{{$anioFiltro}}</span></h3> 
			<div id="barchart_material" style="width: 600px; height: 300px;" >
			</div>
		</td>
        
        <td style="padding:0 0px 0px 0px;"><div id = "tabla" style="width: 500px; height: 300px;"  >
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
			@if($rankingMarcas==null)

			@else 
				<?php
					$cantidadfinal = 0;
					foreach($rankingMarcas as $marca){
						$cantidadfinal+=$marca->total;
					}
				?> 
			
			@foreach($rankingMarcas as $marca)

			  <tr>
				<td>{{$marca->marca}}</td>
				<td>{{$marca->cantidad}}</td>
				<td>${{$marca->total}}</td>
				<td><?php echo(round($marca->total/$cantidadfinal*100,2))?>% </td>
			  </tr>
			@endforeach

			@endif
			</tbody>
		  </table>
			</div>
			</div>
        </td>
      </tr>
    </table>


	<div class = "row">	
			<body>
				<div id="piechart_3d" style="  padding: 0 0px 150 250px; width: 900px; height: 500px;"  >
			</body>		

	</div>


@endsection
