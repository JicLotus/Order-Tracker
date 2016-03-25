@extends("layouts.base") 

@section("content")

<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Editar Producto</strong></h2>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    
  
<form action="{{app()->make('urls')->getUrlGuardarProducto($producto->id)}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="nombre">Nombre</label>
          <div class="col-sm-8">
			<input type="Text" name="nombre" value={{$producto->nombre}} ><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="codigo">Codigo</label>
          <div class="col-sm-8">
			<input type="Text" name="codigo" value={{$producto->codigo}} ><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="caracteristicas">Caracteristicas</label>
          <div class="col-sm-8">
			<input type="Text" name="caracteristicas" value={{$producto->caracteristicas}}> <br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="stock">Stock</label>
          <div class="col-sm-8">
			<input type="Text" name="stock" value={{$producto->stock}}><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="marca">Marca</label>
          <div class="col-sm-8">
			<input type="Text" name="marca"  value={{$producto->marca}}><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="categoria">Categoria</label>
          <div class="col-sm-8">
			<input type="Text" name="categoria"  value={{$producto->categoria}}><br>
		  </div>
    </div>	
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="precio">Precio</label>
          <div class="col-sm-8">
			<input type="Text" name="precio" value={{$producto->precio}}><br>
		  </div>
    </div>	
	
	<div class="form-group">
          <div class="col-sm-8">     
			 <a type="Submit" href="{{app()->make('urls')->getUrlGuardarProducto($producto->id)}}" class="btn btn-primary">Guardar</a>              
		  </div>
    </div>	   		
			
	
</form>
                              
  </div>
</div>
</div>

@endsection
