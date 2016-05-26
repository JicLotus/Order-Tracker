@extends("layouts.base") 

@section("content")
<a  href="{{app()->make('urls')->getUrlUsuarios()}}" class="btn btn-primary btn-block"><h4><b>VENDEDORES</b></h4></a>
<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Nuevo Vendedor</strong></h2>
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
  <div class="col-md-5 col-sm-offset-1">
     
    
 
<form action="guardarusuario" method="POST" class="form-horizontal" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="idUsuario" value="">
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="nombre">Nombre</label>
          <div class="col-sm-8">
			<input type="Text" name="nombre"value="{{ old('nombre') }}" ><br>
		  </div>
    </div>
    
     <div class="form-group">
		<label class="control-label col-sm-2" for="email">Email</label>
          <div class="col-sm-8">
			<input type="Text" name="email"  value="{{ old('email') }}"><br>
		  </div>
    </div>	
        
    <div class="form-group">
		<label class="control-label col-sm-2" for="password">Contraseña</label>
          <div class="col-sm-8">
			<input type="Text" name="password" value="{{ old('password') }}""> <br>
			    <input type="hidden" name="privilegio" value="2" >
		  </div>
    </div>
        
    <div class="form-group">
		<label class="control-label col-sm-2" for="telefono">Teléfono</label>
          <div class="col-sm-8">
			<input type="Text" name="telefono" value="{{ old('telefono') }}"> <br>
		  </div>
    </div>
  

    <div class="form-group">
				<div class="col-sm-8">
					
	  				<a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
					<button type="submit" class="col-sm-offset-4 btn btn-primary">Publicar</button>



				</div>
			</div> 		
					
	
</form>
                              
  </div>
</div>

@endsection
