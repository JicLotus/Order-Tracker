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



    <section id="search-section">
					<a href="{{app()->make('urls')->getUrlAgregarCliente()}}" class="btn btn-primary">Agregar</a>            
                @foreach($clientes as $cliente)
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Nombre: {{$cliente->nombre}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Dirección: {{$cliente->direccion}}</span>
                                </div>
									
                                <div class="control-group">
									<span class="control-label dimgray">Razón Social: {{$cliente->razon_social}}</span>
								</div>

								<a href="{{app()->make('urls')->getUrlEditarCliente($cliente->id)}}" class="btn btn-primary">Editar</a>                                


                                
                            </div>
                        </p>
                @endforeach
        
    </section>

@endsection

