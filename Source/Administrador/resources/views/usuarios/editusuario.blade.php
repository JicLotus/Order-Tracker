@extends("layouts.base") 

@section("content")

<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Editar Cliente</strong></h2>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    
 
<form action="guardarusuario" method="POST" class="form-horizontal" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="idUsuario" value="{{$usuario->id}}">
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="nombre">Nombre</label>
          <div class="col-sm-8">
			<input type="Text" name="nombre" value="{{$usuario->nombre}}" ><br>
		  </div>
    </div>
        
    <div class="form-group">
		<label class="control-label col-sm-2" for="password">Contraseña</label>
          <div class="col-sm-8">
			<input type="Text" name="password" value="{{$usuario->password}}"> <br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="email">Email</label>
          <div class="col-sm-8">
			<input type="Text" name="email" value="{{$usuario->email}}" ><br>
		  </div>
    </div>

    
     <div class="form-group">
		<label class="control-label col-sm-2" for="privilegio">Privilegio</label>
          <div class="col-sm-8">
			<input type="Text" name="privilegio"  value="{{$usuario->privilegio}}"><br>
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
