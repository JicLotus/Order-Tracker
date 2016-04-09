@extends("layouts.base") 

@section("content")

<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Nuevo Cliente</strong></h2>
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
    
 
<form action="guardarcliente" method="POST" class="form-horizontal" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="idCliente" value="">
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="nombre">Nombre</label>
          <div class="col-sm-8">
			<input type="Text" name="nombre" value="" ><br>
		  </div>
    </div>
    
     <div class="form-group">
		<label class="control-label col-sm-2" for="email">Email</label>
          <div class="col-sm-8">
			<input type="Text" name="email"  value=""><br>
		  </div>
    </div>	
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="direccion">Dirección</label>
          <div class="col-sm-8">
			<input type="Text" name="direccion" value="" ><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="razon_social">Razón Social</label>
          <div class="col-sm-8">
			<input type="Text" name="razon_social" value=""> <br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="telefono_movil">Teléfono Movil</label>
          <div class="col-sm-8">
			<input type="Text" name="telefono_movil" value=""><br>
		  </div>
    </div>
    
    <div class="form-group">
		<label class="control-label col-sm-2" for="marca">Teléfono Laboral</label>
          <div class="col-sm-8">
			<input type="Text" name="telefono_laboral"  value=""><br>
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
