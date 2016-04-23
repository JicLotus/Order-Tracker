@extends("layouts.base") 

@section("content")

<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Editar Cliente</strong></h2>
  </div>
</div>

<div class="row">
 
<script type="text/javascript" src="{{ URL::asset('js/qrcode.js') }}"></script>
	<div class="col-md-4" id="qr">
			<script>document.getElementById('qr').innerHTML=create_qrcode("{{$cliente->id}}");
			</script>
	</div>

  <div class="col-md-8">
     
	<form action="mailto:moncholo06@gmail.com" method="POST" class="form-horizontal" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="idCliente" value="{{$cliente->id}}">
		
		
		<div class="form-group">
			<label class="control-label col-sm-2" for="nombre">Nombre</label>
			  <div class="col-sm-8">
				<input type="Text" name="nombre" value="{{$cliente->nombre}}" ><br>
			  </div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Email</label>
			  <div class="col-sm-8">
				<input type="Text" name="email" value="{{$cliente->email}}" ><br>
			  </div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2" for="direccion">Dirección</label>
			  <div class="col-sm-8">
				<input type="Text" name="direccion" value="{{$cliente->direccion}}"> <br>
			  </div>
		</div>
		
		 <div class="form-group">
			<label class="control-label col-sm-2" for="razon_social">Razón Social</label>
			  <div class="col-sm-8">
				<input type="Text" name="razon_social"  value="{{$cliente->razon_social}}"><br>
			  </div>
		</div>	
		
		<div class="form-group">
			<label class="control-label col-sm-2" for="telefono_movil">Teléfono Móvil</label>
			  <div class="col-sm-8">
				<input type="Text" name="telefono_movil" value="{{$cliente->telefono_movil}}"><br>
			  </div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2" for="telefono_laboral">Teléfono Laboral</label>
			  <div class="col-sm-8">
				<input type="Text" name="telefono_laboral"  value="{{$cliente->telefono_laboral}}"><br>
			  </div>
		</div>


			<div class="form-group">
				<div class="col-sm-8">
					<a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>

					<button type="submit" class="col-sm-offset-4 btn btn-default">Publicar
					</button>

				</div>
			</div> 		
					
	</form>


                              
  </div>
</div>
</div>

@endsection
