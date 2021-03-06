@extends("layouts.base") 

@section("content")
<a  href="{{app()->make('urls')->getUrlUsuarios()}}" class="btn btn-primary btn-block"><h4><b>VENDEDORES</b></h4></a>
<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong><?php if ($editar == true){echo "Editar Vendedor";} else{ echo "Detalle del Vendedor";}?></strong></h2>
  </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
    
 
<form action="guardarusuario" method="POST" class="form-horizontal" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="privilegio"  value="{{$usuario->privilegio}}">
	<input type="hidden" name="idUsuario" value="{{$usuario->id}}">
	
<div class="row">
  <div class="col-md-4 col-sm-offset-1">
     
	<div class="form-group">
		<label class="control-label col-sm-3" for="nombre">Nombre</label>
          <div class="col-sm-8">
			<input <?php if ($editar !=true){ ?> disabled <?php }?> type="Text" name="nombre" value="{{$usuario->nombre}}" ><br>
		  </div>
    </div>
    <div class="form-group">
		<label class="control-label col-sm-3" for="email">Email</label>
          <div class="col-sm-8">
			<input <?php if ($editar !=true){ ?> disabled <?php }?> type="Text" name="email" value="{{$usuario->email}}" ><br>
			
			
		  </div>
    </div>    
     <div class="form-group">
		<label class="control-label col-sm-3" for="telefono">Teléfono</label>
          <div class="col-sm-8">
			<input <?php if ($editar !=true){ ?> disabled <?php }?> type="Text" name="telefono" value="{{$usuario->telefono}}"> <br>
		  </div>
    </div>
  </div>
  <div class="col-md-5"> 
   
   <div class="form-group">
		<label class="control-label col-sm-5" for="password">Contraseña Antigua</label>
          <div class="col-sm-7">
			<input <?php if ($editar !=true){ ?> disabled <?php }?> type="password" name="password" value=""> <br>
		  </div>
    </div> 
   <div class="form-group">
		<label class="control-label col-sm-5" for="password2">Contraseña Nueva</label>
          <div class="col-sm-7">
			<input <?php if ($editar !=true){ ?> disabled <?php }?> type="password" name="password2" value=""> <br>
		  </div>
    </div>  
    <div class="form-group">
		<label class="control-label col-sm-5" for="password3">Repita Contraseña</label>
          <div class="col-sm-7">
			<input <?php if ($editar !=true){ ?> disabled <?php }?> type="password" name="password3" value=""> <br>
		  </div>
    </div> 
   
	
  </div>
</div>

                    
  <div class="form-group">
				<div class="col-sm-12">
					
	  				<a href="{{app()->make('urls')->getUrlUsuarios()}}" class=" btn btn-default">Cancelar</a>

					<?php if ($editar ==true){ ?>
						<button type="submit" class="col-sm-offset-9 btn btn-primary">Publicar</button>	
					<?php }else{?>
						<a href="{{app()->make('urls')->getUrlEditarUsuario($usuario->id)}}" class="col-sm-offset-9 btn btn-primary">Editar</a>
					<?php }?>

				</div>
			</div> 		
</form>
</div> 

@endsection
