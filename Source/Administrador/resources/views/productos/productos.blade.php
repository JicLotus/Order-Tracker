@extends("layouts.base")

@section("head")

	
<style type="text/css">
    .box-centerside  {
      margin-left: 25%;
      min-height:190px;
      width:50%;
    }
    
    .centerside  {
      margin-left: 28%;
      margin-top:2%;
    }
  </style>

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
		
		
		<a  href="{{app()->make('urls')->getUrlProductos()}}" class="btn btn-primary btn-block"><h4><b>PRODUCTOS</b></h4></a>
		
		<form action="{{app()->make('urls')->getUrlBuscarProducto()}}" method="POST" class="form-horizontal"   enctype="multipart/form-data">
			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
			 
			<h4><div class="form-group">
					<div class="row">	

						<label class="col-sm-offset-1 control-label col-sm-1" >Nombre</label>
							<input  class="col-sm-2" type="text" name="nombre" value= "{{$nombre}}">
								

						<label class="control-label col-sm-1" >Código</label>
							<input  class="col-sm-2"type="text" name="codigo" value= "{{$codigo}}">

						<label class="control-label col-sm-1" >Marca</label>
							<select name="idMarca" >
								<option value = 0>Todas</option>
								@foreach($marcas as $marca)   
								<option value = {{$marca->id}} <?php If ($marca->id == $idMarca){?> selected = 'selected'<?php } ?>>{{$marca->nombre}}</option>
								@endforeach
							</select> 
					</div>
				
			
					<div class="row">	
						
						<a href="{{app()->make('urls')->getUrlAgregarProducto()}}" class="col-sm-2 col-sm-offset-2 btn btn-primary">Agregar Nuevo Producto</a> 	
						<button type="submit" class="col-sm-1 col-sm-offset-4 btn btn-primary">Buscar</button>
           						
						
					</div>
			</div>	</h4> 
			 
			 <?php If ($accion != 0){
				If ($accion == 1){?>
					<div class="alert alert-success">
						<strong>Producto Eliminado exitosamente!</strong>
					</div>
			<?php } Else If ($accion == 2){	?> 
						<div class="alert alert-success">
							<strong>Producto editado exitosamente!</strong>
						</div>
			<?php 	}Else If ($accion == 3){ ?>
						<div class="alert alert-success">
							<strong>Producto creado exitosamente!</strong>
						</div>					
			<?php	}
			}?>
		@foreach($productos as $producto)
			<p>
				<div class="well center box-centerside">
					 
					<div class="col-md-4">
						<div class="control-group">
							<img src="data:image/png;base64, {{$producto->imagen_base64}}" alt="Pulpit Rock" style="width:150px;height:150px">
						</div>
					</div>
					<br>
					
					<div class="control-group">
						<span class="control-label dimgray">Nombre: {{$producto->nombre}}</span>
					</div>
					
					<div class="control-group">
						<span class="control-label dimgray">Marca: {{$producto->nombreMarca}}</span>
					</div>
					
					<div class="control-group">
						<span class="control-label dimgray">Categoria: {{$producto->nombreCategoria}}</span>
					</div>
					
					<div class="control-group">
						<span class="control-label dimgray">Codigo: {{$producto->codigo}}</span>
					</div>
					
						<div class="col-sm-offset-4 col-sm-1 col-md-2 ">
							<a href="{{app()->make('urls')->getUrlVerProducto($producto->id)}}" class="btn btn-primary">Ver más</a>                                
						</div>
						
						<div class="col-sm-2">
							<a href="{{app()->make('urls')->getUrlEliminarProducto($producto->id)}}" class="btn btn-danger">Eliminar</a>
						</div>
					
				</div>
				
			</p>
		@endforeach
        
    </section>

@endsection

