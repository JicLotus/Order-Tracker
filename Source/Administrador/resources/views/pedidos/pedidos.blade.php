@extends("layouts.base")

@section("head")
<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Default functionality</title>
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
    $("#datepicker").datepicker({ 
		maxDate: "+1M +10D",
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date"
	});
  });
  </script>
</head>


  <script type="text/javascript">
    $(document).ready(function(){
      $(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
      });
    });
  </script>

@endsection

@section("content")

    
@section("content")
    <section id="search-section">
			<a  href="{{app()->make('urls')->getUrlPedidos()}}" class="btn btn-primary btn-block"><h4><b>PEDIDOS</b></h4></a>

		
<h4><form action="{{app()->make('urls')->getUrlPedidoVendedor()}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}
			
			<div class="row">
				<div class="centerside col-md-1">
					 </div>	
				<div class="centerside col-md-3">		
				<label  class=" control-label col-sm-4" for="Vendedor">Vendedor</label>
				  <div class="col-sm-8">
					<select onclick="reload();" id="idVendedor" name="idVendedor">
						<option>Todos</option>
						@foreach($vendedores as $vendedor)
						<option value = {{$vendedor->id}}>{{$vendedor->nombre}}</option>  
						@endforeach 
					</select>
				  </div> 
				 </div>
				<div class="centerside col-md-3">
				<label  class="control-label col-sm-4" for="Clientes">Cliente</label>
					<div class="col-sm-8 col-sm-3">
					<select id="idClientee" name="idCliente" >
						<option>Todos</option>
						@foreach($clientes as $cliente)   
						<option value = {{$cliente->id}}>{{$cliente->nombre}}</option>
						@endforeach
					</select> 
					</div>
				 </div>
			 
				<div class="centerside col-md-3">
					<label  class="control-label col-sm-3" for="Día">Fecha</label>
						<div class="col-sm-8">
					<input type="text" id="datepicker" name = "datepicker" value= "Todas">
				 </div>
				</div>
		</div>
		<div class="row">	
					
					<button type="submit" class="col-sm-1 col-sm-offset-8 btn btn-primary">Buscar</button>
									
		</div>

</form></h4>


<hr width=75%"/>

    </section>
@endsection

