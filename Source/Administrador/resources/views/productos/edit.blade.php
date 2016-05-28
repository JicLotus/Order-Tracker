@extends("layouts.base") 

@section("content")


<a  href="{{app()->make('urls')->getUrlProductos()}}" class="btn btn-primary btn-block"><h4><b>PRODUCTOS</b></h4></a>
<div class="container">
	<div class="row row-head">
	  <div class="col-md-12">
		<h2><strong><?php if ($editar == true){echo "Editar Producto";} else{ echo "Detalle del Producto";}?></strong></h2>
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

	<form action="guardarproducto" method="POST" class="form-horizontal" enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="row">
			<div class="col-md-12">
			
				<div class="col-md-6">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<input type="hidden" name="idProducto" value="{{$producto->id}}">
					
					<div class="row; form-group">
						<label class="col-md-2" for="nombre">Nombre</label>
						<input class="col-md-10" type="Text" name="nombre" value="{{$producto->nombre}}" <?php if ($editar !=true){ ?> disabled <?php }?>><br>
					</div>
				
					<div class="row; form-group">
						<label class="col-md-2" for="codigo">Codigo</label>
						<input class="col-md-10" type="Text" name="codigo" value="{{$producto->codigo}}" <?php if ($editar !=true){ ?> disabled <?php }?>><br>
					</div>
				
					<div class="row; form-group">
						<label class="col-md-3" for="caracteristicas">Caracteristicas</label>
						<textarea class="col-md-9" rows="5" name="caracteristicas" id="caracteristicas"<?php if ($editar !=true){ ?> disabled <?php }?>>{{$producto->caracteristicas}}</textarea>
					</div>
					
					<div class="row; form-group">
						<label class="col-md-2" for="stock">Stock</label>
						<input class="col-md-10" type="Text" name="stock" value="{{$producto->stock}}" <?php if ($editar !=true){ ?> disabled <?php }?>><br>
					</div>
				
					<div class="row; form-group">
						<label class="col-md-2" for="marca">Marca</label>
						<select id="marca" name="marca" <?php if ($editar !=true){ ?> disabled <?php }?> >
								@foreach($marcas as $marca)   
								<option value= {{$marca->id}} <?php If ($marca->id == $producto->marca){?> selected = 'selected'<?php } ?>>{{$marca->nombre}}</option>
								@endforeach
						</select> 
					</div>
				
					<div class="row; form-group">
						<label class="col-md-2" for="categoria">Categoria</label>
						<select id="categoria" name="categoria" <?php if ($editar !=true){ ?> disabled <?php }?> >
							@foreach($categorias as $categoria)   
								<option value= {{$categoria->id}} <?php If ($categoria->id == $producto->categoria){?> selected = 'selected'<?php } ?>>{{$categoria->nombre}}</option>
							@endforeach
						</select> 
					</div>	
				
					<div class="row; form-group">
						<label class="col-md-2" for="precio">Precio</label>
						<input class="col-md-10" type="Text" name="precio" value="{{$producto->precio}}" <?php if ($editar !=true){ ?> disabled <?php }?> ><br>
					</div>
									
				</div> 

				<div class="col-md-6">
					@foreach ($imagenes as $imagen)
					<div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">
						<img class="img-rounded; img-responsive" src="data:image/png;base64, {{$imagen->imagen_base64}}" alt="Pulpit Rock" >
					</div>
					@endforeach
				</div>
				
								  
			</div>

		</div>

	 
		<div class="form-group">
			<div class="col-sm-offset-1">
				<a href="{{app()->make('urls')->getUrlProductos()}}" class="btn btn-default">Atras</a>

				<?php if ($editar ==true){ ?>
					<button type="submit" class= "col-sm-offset-2 btn btn-primary">Guardar</button>
				<?php }else{?>
					<a href="{{app()->make('urls')->getUrlEditarProducto($producto->id)}}" class="col-sm-offset-2 btn btn-primary">Editar</a>
				<?php }?>

			</div>
		</div> 
		
	</form>

</div>
@endsection
