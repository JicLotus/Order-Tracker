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
					<a data-toggle="collapse" href="#{{$bulto->id_compra}}"> 
					<b>Pedido: {{$bulto->id_compra}}  ,  {{$bulto->nombre}}   ,  {{$bulto->razon_social}}   ,  {{$bulto->fecha}}
					  ,  {{$bulto->nombreVendedor}}</b> </a>
				</h4>
			</div>
		<div id="{{$bulto->id_compra}}" <?php If ($compraeditada == $bulto->id_compra){?> class="panel-collapse collapse in" <?php }else  ?> class="panel-collapse collapse" >
			<ul class="list-group">
				<li class="list-group-item"> 
					
					<div>
					
					<form action="{{app()->make('urls')->getUrlEditarPedido($bulto->id_compra)}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
								{{ csrf_field() }}
									<div class="form-group">
										<label class="control-label" for="Estado">Estado del pedido:</label>
											<select id="estado" name="estado" onchange= "this.form.submit()" >
												
												<option value="pendiente" <?php If ($bulto->estado == "pendiente"){?> selected = 'selected'<?php } ?>>Pendiente</option>
												<option value="en_proceso" <?php If ($bulto->estado == "en_proceso"){?> selected = 'selected'<?php } ?>>En Proceso de Armado</option>
												<option value="empaquetado" <?php If ($bulto->estado == "empaquetado"){?> selected = 'selected'<?php } ?>>Empaquetado</option>												
												<option value="en_distribucion"  <?php If ($bulto->estado == "en_distribucion"){?> selected = 'selected'<?php } ?> >En Distribución</option>
												<option value="entregado"  <?php If ($bulto->estado == "entregado"){?> selected = 'selected'<?php } ?> >Entregado</option>
												<option value="facturado" <?php If ($bulto->estado == "facturado"){?> selected = 'selected'<?php } ?>>Facturado</option>
												<option value="cancelado" <?php If ($bulto->estado == "cancelado"){?> selected = 'selected'<?php } ?>>Cancelado</option>
            
											</select>
									</div>	
									<input type="hidden" name="idCliente" value={{$bulto->id_cliente}}>
									<input type="hidden" name="idVendedor" value={{$bulto->id_usuario}}>
									<input type="hidden" name="filtroCliente" value={{$idCliente}}>
									<input type="hidden" name="filtroVendedor" value={{$idVendedor}}>
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
								<th>Precio Final</th>
								<th>Subtotal</th>
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
													<td>${{$pedido->precio_final}} </td>
													<td>${{$pedido->precio_final*$pedido->cantidad}} </td>

										<?php	
													$cantidadfinal +=  $pedido->cantidad * $pedido->precio_final;     
										} 
										?>
									
							</tr>	
								<?php 
								}?>
								
							<tr class="info">
								<td><b>Total</b></td>
								<td></td>
								<td></td>
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
			<strong>No existen compras! </strong>Revise los filtros seleccionados.
		</div>
	  <?php } ?>
    </section>

@endsection

