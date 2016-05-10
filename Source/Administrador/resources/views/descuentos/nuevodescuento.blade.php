@extends("layouts.base") 

@section("content")

<html lang="en">

<body>
   <meta charset="utf-8">
  <title>jQuery UI Datepicker - Select a Date Range</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

  $(function() {
    $( "#from" ).datepicker({
	
		minDate: 0,
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
		minDate: 0,
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  
  $(function() {
    $( "#from2" ).datepicker({
	
		minDate: 0,
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to2" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to2" ).datepicker({
		minDate: 0,
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from2" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  $(function() {
    $( "#from3" ).datepicker({
	
		minDate: 0,
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to3" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to3" ).datepicker({
		minDate: 0,
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from3" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });

  </script>	
  
  
  
	
 <a  href="{{app()->make('urls')->getUrlDescuentos()}}" class="btn btn-primary btn-block"><h4><b>DESCUENTOS</b></h4></a>
 
<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Nuevo Descuento</strong></h2>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

  </div>
</div>

<div  class="row">
  <div class="col-md-12">
     <h4>
<form action="guardarnuevodescuento" method="POST" class="form-horizontal"   enctype="multipart/form-data">
	{{ csrf_field() }}
	
	
	<div class="panel-group" id="accordion">
		<div class="panel panel-primary">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
				Por Categoría</a>
			  </h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
							  <div class="col-sm-8">
								<select onclick="reload();" id="categoria" name="idCategoria" >
									@foreach($categorias as $categoria)
									<option value = {{$categoria->id}}>{{$categoria->nombre}}</option>  
									@endforeach 
								</select>
								<select onclick="reload();" id="porcentaje1" name="idCategoria" >
									<option value = 10>10% de Descuento</option>  
									<option value = 15>15% de Descuento</option>  
									<option value = 20>20% de Descuento</option>  
									<option value = 25>25% de Descuento</option>  
									<option value = 30>30% de Descuento</option>  
									<option value = 35>35% de Descuento</option>  
									<option value = 40>40% de Descuento</option>  
									<option value = 45>45% de Descuento</option>  
									<option value = 50>50% de Descuento</option>  																
								</select>
								
								</div> 
								
								<div class="col-sm-8">
									<label for="from">Desde</label>
									<input type="text" id="from" name="from">
									<label for="to">Hasta</label>
									<input type="text" id="to" name="to">
								
								</div> 
								<input type="hidden" name="descuento" value=1>
								<button type="submit" class="col-sm-offset-9 btn btn-primary">Publicar filtro por categoría</button>

					</div>	
				</div>
			</div>
		</div>
	</div>
	
</form>

<form action="guardarnuevodescuento" method="POST" class="form-horizontal"   enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="panel-group" id="accordion">
		<div class="panel panel-primary">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
				Por Marca</a>
			  </h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">

							<div class="col-sm-8">
							<select id="idMarca" name="idMarca" >
								@foreach($marcas as $marca)   
								<option value= {{$marca->id}}>{{$marca->nombre}}</option>
								@endforeach
							</select> 
							<select onclick="reload();" id="porcentaje2" name="idCategoria"  >
									<option value = 10>10% de Descuento</option>  
									<option value = 15>15% de Descuento</option>  
									<option value = 20>20% de Descuento</option>  
									<option value = 25>25% de Descuento</option>  
									<option value = 30>30% de Descuento</option>  
									<option value = 35>35% de Descuento</option>  
									<option value = 40>40% de Descuento</option>  
									<option value = 45>45% de Descuento</option>  
									<option value = 50>50% de Descuento</option>  																
								</select>	
							</div>
							<div class="col-sm-8">
									<label for="from">Desde</label>
									<input type="text" id="from2" name="from">
									<label for="to">Hasta</label>
									<input type="text" id="to2" name="to">
								
							</div> 
							<input type="hidden" name="descuento" value=2>
						<button type="submit" class="col-sm-offset-9 btn btn-primary">Publicar filtro por marca</button>
					</div>	
				</div>
			</div>
		</div>
	</div>
</form>


<form action="guardarnuevodescuento" method="POST" class="form-horizontal"   enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="panel-group" id="accordion">
		<div class="panel panel-primary">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
				Por Cantidad (Artículos iguales)</a>
			  </h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse in ">
				<div class="panel-body">
					<div class="form-group">
							  <div class="col-sm-8">
								<select id="cantidad" name="cantidad" >
									 
									<option value = 1 > Más de 10</option>
									
									<option value = 2 > Más de 20</option>
									
									<option value = 3 > Más de 30</option>

								</select>
								
								<select onclick="reload();" id="producto" name="idproducto" >
									@foreach($productos as $producto)
									<option value = {{$producto->id}}>{{$producto->nombre}}</option>  
									@endforeach 
								</select>
								<select onclick="reload();" id="porcentaje3" name="idCategoria" >
									<option value = 10>10% de Descuento</option>  
									<option value = 15>15% de Descuento</option>  
									<option value = 20>20% de Descuento</option>  
									<option value = 25>25% de Descuento</option>  
									<option value = 30>30% de Descuento</option>  
									<option value = 35>35% de Descuento</option>  
									<option value = 40>40% de Descuento</option>  
									<option value = 45>45% de Descuento</option>  
									<option value = 50>50% de Descuento</option>  																
								</select>

								</div> 
								<div class="col-sm-8">
									<label for="from">Desde</label>
									<input type="text" id="from3" name="from">
									<label for="to">Hasta</label>
									<input type="text" id="to3" name="to">
								
								</div> 
								<input type="hidden" name="descuento" value=3>
								<button type="submit" class="col-sm-offset-9 btn btn-primary">Publicar filtro por cantidad</button>

					</div>	
				</div>
			</div>
		</div>
	</div>
	
	
	<a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
               

   </h4>
	
</form>
           
  </div>
</div>

 
 
</body>
</html>

<script type="text/javascript">
function reload() {
	var e = document.getElementById("selectVendedor");
	var idvendedor = e.options[e.selectedIndex].value.split(")")[0];
	document.getElementById('idVendedorr').value = idvendedor;
	
	var ee = document.getElementById("selectCliente");
	var idcliente = ee.options[ee.selectedIndex].value.split(")")[0];
	var elemento= document.getElementById('idclientee');
	elemento.value = idcliente;
}
</script>

</div>

@endsection
