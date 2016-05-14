@extends("layouts.base") 

@section("content")

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

<div class="row">
  <div class="col-md-12">
    
 
<form action="guardarnuevoproducto" method="POST" class="form-horizontal" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="idProducto" value="">
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="nombre">Nombre</label>
          <div class="col-sm-8">
			<input type="Text" name="nombre" value="" ><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="codigo">Codigo</label>
          <div class="col-sm-8">
			<input type="Text" name="codigo" value="" ><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="caracteristicas">Caracteristicas</label>
          <div class="col-sm-8">
			<input type="Text" name="caracteristicas" value=""> <br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="stock">Stock</label>
          <div class="col-sm-8">
			<input type="Text" name="stock" value=""><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="marca">Marca</label>
          <div class="col-sm-8">
			<select id="marca" name="marca" >
					@foreach($marcas as $marca)   
					<option value= {{$marca->id}}>{{$marca->nombre}}</option>
					@endforeach
			</select> 
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="categoria">Categoria</label>
          <div class="col-sm-8">
			<select id="categoria" name="categoria" >
					@foreach($categorias as $categoria)   
					<option value= {{$categoria->id}}>{{$categoria->nombre}}</option>
					@endforeach
			</select> 
		  </div>
    </div>	
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="precio">Precio</label>
          <div class="col-sm-8">
			<input type="Text" name="precio" value=""><br>
		  </div>
    </div>	
	<div class="form-group">
		<label class="control-label col-sm-2" for="imagen">Imagen</label>
          <div class="col-sm-8">
			<input type="file" name="imagen" id="imagen">
    	  </div>
    </div>	
<div class="form-group">
		<label class="control-label col-sm-2" for="imagen2">Imagen</label>
          <div class="col-sm-8">
			<input type="file" name="imagen2" id="imagen2">
    	  </div>
    </div>	
<div class="form-group">
		<label class="control-label col-sm-2" for="imagen3">Imagen</label>
          <div class="col-sm-8">
			<input type="file" name="imagen3" id="imagen3">
    	  </div>
    </div>	
<div class="form-group">
		<label class="control-label col-sm-2" for="imagen4">Imagen</label>
          <div class="col-sm-8">
			<input type="file" name="imagen4" id="imagen4">
    	  </div>
    </div>	

    	
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>

                <button type="submit" class="col-sm-offset-5 btn btn-default">Publicar
                </button>

            </div>
        </div> 		
			
	
</form>
                              
  </div>
</div>
</div>

@endsection
