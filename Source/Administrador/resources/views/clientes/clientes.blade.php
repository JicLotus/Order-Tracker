@extends("layouts.base")

@section("head")

	


  <script type="text/javascript">
    $(document).ready(function(){
      $(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
      });
    });
  </script>

    
@section("content")
 
		
    <section id="search-section">
			<a  href="{{app()->make('urls')->getUrlClientes()}}" class="btn btn-primary btn-block"><h4><b>CLIENTES</b></h4></a>

		
	<h4><form action="{{app()->make('urls')->getUrlFiltroClientes()}}" method="POST" class="form-horizontal"   enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
					<div class="row">	

						<label class="col-sm-offset-1 control-label col-sm-1" >Cliente</label>
							<input  class="col-sm-2" type="text" name="nombre" value= "{{$clienteAnterior}}">
								

						<label class="control-label col-sm-1" >Razón Social</label>
							<input  class="col-sm-2" type="text" name="razonsocial" value= "{{$razonAnterior}}">

						<label class="control-label col-sm-1" >Dirección</label>
							<input  class="col-sm-3" type="text" name="direccion"value= "{{$direccionAnterior}}">
					</div>

					
					<div class="row">	
						<a href="{{app()->make('urls')->getUrlAgregarCliente()}}" class="col-sm-2 col-sm-offset-1 btn btn-primary">Agregar Nuevo Cliente</a> 	
						<button type="submit" class="col-sm-1 col-sm-offset-7 btn btn-primary">Buscar</button>
           						
						
					</div>
		</div>	
		
</form></h4>

     <?php If (count($clientes) == 0){?>   
		<div class="alert alert-warning">
			<strong>No existen clientes! </strong>Revise los filtros seleccionados.
		</div>
	  <?php } else {?>

<hr width=75%"/>
<div class="container">
  <h2>Clientes</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Razón Social</th>
        <th>Dirección</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
		
	 @foreach($clientes as $cliente)
	<tr>
	
	<td>
		{{$cliente->nombre}}
	</td>
	
	<td>
		{{$cliente->razon_social}}
	</td>
	<td>
		{{$cliente->direccion}}
	</td>
	<td> 
		<a href="{{app()->make('urls')->getUrlEditarCliente($cliente->id)}}" class="btn-xs btn-primary">Editar</a>                                
	</td>
	
	</tr>
	@endforeach
	
    </tbody>
  </table>
</div>
    
    
     <?php } ?>

    </section>
	
      </section>
@endsection

