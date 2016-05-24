@extends("layouts.base") 

@section("content")
<a  href="{{app()->make('urls')->getUrlProductos()}}" class="btn btn-primary btn-block"><h4><b>PRODUCTOS</b></h4></a>
<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Editar Producto</strong></h2>
  </div>
</div>

<div class="row">
  <div class="col-md-7  col-sm-offset-1">
    
 
<form action="guardarproducto" method="POST" class="form-horizontal" enctype="multipart/form-data">


	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<input type="hidden" name="idProducto" value="{{$producto->id}}">
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="nombre">Nombre</label>
          <div class="col-sm-8">
			<input type="Text" name="nombre" value="{{$producto->nombre}}" ><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="codigo">Codigo</label>
          <div class="col-sm-8">
			<input type="Text" name="codigo" value="{{$producto->codigo}}" ><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="caracteristicas">Caracteristicas</label>
          <div class="col-sm-8">
			<input type="Text" name="caracteristicas" value="{{$producto->caracteristicas}}"> <br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="stock">Stock</label>
          <div class="col-sm-8">
			<input type="Text" name="stock" value="{{$producto->stock}}"><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="marca">Marca</label>
          <div class="col-sm-8">
			<select id="marca" name="marca" >
					@foreach($marcas as $marca)   
					<option value= {{$marca->id}} <?php If ($marca->id == $producto->marca){?> selected = 'selected'<?php } ?>>{{$marca->nombre}}</option>
					@endforeach
			</select> 
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="categoria">Categoria</label>
          <div class="col-sm-8">
			<select id="categoria" name="categoria" >
					@foreach($categorias as $categoria)   
					<option value= {{$categoria->id}} <?php If ($categoria->id == $producto->categoria){?> selected = 'selected'<?php } ?>>{{$categoria->nombre}}</option>
					@endforeach
			</select> 
		  </div>
    </div>	
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="precio">Precio</label>
          <div class="col-sm-8">
			<input type="Text" name="precio" value="{{$producto->precio}}"><br>
		  </div>
    </div>	
	
     
    <div class="form-group">
            <div class="col-sm-offset-1">
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>

                <button type="submit" class= " col-sm-offset-2 btn btn-primary">Publicar
                </button>

            </div>
        </div> 		
			
			
			
	
</form>
                              
  </div>
</div>
</div>

@endsection
