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
  $(function() {
    $( "#datepicker" ).datepicker();
    $("#timePicker").timePicker();
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
		<div class="form-group">
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="Vendedor">Vendedor</label>
				  <div class="col-sm-8">
					<select onclick="reload();" id="idVendedor" name="idVendedor">
						<option>Todos</option>
						@foreach($vendedores as $vendedor)
						<option value = {{$vendedor->id}}>{{$vendedor->nombre}}</option>  
						@endforeach 
					</select>
				  </div> 
			</div>	
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="Clientes">Clientes</label>
					<div class="col-sm-8">
					<select id="idClientee" name="idCliente" >
						<option>Todos</option>
						@foreach($clientes as $cliente)   
						<option value = {{$cliente->id}}>{{$cliente->nombre}}</option>
						@endforeach
					</select> 
					</div>
			</div>	
			 
			 <div class="form-group">
				<label class="control-label col-sm-2" for="Día">Fecha</label>
					<div class="col-sm-8">
				<input type="text" id="datepicker" name = "datepicker" value= "Todas">
			</div>
			
			
		</div>	
		<button type="submit" class="col-sm-2 col-sm-offset-3 btn btn-primary">Buscar</button>
</form></h4>


<hr width=75%"/>

	<a href="{{app()->make('urls')->getUrlEliminarPedidosCancelados()}}" class="btn btn-primary">Eliminar Pedidos Cancelados</a> 
      </section>
@endsection

