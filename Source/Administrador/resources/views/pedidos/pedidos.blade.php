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

@endsection

@section("content")

    
@section("content")
    <section id="search-section">
		
		<form action="pedidovendedor" method="GET" class="form-horizontal"   enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="control-label col-sm-2" for="ListaVendedores">Lista de vendedores:</label>
					  <div class="col-sm-8">
						<select id="idVende" name="idVendedor">
							@foreach($vendedores as $vendedor)
							<option value= {{$vendedor->id}} > {{$vendedor->nombre}}</option>  
							@endforeach
													  
							<input type="submit" value= "Ver" />
						</select>
					  </div> 
				</div>	
		</form>

<hr width=75%"/>

	<a href="{{app()->make('urls')->getUrlEliminarPedidosCancelados()}}" class="btn btn-primary">Eliminar Pedidos Cancelados</a> 
      </section>
@endsection

