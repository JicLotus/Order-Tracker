@extends("layouts.base") 

@section("content")
<a  href="{{app()->make('urls')->getUrlProductos()}}" class="btn btn-primary btn-block"><h4><b>PRODUCTOS</b></h4></a>

<div class="container">
	<div class="row row-head">
	  <div class="col-md-12">
		<h2><strong>Nuevo Producto</strong></h2>
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

    
 
<form action="guardarnuevoproducto" method="POST" class="form-horizontal" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="idProducto" value="">
	
	<div class="row; form-group">
			<label class="col-md-2" for="nombre">Nombre</label>
			<input class="col-md-10" type="Text" name="nombre" value="{{ old('nombre') }}" ><br>
    </div>
    
    <div class="row; form-group">
		<label class="col-md-2" for="codigo">Codigo</label>
		<input class="col-md-10" type="Text" name="codigo" value="{{ old('codigo') }}" ><br>
    </div>
    
	<div class="row; form-group">
		<label class="col-md-2"for="caracteristicas">Caracteristicas</label>
		<textarea class="col-md-10" rows="5" name="caracteristicas">{{ old('caracteristicas') }}</textarea>
	</div>
    
    <div class="row; form-group">
		<label class="col-md-2" for="stock">Stock</label>
		<input class="col-md-10" type="Text" name="stock" value="{{ old('stock') }}"><br>
    </div>
    
    <div class="row; form-group">
		<label class="col-md-2" for="marca">Marca</label>
		<select id="marca" name="marca" >
				@foreach($marcas as $marca)   
				<option value= {{$marca->id}}>{{$marca->nombre}}</option>
				@endforeach
		</select> 
    </div>
    
    <div class="row; form-group">
		<label class="col-md-2" for="categoria">Categoria</label>
		<select id="categoria" name="categoria" >
				@foreach($categorias as $categoria)   
				<option value= {{$categoria->id}}>{{$categoria->nombre}}</option>
				@endforeach
		</select> 
    </div>	
    
    <div class="row; form-group">
		<label class="col-md-2" for="precio">Precio</label>
		<input class="col-md-10" type="Text" name="precio" value="{{ old('precio') }}"><br>
    </div>	

	<div class="row; form-group">
		<label class="col-md-2" for="imagen">Imagen</label>
		<input class="col-md-10; file" type="file" name="imagen" id="imagen">
    </div>	
	
	<div class="row; form-group">
		<label class="col-md-2" for="imagen2">Imagen</label>
		<input class="col-md-10; file" type="file" name="imagen2" id="imagen2">
    </div>	
    
	<div class="row; form-group">
		<label class="col-md-2" for="imagen3">Imagen</label>
		<input class="col-md-10; file" type="file" name="imagen3" id="imagen3">
    </div>	
    
	<div class="row; form-group">
		<label class="col-md-2" for="imagen4">Imagen</label>
		<input class="col-md-10; file" type="file" name="imagen4" id="imagen4">
    </div>	

    	
	<div class="form-group">
		<div class="">
			<a href="{{app()->make('urls')->getUrlProductos()}}" class="btn btn-default">Cancelar</a>

			<button type="submit" class= " col-sm-offset-2 btn btn-primary">Publicar
			</button>

		</div>
	</div> 		
			
	
</form>
                              
  </div>

@endsection
