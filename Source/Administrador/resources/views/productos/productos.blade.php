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
			 
			 <div class="centerside">
			<label >Nombre</label>
			<input  type="text" name="nombre" value= "{{$nombre}}">
			
			<label >Codigo</label>
			<input   type="text" name="codigo" value= "{{$codigo}}">
			
			<select name="idMarca" >
				<option value = 0>Todas</option>
				@foreach($marcas as $marca)   
					<option value = {{$marca->id}} <?php If ($marca->id == $idMarca){?> selected = 'selected'<?php } ?>>{{$marca->nombre}}</option>
				@endforeach
			</select> 
			
			<button type="submit" class="btn btn-primary">Buscar</button>
			<a href="{{app()->make('urls')->getUrlAgregarProducto()}}" class="btn btn-primary">Agregar</a>
			
			</div>
		</form>       
		           
		
		
		@foreach($productos as $producto)
			<p>
				<div class="well center box-centerside">
					 
					<div class="col-md-4">
						<div class="control-group">
							<img src="data:image/png;base64, {{$producto->imagen_base64}}" alt="Pulpit Rock" style="width:150px;height:150px">
						</div>
					</div>
				
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
				
					<a href="{{app()->make('urls')->getUrlEditarProducto($producto->id)}}" class="btn btn-primary">Ver mas</a>                                
					<a href="{{app()->make('urls')->getUrlEliminarProducto($producto->id)}}" class="btn btn-primary">Eliminar</a>
					
				</div>
				
			</p>
		@endforeach
        
    </section>

@endsection

