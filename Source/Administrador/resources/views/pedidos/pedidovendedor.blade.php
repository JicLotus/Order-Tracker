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
						<option value = {{$vendedor->id}} <?php If ($vendedor->id == $idVendedor){?> selected = 'selected'<?php } ?>>{{$vendedor->nombre}}</option>  
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
						<option value = {{$cliente->id}}<?php If ($cliente->id == $idCliente){?> selected = 'selected'<?php } ?>>{{$cliente->nombre}}</option>
						@endforeach
					
					</select> 
					</div>
			</div>	
			 
			 <div class="form-group">
				<label class="control-label col-sm-2" for="Día">Fecha</label>
        			 <div class="col-sm-8">
				<input type="text" id="datepicker" name = "datepicker" value= "{{$fecha2}}">
			</div>
		</div>	
			
			<button type="submit" class="col-sm-2 col-sm-offset-3 btn btn-primary">Buscar</button>
		</div>	

</form></h4>


<hr width=75%"/>

	<div class="form-group">

	</div>	
              
	@foreach($bultos as $bulto)
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#{{$bulto->id_compra}}"> <b> Número	 de identificación: {{$bulto->id_compra}}</b> </a>
				</h4>
			</div>
		<div id="{{$bulto->id_compra}}" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					
					<div>
					
					<form action="{{app()->make('urls')->getUrlEditarPedido($bulto->id_compra)}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
								{{ csrf_field() }}
									<div class="form-group">
										<label class="control-label" for="Estado">Estado del pedido:</label>
											<select id="estado" name="estado" onchange= "this.form.submit()" >
												
												<option value="en_proceso" <?php If ($bulto->estado == "pendiente"){?> selected = 'selected'<?php } ?>>Pendiente</option>
												<option value="en_proceso" <?php If ($bulto->estado == "en_proceso"){?> selected = 'selected'<?php } ?>>En Proceso de Armado</option>
												<option value="en_proceso" <?php If ($bulto->estado == "empaquetado"){?> selected = 'selected'<?php } ?>>Empaquetado</option>												
												<option value="entregado"  <?php If ($bulto->estado == "entregado"){?> selected = 'selected'<?php } ?> >Entregado</option>
												<option value="cancelado" <?php If ($bulto->estado == "cancelado"){?> selected = 'selected'<?php } ?>>Cancelado</option>
            
											</select>
									</div>	
									<input type="hidden" name="idCliente" value={{$bulto->id_cliente}}>
									<input type="hidden" name="idVendedor" value={{$bulto->id_usuario}}>
									<input type="hidden" name="datepicker" value={{$fecha2}}>
									
					</form>

               </div>
				
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Código</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								 <?php
								$cantidadfinal = 0;
								foreach($pedidos as $pedido){
									If ($pedido->id_compra == $bulto->id_compra){
								?>   
													
													
													<td>{{$pedido->nombreProducto}}</td>
													 <td>{{$pedido->codigo}} </td>
													 <td>{{$pedido->cantidad}} </td>
													<td>${{$pedido->precio}} </td>

										<?php	
													$cantidadfinal +=  $pedido->cantidad * $pedido->precio;     
										} 
										?>
									
							</tr>	
								<?php 
								}?>
								
							<tr class="info">
								<td><b>Total</b></td>
								<td></td>
								<td></td>
								<td><b>${{$cantidadfinal}}</b></td>
							</tr>
								

					  
						</tbody>
				  </table>
								
               </li>
			</ul>
		</div>
	</div>	
    @endforeach
    
     <?php If (count($bultos) == 0){?>   
		<div class="alert alert-danger">
			<strong>No existen compras! </strong>Revise el nombre del cliente seleccionado.
		</div>
	  <?php } ?>
    </section>

@endsection

