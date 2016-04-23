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
		<a  href="{{app()->make('urls')->getUrlPedidos()}}" class="btn btn-primary btn-block"><h4><b>PEDIDOS</b></h4></a>

		
		
		<h4><form action="pedidovendedor" method="GET" class="form-horizontal"   enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					
					<h4><label class="control-label col-sm-2" for="ListaClientes">Lista de clientes:</label></h4>
					  <div class="col-sm-8">
						<select id="idCliente" name="idCliente">
							@foreach($clientes as $cliente)
							<option value= {{$cliente->id}} > {{$cliente->nombre}}</option>  
							@endforeach
													  
							<input type="submit" value= "Ver" />
						</select>
					  </div> 
				</div>	
		</form></h4>

<hr width=75%"/>

	<a href="{{app()->make('urls')->getUrlEliminarPedidosCancelados()}}" class="btn btn-primary">Eliminar Pedidos Cancelados</a> 
      </section>
@endsection

