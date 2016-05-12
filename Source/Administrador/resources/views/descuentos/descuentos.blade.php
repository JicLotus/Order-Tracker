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
    $("#datepicker").datepicker({ 
		minDate: -20,
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
			<a  href="{{app()->make('urls')->getUrlDescuentos()}}" class="btn btn-primary btn-block"><h4><b>DESCUENTOS</b></h4></a>

		
<h4><form action="{{app()->make('urls')->getUrlPedidoVendedor()}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
					<div class="row">	

						<label class="col-sm-1" ></label>
						<label class="control-label col-sm-1" >Categoría</label>
							<select class = "col-sm-1" onclick="reload();" id="categoria" name="categoria">
								<option value =  0>Todas las Categorias</option>
								@foreach($categorias as $categoria)
									<option value = {{$categoria->id}}>{{$categoria->nombre}}</option>  
								@endforeach 
							</select>

						<label class="control-label col-sm-1" >Marca</label>
							<select class="col-sm-1" id="idClientee" name="idCliente" >
								<option value = 0>Todas las Marcas</option>
								@foreach($marcas as $marca)   
								<option value = {{$marca->id}}>{{$marca->nombre}}</option>
								@endforeach
							</select> 

						<label class="control-label col-sm-1" >Cantidad</label>

						<select class="col-sm-1" id="cantidad" name="cantidad" >
							<option value = 0 >Todas</option>
							 
							<option value = 1 > Más de 10 iguales</option>
							
							<option value = 2 > Más de 20 iguales</option>
							
							<option value = 3 > Más de 30 iguales</option>

						</select> 

						<label class="control-label col-sm-1" >Fecha</label>
						
						<input class="col-sm-1" type="text" id="datepicker" name = "datepicker" value= "Todas"> 
						
					</div>

					
					<div class="row">	
						
						<button type="submit" class="col-sm-offset-8 btn btn-primary">Buscar</button>
						<a href="{{app()->make('urls')->getUrlNuevoDescuento()}}" class="btn btn-primary">Agregar Nuevo Descuento</a> 
						
					</div>
		</div>	

</form></h4>


<hr width=75%"/>


	@foreach($productos as $producto)
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#{{$producto->idProducto}}"> 
					<b>Descuento aplicando en: {{$producto->nombreProducto}} ,{{$producto->nombreMarca}},  
					{{$producto->nombreCategoria}}</b> 
					</a>
				</h4>
			</div>
		<div id="{{$producto->idProducto}}" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Tipo de descuento</th>
								<th>Porcentaje descontado</th>
								<th>Precio</th>
								<th>Final</th>
								<th>Puesta en vigencia</th>
								<th>Finalización de la vigencia</th>								
							</tr>
						</thead>
						<tbody>
							<?php
								
							foreach($descuentos as $descuento){

								If ($descuento->id_producto == $producto->idProducto){
							?> 
								<tr>
								<?php
								
									If ($descuento->id_marca == $producto->marca){
								  ?> 
													
													
													<td>Por marca ({{$producto->nombreMarca}})</td>
													<td>{{$descuento->porcentaje}}% </td>
													<td>${{$producto->precio}} </td>
													<td>${{$producto->precio*(100-$descuento->porcentaje)/100}} </td>
													<td>{{$descuento->desde}} </td>
													<td>{{$descuento->hasta}} </td>
									
							
								<?php 
									}
									Else{
										If ($descuento->id_categoria == $producto->categoria){
								?>
										
													<td>Por categoria ({{$producto->nombreCategoria}})</td>
													<td>{{$descuento->porcentaje}}% </td>
													<td>${{$producto->precio}} </td>
													<td>${{$producto->precio*(100-$descuento->porcentaje)/100}} </td>
													<td>{{$descuento->desde}} </td>
													<td>{{$descuento->hasta}} </td>
										
								<?php 
										}
										
										Else{
											
								?>
													<td>Por cantidad (Más de {{$descuento->cantidad}})</td>
													<td>{{$descuento->porcentaje}}% </td>
													<td>${{$producto->precio}} </td>
													<td>${{$producto->precio*(100-$descuento->porcentaje)/100}} </td>
													<td>{{$descuento->desde}} </td>
													<td>{{$descuento->hasta}} </td>
													
								<?php 
											
										}
									}
								?>	
								</tr>
								<?php 
								}
							}
								?>		
							
					  
						</tbody>
				  </table>
								
               </li>
			</ul>
		</div>
	</div>	
 </div>	
@endforeach
    
     <?php If (count($descuentos) == 0){?>   
		<div class="alert alert-danger">
			<strong>No existen descuentos! </strong>Revise los filtros seleccionados.
		</div>
	  <?php } ?>
    </section>
	
      </section>
@endsection

