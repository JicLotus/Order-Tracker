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
      numberOfMonths: 1,
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
      numberOfMonths: 1,
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
      numberOfMonths: 1,
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
      numberOfMonths: 1,
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
      numberOfMonths: 1,
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
      numberOfMonths: 1,
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
			
<div class="panel-group" id="TiposGeneral">					
			<label for="from">Desde</label>
			<input type="text" id="from" name="from" value="<?php echo date("d-m-Y"); ?>">
			<label for="to">Hasta</label>
			<input type="text" id="to" name="to" value="<?php echo date("d-m-Y"); ?>">
			
			<label>Porcentaje</label> <input name="porcentaje" value=0 type="number" min="1" max="100" /> %
</div>
			
<div class="panel-group" id="TiposDescuentos">
	
	
			<div class="panel panel-primary">
				
				<div class="panel-heading">
				  <h4 class="panel-title">
					<label>Categoría</label>
				  </h4>
				</div>
				
				<div id="collapse1" class="panel-collapse collapse in">
					<div class="panel-body">
						<div class="form-group">
							  <div class="col-sm-8">
								<select name="idCategoria" >
									
									<option value=0 selected>Descuento sin categoria</option>
									
									@foreach($categorias as $categoria)
									<option value = {{$categoria->id}}>{{$categoria->nombre}}</option>  
									@endforeach 
									
								</select>
								</div> 
						</div>	
					</div>
				</div>
				
			</div>
			
			<div class="panel panel-primary">
			
			<div class="panel-heading">
			  <h4 class="panel-title">	
				<label > Marca</label>
			  </h4>
			</div>
			
			<div id="collapse2" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">

							<div class="col-sm-8">
							<select name="idMarca" >
								<option value=0 selected>Descuento sin marca</option>
								@foreach($marcas as $marca)   
								<option value= {{$marca->id}}>{{$marca->nombre}}</option>
								@endforeach
							</select> 
							
							</div>
					</div>	
				</div>
			</div>
			</div>
			
			
			<div class="panel panel-primary">
				
			<div class="panel-heading">
			  <h4 class="panel-title">
				<label>Cantidad</label>
			  </h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse in ">
				<div class="panel-body">
					<div class="form-group">
							  <div class="col-sm-8">
								<select name="cantidad" >
									
									<option value=0 selected>Descuento sin cantidad</option>
									
									<option value = 10 > Más de 10</option>
									<option value = 20 > Más de 20</option>
									<option value = 30 > Más de 30</option>
								</select>
								
					</div>	
				</div>
			</div>
			</div>
		
	</div>
		<a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
		<button type="submit" class="col-sm-offset-9 btn btn-primary">Publicar descuento</button>
	   </h4>
	</form>   
		
		
	</div>
</div>

 
</body>
</html>

</div>

@endsection
